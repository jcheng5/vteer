<?php
$CI =& get_instance();
$CI->load->helper('mail');

# Status for volunteer applications
define("STATUS_CREATED", 0); # Only basic info has been provided.
define("STATUS_DRAFT", 1); # Full application has been started but not completed.
define("STATUS_SUBMITTED", 2); # Full application has been completed but not approved/rejected.
define("STATUS_ACCEPTED", 3); # Application has been accepted by admin.
define("STATUS_CONFIRMED", 4); # Travel itinerary has been confirmed.
define("STATUS_REJECTED", -1); # Application has been rejected by admin.
define("STATUS_INACTIVE", -2); # Application is no longer active.

function format_status($status)
{
  $map = array(
    STATUS_CREATED => 'Created',
    STATUS_DRAFT => 'Draft',
    STATUS_SUBMITTED => 'Submitted',
    STATUS_ACCEPTED => 'Accepted',
    STATUS_CONFIRMED => 'Confirmed',
    STATUS_REJECTED => 'Rejected',
    STATUS_INACTIVE => 'Inactive');
  return $map[$status];
}

function format_status_desc($status)
{
  $map = array(
    STATUS_CREATED => 'Applicants that have registered but not started the application',
    STATUS_DRAFT => 'Applications that have not yet been submitted',
    STATUS_SUBMITTED => 'Applications needing review',
    STATUS_ACCEPTED => 'Applications that have been accepted',
    STATUS_CONFIRMED => 'Applications that have been confirmed',
    STATUS_REJECTED => 'Applications that have been rejected',
    STATUS_INACTIVE => 'Inactive applications');
  return $map[$status];
}

function format_status_nextstep($status)
{
  $map = array(
    STATUS_CREATED => 'Applicant begins application',
    STATUS_DRAFT => 'Applicant completes and submits application',
    STATUS_SUBMITTED => 'Volunteer Coordinator accepts or rejects application',
    STATUS_ACCEPTED => 'Administrator enters and confirm travel dates',
    STATUS_CONFIRMED => FALSE,
    STATUS_REJECTED => FALSE,
    STATUS_INACTIVE => FALSE);
  return $map[$status];
}

$titles = array('Applicants needing review',
  'Applicants that have been accepted',
  'Applicants that have been confirmed',
  'Applicants that have been rejected',
  'Applicants that have not yet been submitted');


function create_user($firstname, $lastname, $email, $password)
{
  $db = new DbConn();
  if (0 == $db->exec('insert into users (firstname, lastname, email, password) values (?, ?, ?, ?)',
                     $firstname, $lastname, $email, $password))
  {
    throw new RuntimeException('A database error occurred');
  }
  $newId = $db->last_insert_id();

  log_event(LOG_USER_CREATED, $newId);

  schedule_mail($newId, MAIL_INTRO);

  return get_user($newId);
}

function get_user($user_id)
{
  $db = new DbConn();
  return $db->fetch('select * from users where id = ?', $user_id);
}

function get_user_assoc($user_id)
{
  $db = new DbConn();
  return $db->fetch_assoc('select * from users where id = ?', $user_id);
}

function get_users_by_state($state)
{
  $db = new DbConn();
  if (!is_array($state))
    $state = array($state);
  return $db->query('select * from users where status in ?', $state);
}

function get_user_by_credentials($email, $password)
{
  $db = new DbConn();
  return $db->fetch('select * from users where email = ? and password = ?', $email, $password);
}

function get_user_by_email($email)
{
  $db = new DbConn();
  return $db->fetch('select * from users where email = ?', $email);
}

function transition_user_to_state($user_id, $newState, $force = false)
{
  $user = get_user($user_id);
  if (!$user)
    throw new RuntimeException('Unknown user');
  $status = $user->status;

  if (!$force)
  {
    if ($newState == $status)
    {
      return 0;
    }

    // The list of state transitions that are valid.
    $transitions = array(
      STATUS_CREATED => array(STATUS_DRAFT),
      STATUS_DRAFT => array(STATUS_SUBMITTED),
      STATUS_SUBMITTED => array(STATUS_ACCEPTED, STATUS_REJECTED),
      STATUS_ACCEPTED => array(STATUS_CONFIRMED)
    );

    if (!array_key_exists($status, $transitions))
    {
      throw new RuntimeException('Unknown starting state ' . $status);
    }

    if (array_search($newState, $transitions[$status]) === false)
    {
      throw new RuntimeException('Invalid state transition: ' . $status . '->' . $newState);
    }
  }

  $db = new DbConn();
  $rows = $db->exec('update users set status = ?, laststatuschange = ? where id = ?', (int) $newState, date_create(), (int) $user_id);

  log_event(LOG_USER_STATE_CHANGE, (int)$user_id, (int)$newState);

  $db->exec('delete from mails_scheduled where userid = ?', $user_id);

  switch ($newState)
  {
    case STATUS_DRAFT:
      break;
    case STATUS_SUBMITTED:
      schedule_mail($user_id, MAIL_CONFIRM_APP);
      schedule_mail($user_id, ADMINMAIL_SUBMITTED_NOTIFICATION);
      schedule_mail($user_id, ADMINMAIL_DECISION_DUE, new DateTime('+2 weeks -2 days'));
      schedule_mail($user_id, ADMINMAIL_DECISION_OVERDUE, new DateTime('+2 weeks +1 day'));
      break;
    case STATUS_ACCEPTED:
      schedule_mail($user_id, MAIL_ACCEPTED);
      schedule_mail($user_id, ADMINMAIL_CONFIRMATION_REMINDER, new DateTime("+1 month"));
      break;
    case STATUS_CONFIRMED:
      schedule_mail($user_id, MAIL_ITINERARY_CONFIRMED);
      $arrivaldate = new DateTime($user->arrivaldate);

      schedule_mail($user_id, MAIL_TWO_MONTHS, new DateTime("$user->arrivaldate -2 months"));
      schedule_mail($user_id, MAIL_ONE_MONTH, new DateTime("$user->arrivaldate -1 month"));
      schedule_mail($user_id, MAIL_ONE_WEEK, new DateTime("$user->arrivaldate -1 week"));

      break;

    case STATUS_REJECTED:
      schedule_mail($user_id, MAIL_DENIED);
      break;
    case STATUS_INACTIVE:
      break;
  }


  return $rows;
}

function merge_data($userid, $jsonData)
{
  $newData = json_decode($jsonData, true);
  if (is_null($newData))
    throw new RuntimeException("JSON decoding failed!");

  $user = get_user($userid);
  if (!$user)
    throw new RuntimeException("Unknown user $userid");
  $oldJson = ($user->data && strlen($user->data) > 0) ? $user->data : "{}";

  $oldData = json_decode($oldJson, true);
  if (is_null($oldData))
    throw new RuntimeException("JSON decoding failed!");

  foreach ($newData as $key => $val)
  {
    if (is_null($val))
      unset($oldData[$key]);
    else
      $oldData[$key] = $val;
  }

  $mergedJson = json_encode($oldData);
  //echo $mergedJson;

  $db = new DbConn();
  $db->exec('UPDATE users SET data = ? WHERE id = ?', $mergedJson, $userid);
}

function download_user_file($userId, $fieldId)
{
  $user = get_user($userId);

  $filePath = make_file_path($userId, $fieldId);
  if (!$user->data)
    return FALSE;

  $data = json_decode($user->data);
  $fileData = $data->$fieldId;
  if (!$fileData)
    return FALSE;

  $fileType = $fileData->type;
  $filename = $fileData->name;

  return download_file($filePath, $filename, $fileType);
}

function download_file($filePath, $filename, $fileType)
{
  if (!file_exists($filePath))
    return FALSE;

  header("Content-Type: $fileType");
  header("Content-Disposition: inline; filename=$filename");
  readfile($filePath);
  return TRUE;
}

function make_file_path($userId, $fieldId)
{
  $CI =& get_instance();
  $upload_dir = $CI->config->item('upload_dir');
  return $upload_dir . DIRECTORY_SEPARATOR . $userId . "-" . $fieldId;
}

?>
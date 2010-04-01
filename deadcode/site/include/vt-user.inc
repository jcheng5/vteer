<?php

# Status for volunteer applications
define("STATUS_CREATED", 0);    # Only basic info has been provided.
define("STATUS_DRAFT", 1);      # Full application has been started but not completed.
define("STATUS_SUBMITTED", 2);  # Full application has been completed but not approved/rejected.
define("STATUS_ACCEPTED", 3);   # Application has been accepted by admin.
define("STATUS_CONFIRMED", 4);  # Travel itinerary has been confirmed.
define("STATUS_REJECTED", -1);  # Application has been rejected by admin.
define("STATUS_INACTIVE", -2);  # Application is no longer active.

function format_status($status) {
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
         STATUS_CREATED     =>   array(STATUS_DRAFT),
         STATUS_DRAFT       =>   array(STATUS_SUBMITTED),
         STATUS_SUBMITTED   =>   array(STATUS_ACCEPTED, STATUS_REJECTED),
         STATUS_ACCEPTED    =>   array(STATUS_CONFIRMED)				
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
   $rows = $db->exec('update users set status = ?, laststatuschange = ? where id = ?', (int)$newState, date_create(), (int)$user_id);
   
   
   if ($status != STATUS_ACCEPTED || $newStatus != STATUS_CONFIRMED)
   {
      $db->exec('delete from mails_scheduled where userid = ?', $user_id);
   }
   
   switch ($newState)
   {
      case STATUS_DRAFT:
         break;
      case STATUS_SUBMITTED:
         schedule_mail($user_id, MAIL_CONFIRM_APP);
         $headers = array(
            'From' => $mail_sender,
            'Subject' => $mail->subject);
         send_mail($admin_email, $headers, "A new application has been submitted: " . $user->firstname  . " " . $user->lastname);
         break;
      case STATUS_ACCEPTED:
         schedule_mail($user_id, MAIL_ACCEPTED);
         break;
      case STATUS_CONFIRMED:
         schedule_mail($user_id, MAIL_ITINERARY_CONFIRMED);
         $traveldate = new DateTime($user->traveldate);
         
         $two_months = clone $traveldate;
         $two_months->modify('-2 months');
         schedule_mail($user_id, MAIL_TWO_MONTHS, $two_months);

         $one_month = clone $traveldate;
         $one_month->modify('-1 month');
         schedule_mail($user_id, MAIL_ONE_MONTH, $one_month);

         $one_week = clone $traveldate;
         $one_week->modify('-1 week');
         schedule_mail($user_id, MAIL_ONE_WEEK, $one_week);
         
         break;
         
      case STATUS_REJECTED:
         schedule_mail($user_id, MAIL_DENIED);
         break;
      case STATUS_INACTIVE:
         break;
   }
   
   
   return $rows;
}

function merge_data($userid, $jsonData) {
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
  
    foreach ($newData as $key=>$val) {
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

?>
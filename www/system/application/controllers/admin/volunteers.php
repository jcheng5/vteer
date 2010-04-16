<?php

class Volunteers extends Controller
{

  function Volunteers()
  {
    parent::Controller();
    $this->load->library('admin');
    $this->admin->enforce();
  }

  function index()
  {
    $this->load->view('admin/header');
    $this->_history(FALSE, 30);
    $this->load->view('admin/pagetitle', array('pagetitle' => 'Volunteer Dashboard'));
    $this->load->view('admin/volunteers/tasks');
    $this->_status(array(STATUS_SUBMITTED, STATUS_ACCEPTED, STATUS_CONFIRMED, STATUS_DRAFT, STATUS_REJECTED),
                   25);
    $this->load->view('admin/footer');
  }

  function status($status, $limit=FALSE)
  {
    $this->load->view('admin/header');
    $this->load->view('admin/pagetitle', array('pagetitle' => "Applications: " . format_status($status)));
    $this->_status($status, $limit);
    $this->load->view('admin/footer');
  }

  function _status($status, $limit=FALSE)
  {
    if (is_array($status))
      $statuses = $status;
    else
      $statuses = explode('_', $status);

    // Probably not necessary to cast these to ints, I just can't help myself
    for ($i = 0; $i < sizeof($statuses); $i++)
      $statuses[$i] = (int)$statuses[$i];

    $this->load->helper('format');

    $user_groups = array_map("get_users_by_state", $statuses);
    $titles = array_map("format_status_desc", $statuses);
    $datetitles = array_map("format_status", $statuses);

    $this->load->view('admin/volunteers/list.php',
                      array('statuses' => $statuses,
                            'user_groups' => $user_groups,
                            'titles' => $titles,
                            'datetitles' => $datetitles,
                            'limit' => $limit));
  }

  function show($id)
  {
    $this->load->helper('note');
    $this->load->helper('format');
    $this->load->helper('form');

    $user = get_user($id);
    if (!$user)
      show_error('User not found', 404);

    $notes = get_notes($user->id);

    $fields = json_decode(file_get_contents(dirname(__FILE__) . '/fields.json'));
    $data = json_decode($user->data, TRUE);
    foreach ($user as $key => $value)
      $data[$key] = $value;

    $this->load->view('admin/header',
                      array('title' => "Volunteer - $user->firstname $user->lastname"));
    $this->load->view('admin/volunteers/show',
                      array('fields' => $fields,
                        'data' => $data,
                        'notes' => $notes,
                        'user' => $user,
                        'admin_id' => $this->admin->id()));
    $this->load->view('admin/footer');
  }

  function delete($id)
  {
    $db = new DbConn();
    $db->exec('delete from users where id = ?', $id);
    $db->exec('delete from mails_scheduled where userid = ?', $id);
    $db->exec('delete from mails_sent where userid = ?', $id);
    $db->exec('delete from notes where userid = ?', $id);

    log_event(LOG_USER_DELETED, $id);

    redirect('admin/volunteers');
  }

  function history($id=null, $limit=FALSE)
  {
    $this->load->view('admin/header');
    $this->history($id, $limit);
    $this->load->view('admin/footer');
  }
  function _history($id=null, $limit=FALSE)
  {
    if ($id)
    {
      $user = get_user($id);
      if (!$user)
        show_error('User not found', 404);
      $events = get_log_events($id, $limit);
      $pagetitle = "History for $user->firstname $user->lastname";
    }
    else
    {
      $events = get_log_events(FALSE, $limit);
      $pagetitle = "Latest Activity";
    }

    $this->load->view('admin/volunteers/history.php',
                      array('pagetitle' => $pagetitle, 
                            'events' => $events));
  }

  function email_history($id)
  {
    $user = get_user($id);
    if (!$user)
      show_error('User not found', 404);
    $db = new DbConn();
    $sentMails = $db->query('select * from mails_sent, mail_template_versions where mails_sent.templateverid = mail_template_versions.id and mails_sent.userid = ? order by sent desc', $id);
    $scheduledMails = $db->query('select * from mails_scheduled, mail_templates where mails_scheduled.mailid = mail_templates.id and mails_scheduled.userid = ? order by due asc', $id);

    $this->load->view('admin/header',
                      array('title' => "E-mail history - $user->firstname $user->lastname"));
    $this->load->view('admin/volunteers/emails',
                      array('user' => $user,
                            'sentMails' => $sentMails,
                            'scheduledMails' => $scheduledMails));
  }

  function acceptreject($userId, $action)
  {
    if ($action != 'accept' && $action != 'reject')
      throw new RuntimeException("Unknown action: $action");
    if (!is_numeric($userId))
      throw new RuntimeException("Non-numeric id: $userId");

    if ($action == 'accept')
      transition_user_to_state($userId, STATUS_ACCEPTED);
    else if ($action == 'reject')
      transition_user_to_state($userId, STATUS_REJECTED);

    redirect("admin/volunteers/show/$userId");
  }

  function addnote()
  {
    $this->load->helper('note');

    $userId = $this->input->post('userid');
    $source = $this->input->post('source');
    $contents = $this->input->post('contents');

    $admin_id = $this->admin->id();

    add_note($userId, $admin_id, $source, $contents);

    redirect("admin/volunteers/show/$userId");
  }

  function deletenote($userId, $noteId)
  {
    $this->load->helper('note');

    delete_note($noteId);
    redirect("admin/volunteers/show/$userId");
  }

  function download($userId, $fieldId)
  {
    if (!download_user_file($userId, $fieldId))
      show_error("File not found", 404);
  }

  function change_dates($userId)
  {
    $user = get_user($userId);
    if (!$user)
      show_error('User not found', 404);

    $arrival = $this->_to_date($this->input->post('arrivaldate'));
    $departure = $this->_to_date($this->input->post('departuredate'));
    $travelnotes = $this->input->post('travelnotes');
    $confirmed = $this->input->post('datesconfirmed');

    $db = new DbConn();
    $rows = $db->exec('update users set arrivaldate = ?, departuredate = ?, travelnotes = ? where id = ?',
                      $arrival, $departure, $travelnotes, (int)$userId);

    $arrival_str = $arrival->format('Y-m-d');
    $departure_str = $arrival->format('Y-m-d');
    log_event(LOG_TRAVEL_INFO_UPDATE, $userId, substr("Arrive: $arrival_str\nDepart: $departure_str\nNotes: $travelnotes", 0, 255));

    if ($user->status == STATUS_ACCEPTED && $confirmed)
      transition_user_to_state($userId, STATUS_CONFIRMED);

    $this->session->set_flashdata('message', 'Changes saved successfully');

    redirect("admin/volunteers/show/$userId");
  }

  function _to_date($value)
  {
    return $value ? date_create($value) : NULL;
  }
}

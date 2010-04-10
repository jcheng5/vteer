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
    $this->load->helper('format');

    $users_submitted = get_users_by_state(STATUS_SUBMITTED);
    $users_accepted = get_users_by_state(STATUS_ACCEPTED);
    $users_rejected = get_users_by_state(STATUS_REJECTED);
    $users_draft = get_users_by_state(array(STATUS_DRAFT, STATUS_CREATED));

    $user_groups = array($users_submitted, $users_accepted, $users_rejected, $users_draft);
    $titles = array('Applicants needing review',
      'Applicants that have been accepted',
      'Applicants that have been rejected',
      'Applicants that have not yet been submitted');


    $this->load->view('admin/header');
    $this->load->view('admin/volunteers/list.php',
                      array('user_groups' => $user_groups,
                        'titles' => $titles));
    $this->load->view('admin/footer');
  }

  function show($id)
  {
    $this->load->helper('note');
    $this->load->helper('format');
    $this->load->helper('form');

    $user = get_user($id);
    if (!$user)
      throw new RuntimeException('User not found');

    $notes = get_notes($user->id);

    $fields = json_decode(file_get_contents(dirname(__FILE__) . '/fields.json'));
    $data = json_decode($user->data, TRUE);

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

    redirect('admin/volunteers');
  }

  function email_history($id)
  {
    $user = get_user($id);
    if (!$user)
      throw new RuntimeException('User not found');
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
}

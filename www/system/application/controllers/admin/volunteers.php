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
    $users_draft = get_users_by_state(STATUS_DRAFT);

    $user_groups = array($users_submitted, $users_accepted, $users_rejected, $users_draft);
    $titles = array('Applicants needing review',
      'Applicants that have been accepted',
      'Applicants that have been rejected',
      'Applicants that have not yet submitted');


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
                        'admin_id' => $this->admin->id())); // TODO: Use real admin id
    $this->load->view('admin/footer');
  }

  function acceptreject()
  {
    $user_id = $this->input->post('id');
    $action = $this->input->post('action');

    if ($action != 'accept' && $action != 'reject')
      throw new RuntimeException("Unknown action: $action");
    if (!is_numeric($user_id))
      throw new RuntimeException("Non-numeric id: $user_id");

    if ($action == 'accept')
      transition_user_to_state($user_id, STATUS_ACCEPTED);
    else if ($action == 'reject')
      transition_user_to_state($user_id, STATUS_REJECTED);

    redirect("admin/volunteers/show/$user_id");
  }

  function addnote()
  {
    $this->load->helper('note');

    $user_id = $this->input->post('userid');
    $source = $this->input->post('source');
    $contents = $this->input->post('contents');

    $admin_id = $this->admin->id();

    add_note($user_id, $admin_id, $source, $contents);

    redirect("admin/volunteers/show/$user_id");
  }
}

<?php

class Volunteers extends Controller
{

  function Volunteers()
  {
    parent::Controller();
  }

  function index()
  {
    $this->load->helper('format');
    //vt_header('Volunteers');

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
                        'admin_id' => 0)); // TODO: Use real admin id
    $this->load->view('admin/footer');
  }

  function acceptreject($id)
  {
    // TODO
  }
}

<?php

class Volunteers extends Controller {

  function Volunteers()
  {
    parent::Controller();	
  }

  function list()
  {
    vt_require_yui();
    vt_header('Volunteers');
    
    $users_submitted = get_users_by_state(STATUS_SUBMITTED);
    $users_accepted = get_users_by_state(STATUS_ACCEPTED);
    $users_rejected = get_users_by_state(STATUS_REJECTED);
    
    $user_groups = array($users_submitted, $users_accepted, $users_rejected);
    $titles = array('Applicants needing review',
                    'Applicants that have been accepted',
                    'Applicants that have been rejected');

    // TODO
  }
  
  function show($id)
  {
    // TODO
  }
  
  function acceptreject($id)
  {
  }
}

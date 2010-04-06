<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User
{
  function User()
  {
  }

  function get_current_user($rpc = FALSE)
  {
    $CI =& get_instance();
    $userid = $CI->session->userdata('userid');
    if (!$userid || !($user = get_user((int) $userid)))
    {
      if ($rpc)
        throw new RuntimeException("User ID was not found");
      else
      {
        redirect('welcome');
        // TODO: Set flashdata?
        exit;
      }
    }

    return $user;
  }

  function verify_draft($user, $rpc = FALSE)
  {
    if ($user->status != STATUS_DRAFT && $user->status != STATUS_CREATED)
    {
      if ($rpc)
        throw new RuntimeException("Application has already been submitted");
      else
      {
        redirect('welcome/dispatch');
        exit;
      }
    }
  }
}

?>
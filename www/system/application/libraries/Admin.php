<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin
{
  function Admin()
  {
    $CI =& get_instance();
    $CI->load->helper('cookie');
  }

  function enforce()
  {
    if (!$this->id(TRUE))
    {
      $CI =& get_instance();
      $CI->session->set_userdata('desturl', current_url());
      redirect('admin/auth/login');
      exit;
    }
  }

  function requested_url($default_url)
  {
    $CI =& get_instance();
    $url = $CI->session->userdata('desturl');
    $CI->session->unset_userdata('desturl');
    return $url ? $url : $default_url;
  }

  function logout()
  {
    delete_cookie('admin_id');
    delete_cookie('admin_token');
  }

  function login($username, $password, $persist)
  {
    $db = new DbConn();
    $result = $db->query('select * from admins where email = ? and password = ?',
                         $username, $password);
    if ($result->length != 1)
      return FALSE;

    $admin = $result->next();
    $id = $admin->id;

    if (!$admin->token)
    {
      $token = md5(uniqid());
      $db->exec('update admins set token = ? where email = ? and password = ?',
                $token, $username, $password);
    }
    else
    {
      $token = $admin->token;
    }

    $expire = $persist ? 157784630 : 0;
    set_cookie('admin_id', $id, $expire);
    set_cookie('admin_token', $token, $expire);

    return TRUE;
  }

  function get_admin_emails()
  {
    $db = new DbConn();
    $results = $db->query('select email from admins where email is not null');
    $emails = array();
    while ($email = $results->next())
      array_push($emails, $email->email);
    return $emails;
  }

  function get_volunteer_coordinator()
  {
    $db = new DbConn();
    return $db->fetch('select name, email from admins where iscoordinator = 1');
  }

  function id($verify = FALSE)
  {
    $id = get_cookie('admin_id');
    if (!$id)
      return FALSE;

    // If no verification is necessary, we're good to go
    if (!$verify)
      return $id;

    $token = get_cookie('admin_token');
    if (!$token)
      return FALSE;

    $db = new DbConn();
    $result = $db->query('select * from admins where id = ?', $id);
    $admin = $result->next();
    if (!$admin)
      return FALSE;

    if ($admin->token != $token)
      return FALSE;

    return $id;
  }
}
?>
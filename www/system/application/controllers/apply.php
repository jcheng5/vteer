<?php

class Apply extends Controller
{

  function Apply()
  {
    parent::Controller();
  }

  function page($page_num)
  {
    $this->_get_current_user();

    $max_page = 6;

    $prev_link = $page_num <= 1 ? FALSE : site_url('apply/page/' . ($page_num - 1));
    if ($page_num >= 6)
    {
      $next_label = 'Submit application';
      $next_link = site_url('apply/submit');
    }
    else
    {
      $next_link = site_url('apply/page/' . ($page_num + 1));
      $next_label = "Next page";
    }


    $data = array('page_num' => $page_num,
      'max_page' => $max_page,
      'prev_link' => $prev_link,
      'next_link' => $next_link,
      'next_label' => $next_label);

    $this->load->view('apply/header', $data);
    $this->load->view('apply/nav', $data);
    $this->load->view("apply/page$page_num", $data);
    $this->load->view('apply/nav', $data);
    $this->load->view('apply/footer', $data);
  }

  // JSON-RPC
  function retrieve()
  {
    header('Content-Type: text/plain');

    try
    {
      $user = $this->_get_current_user();

      $json = ($user->data && strlen($user->data) > 0) ? $user->data : "{}";
      if (is_null(json_decode($json)))
        throw new RuntimeException('Invalid JSON');

      echo $json;
    }
    catch (Exception $e)
    {
      set_status_header(500);
      echo $e->getMessage();
      exit;
    }
  }

  // JSON-RPC
  function update()
  {
    header('Content-Type: text/plain');

    try
    {
      $user = $this->_get_current_user();

      transition_user_to_state($user->id, STATUS_DRAFT);
      merge_data($user->id, file_get_contents("php://input"));
    }
    catch (Exception $e)
    {
      set_status_header(500);
      echo $e->getMessage();
      exit;
    }
  }

  function apply_js()
  {
    $this->load->view('apply_js');
  }

  function attach($field)
  {
    // TODO
  }

  function upload($field)
  {
    // TODO
  }

  function submit()
  {
    $user = $this->_get_current_user();

    transition_user_to_state($user->id, STATUS_SUBMITTED);
    $db = new DbConn();
    $db->exec('update users set submitdate = ? where id = ?',
              date_create(), $user->id);

    //redirect("apply/success");
    $this->success();
  }

  function success()
  {
    // Use the standard header/footer to not invoke the auto-save javascript
    $this->load->view('header');
    $this->load->view('apply/success');
    $this->load->view('footer');
  }

  function _get_current_user()
  {
    $userid = $this->session->userdata('userid');
    if (!$userid)
      throw new RuntimeException("User ID was not found");
    $user = get_user((int) $userid);
    if (!$user)
      throw new RuntimeException("User ID was not found");
    return $user;
  }
}

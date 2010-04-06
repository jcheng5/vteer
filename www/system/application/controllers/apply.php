<?php

/**
 * Controller for the authenticated part of the application process.
 * IMPORTANT: All methods must have $this->user->get_current_user() in order
 * to ensure the user is authenticated.
 */
class Apply extends Controller
{

  function Apply()
  {
    parent::Controller();
    $this->load->library('user');
  }

  function page($page_num)
  {
    $user = $this->user->get_current_user();
    $this->user->verify_draft($user);

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
      $user = $this->user->get_current_user();

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
      $user = $this->user->get_current_user();

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
    $this->load->view('apply/apply_js');
  }

  function attach($field)
  {
    $this->load->library('input');

    $user = $this->user->get_current_user();

    $this->load->view('apply/attach', array('field_id' => $field));
  }

  // JSON-RPC
  function detach($fieldId)
  {
    header('Content-Type: text/plain');

    try
    {
      $user = $this->user->get_current_user();

      merge_data($user->id, json_encode((array(
        $fieldId => NULL
      ))));

      $file = make_file_path($user->id, $fieldId);
      unlink($file);
    }
    catch (Exception $e)
    {
      set_status_header(500);
      echo $e->getMessage();
      exit;
    }
  }


  function upload($fieldId)
  {
    $user = $this->user->get_current_user();

    if (!preg_match('/^[a-z0-9\-_]+$/i', $fieldId))
      die('Illegal field ID');

    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
      echo 'File upload failed';
      die($_FILES['file']['error']);
    }

    $filename = $_FILES['file']['name'];
    $filetype = $_FILES['file']['type'];

    $destfile = make_file_path($user->id, $fieldId);
    if (!move_uploaded_file($_FILES['file']['tmp_name'], $destfile))
      die('Upload failed');

    merge_data($user->id, json_encode(array(
      $fieldId => array(
        'name' => $filename,
        'type' => $filetype
      )
    )));

    $this->load->view('apply/uploaded', array('fieldId' => $fieldId,
                                              'filename' => $filename));
  }

  function submit()
  {
    $user = $this->user->get_current_user();
    $this->user->verify_draft($user);

    transition_user_to_state($user->id, STATUS_SUBMITTED);
    $db = new DbConn();
    $db->exec('update users set submitdate = ? where id = ?',
              date_create(), $user->id);

    //redirect("apply/success");
    $this->success();
  }

  function success()
  {
    $user = $this->user->get_current_user();
    $this->user->verify_draft($user);

    // Use the standard header/footer to not invoke the auto-save javascript
    $this->load->view('header');
    $this->load->view('apply/success');
    $this->load->view('footer');
  }

  function download($fieldId)
  {
    $user = $this->user->get_current_user();

    if (!download_file($user->id, $fieldId))
      show_error("File not found", 404);
  }

}

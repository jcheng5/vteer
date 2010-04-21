<?php

class Auth extends Controller
{

  function Auth()
  {
    parent::Controller();
    $this->load->library('admin');
  }

  function login()
  {
    $this->load->view('admin/header');
    $this->load->view('admin/auth/login');
    $this->load->view('admin/footer');
  }

  function verify()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $persist = $this->input->post('persist');

    if ($this->admin->login($username, $password, $persist))
    {
      header("Location: ".$this->admin->requested_url(site_url('admin/volunteers')), TRUE, 302);
    }
    else
    {
      $err = 'Incorrect username or password';
      $this->load->view('admin/header');
      $this->load->view('admin/auth/login', 
                        array('login_error' => $err));
      $this->load->view('admin/footer');
    }
  }

  function logout()
  {
    $this->admin->logout();
    redirect('admin');
  }
}

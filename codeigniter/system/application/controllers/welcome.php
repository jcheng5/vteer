<?php

class Welcome extends Controller {

  function Welcome()
  {
    parent::Controller();	
  }
  
  function index()
  {
    $email = $this->input->post('email');
    if ($email === FALSE)
      $email = '';
    $password = $this->input->post('password');
    if ($password === FALSE)
      $password = '';

    $this->load->view('header');
    $this->load->view('index');      
    $this->load->view('footer');
  }
  
  function login()
  {
    $this->_logout();

    $email = $this->input->post('login_email');
    $password = $this->input->post('login_password');

    $user = FALSE;
    if (!($email === FALSE || $password === FALSE))
      $user = get_user_by_credentials($email, $password);

    if (!$user) {
      $errmsg = 'Sorry, unrecognized e-mail or incorrect password.';
      $this->load->view('header');
      $this->load->view('index', array('login_error' => $errmsg));
      $this->load->view('footer');
    }
    else {
      $this->session->set_userdata('userid', $user->id);
      // TODO: Pick up where user left off, not on page 1
      redirect('apply/page/1');
    }
  }
  
  function register()
  {
    $this->_logout();

    $this->load->helper('checkemail');

    $firstname = trim($this->input->post('firstname'));
    $lastname = trim($this->input->post('lastname'));
    $email = trim($this->input->post('email'));
    $password = trim($this->input->post('password'));
    $password2 = trim($this->input->post('password2'));

    if ($password != $password2)
    {
      $this->_index_with_error('Passwords do not match');
      return;
    }

    $user = get_user_by_email($email);
    if ($user)
    {
      $this->_index_with_error('That e-mail is already registered. Please try logging in.');
      return;
    }

    $validator = new EmailAddressValidator();
    if (!$validator->check_email_address($email))
    {
      $this->_index_with_error('Invalid e-mail address.');
      return;
    }

    $db = new DbConn();
    $db->exec('INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)',
              $firstname, $lastname, $email, $password);
    
    $newUser = get_user_by_email($email);
    if (!$newUser)
    {
      $this->_index_with_error('An unknown error occurred');
      return;
    }

    $this->session->set_userdata('userid', $newUser->id);

    redirect('apply/page/1');
  }
  
  function logout()
  {
    $this->_logout();
    
    $this->load->view('header');
    $this->load->view('logout');
    $this->load->view('footer');
  }
  
  function _index_with_error($error)
  {
    $this->load->view('header');
    $this->load->view('index', array('register_error' => $error));
    $this->load->view('footer');
  }
  
  function _logout()
  {
    $this->session->unset_userdata('userid');
  }
  
  function passwordhelp()
  {
    // TODO
  }
}

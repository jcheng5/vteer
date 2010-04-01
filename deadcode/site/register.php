<?php

session_start();

require_once('common.inc');
require_once("$base/lib/EmailAddressValidator.php");

session_unset();

$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password2 = trim($_POST['password2']);

if ($password != $password2) {
  redirect('index.html?regerror=' . urlencode('Passwords do not match'));
  exit;
}

$user = get_user_by_email($email);
if ($user) {
  redirect('index.html?regerror=' . urlencode('User already exists'));
  exit;
}

$validator = new EmailAddressValidator();
if (!$validator->check_email_address($email)) {
  redirect('index.html?regerror=' . urlencode('Invalid e-mail address'));
  exit;
}

$db = new DbConn();
$db->exec('INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)',
          $firstname, $lastname, $email, $password);

$newUser = get_user_by_email($email);
if (!$newUser) {
  redirect('index.html?regerror=' . urlencode('An unknown error occurred'));
  exit;
}

$_SESSION['userid'] = $newUser->id;

redirect('page1.html');

?>
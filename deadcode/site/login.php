<?php

// ERROR CODES
// 403

session_start();

require_once('common.inc');

session_unset();

$email = $_POST['email'];
$password = $_POST['password'];

$user = get_user_by_credentials($email, $password);
if (!$user) {
  header('HTTP/1.0 403 Incorrect credentials');
  echo('Incorrect username or password');
  exit;
}

$_SESSION['userid'] = $user->id;
redirect('page1.html');

?>
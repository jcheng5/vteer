<?php
session_start();

require_once('common.inc');

try {
  if (!$_SESSION['userid']) {
    throw new RuntimeException('No valid session');
  }
  
  $user = get_user($_SESSION['userid']);
  if (!$user)
    throw new RuntimeException('Unknown user');
  
  $json = ($user->data && strlen($user->data) > 0) ? $user->data : "{}";
  if (is_null(json_decode($json)))
    throw new RuntimeException('Invalid JSON');
  
  header('Content-Type: text/plain');
  echo $json;
}
catch (Exception $e) {
  header('HTTP/1.0 500 Error');
  echo $e->getMessage();
}
?>
<?php
session_start();

require_once('common.inc');

if (!$_SESSION['userid']) {
  redirect('login.php?error=1');
  exit;
}

try {
  transition_user_to_state($_SESSION['userid'], STATUS_DRAFT);
  merge_data($_SESSION['userid'], file_get_contents("php://input"));
  echo "OK";
} catch (Exception $e) {
  header('Content-Type: text/plain', true, 500);
  echo $e->getMessage();
}

?>
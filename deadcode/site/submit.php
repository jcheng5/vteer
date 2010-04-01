<?php
session_start();

require_once('common.inc');

if (!$_SESSION['userid']) {
  redirect('login.php?error=1');
  exit;
}

try {
  transition_user_to_state($_SESSION['userid'], STATUS_SUBMITTED);
  $db = new DbConn();
  $db->exec('update users set submitdate = ? where id = ?',
            date_create(), $_SESSION['userid']);
  echo "OK";
} catch (Exception $e) {
  header('Content-Type: text/plain', true, 500);
  echo $e->getMessage();
}

?>
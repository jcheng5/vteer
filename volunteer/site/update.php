<?php
session_start();

require_once('common.inc');

if (!$_SESSION['userid']) {
  redirect('login.php?error=1');
  exit;
}

function merge_data($userid, $jsonData) {
  $newData = json_decode($jsonData, true);
  if (is_null($newData))
    throw new RuntimeException("JSON decoding failed!");

  $user = get_user($userid);
  if (!$user)
    throw new RuntimeException("Unknown user $userid");
  $oldJson = ($user->data && strlen($user->data) > 0) ? $user->data : "{}";
  
  $oldData = json_decode($oldJson, true);
  if (is_null($oldData))
    throw new RuntimeException("JSON decoding failed!");
  
  foreach ($newData as $key=>$val) {
    if (is_null($val))
      unset($oldData[$key]);
    else
      $oldData[$key] = $val;
  }
  
  $mergedJson = json_encode($oldData);
  //echo $mergedJson;
  
  $db = new DbConn();
  $db->exec('UPDATE users SET data = ? WHERE id = ?', $mergedJson, $userid);
}

try {
  merge_data($_SESSION['userid'], file_get_contents("php://input"));
  echo "OK";
} catch (Exception $e) {
  header('Content-Type: text/plain', true, 500);
  echo $e->getMessage();
}

?>
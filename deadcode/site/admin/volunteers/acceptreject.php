<?php
require_once('./common.inc');

$id = (int)$_REQUEST['id'];
$action = $_REQUEST['action'];

if ($action == 'accept') {
  transition_user_to_state($id, STATUS_ACCEPTED);
}
else if ($action == 'reject') {
  transition_user_to_state($id, STATUS_REJECTED);
}
else {
  throw new RuntimeException('Unknown action, or no action provided');
}

redirect('../');
?>
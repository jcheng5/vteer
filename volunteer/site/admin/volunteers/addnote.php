<?php
require_once('./common.inc');

$userid = (int)$_REQUEST['userid'];
$source = $_REQUEST['source'];
$contents = $_REQUEST['contents'];

add_note($userid, $admin_id, $source, $contents);

redirect('view.php?id=' . $userid);

?>
<?php
require_once('./common.inc');

$id = (int)$_REQUEST['id'];

$note = get_note($id)->next();
if (!$note)
   throw new RuntimeException('Note not found');
if ($note->adminid != $admin_id)
   throw new RuntimeException('Permission denied');

$userid = $note->userid;
delete_note($id);

redirect('view.php?id=' . $userid);

?>
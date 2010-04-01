<?php

require_once('common.inc');

$id = $_POST['id'];
$subject = $_POST['subject'];
$htmlbody = $_POST['htmlbody'];
$textbody = html_to_plaintext($htmlbody);

$db = new DbConn();

if (!$id)
{
   # New template
   $db->exec('insert into mail_templates () values ()');
   $id = $db->last_insert_id();
}

$rows = $db->exec('insert into mail_template_versions (templateid, subject, html, plaintext) values (?, ?, ?, ?)', (int)$id, $subject, $htmlbody, $textbody);

if ($rows != 1)
   throw new RuntimeException("Insertion failed!");

redirect("list.php?highlight=$id");   
?>
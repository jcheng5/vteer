<?php
function get_notes($userid)
{
  $db = new DbConn();
  return $db->query('select notes.*, admins.name as author from notes, admins where notes.adminid = admins.id and notes.userid = ? order by notes.created desc', $userid);
}

function get_note($id)
{
  $db = new DbConn();
  return $db->query('select notes.*, admins.name as author from notes, admins where notes.adminid = admins.id and notes.id = ?', $id);
}

function add_note($userid, $adminid, $source, $content)
{
  $db = new DbConn();
  $db->exec('insert into notes (userid, adminid, source, content, created) values (?, ?, ?, ?, ?)',
            $userid, $adminid, $source, $content, date_create());
}

function delete_note($noteid)
{
  $db = new DbConn();
  $db->exec('delete from notes where id = ?', $noteid);
}

?>
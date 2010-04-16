<?php

define('LOG_USER_CREATED', 1);
define('LOG_USER_LOGIN', 2);
define('LOG_USER_STATE_CHANGE', 3);
define('LOG_NOTE_ADDED', 101);
define('LOG_NOTE_DELETED', 102);
define('LOG_TRAVEL_INFO_UPDATE', 201);
define('LOG_USER_DELETED', 301);

function log_event($messageId, $userId, $state=NULL)
{
  $CI =& get_instance();
  $CI->load->library('admin');
  $adminId = $CI->admin->id();
  if (!$adminId)
    $adminId = NULL;

  if (!$userId)
    $userId = NULL;

  $db = new DbConn();
  $db->exec('insert into event_log (messageid, userid, adminid, state) values (?, ?, ?, ?)',
            $messageId, $userId, $adminId, $state);
}

function get_log_events($userId=FALSE, $limit=FALSE)
{
  $db = new DbConn();

  $query = 'select event_log.*, users.firstname, users.lastname, admins.name as admin
                from event_log left join users on event_log.userid = users.id
                               left join admins on event_log.adminid = admins.id';
  if ($userId)
    $query = $query . ' where event_log.userid = ?';

  $query = $query . ' order by id desc';

  if ($limit)
  {
    $limit = (int)$limit;
    $query = $query . " limit $limit";
  }

  if ($userId)
    return $db->query($query, $userId);
  else
    return $db->query($query);
}

function format_log_event($event, $html=TRUE)
{
  if ($event->userid)
  {
    $displayName = ($event->firstname || $event->lastname) ? "$event->firstname $event->lastname" : "[User $event->userid]";
    if ($html)
      $user = anchor("admin/volunteers/show/$event->userid", $displayName);
    else if ($event->firstname || $event->lastname)
      $user = "[$event->userid] $displayName";
    else
      $user = $displayName;
  }
  else
    $user = '[UNKNOWN]';

  $byAdmin = $event->adminid ? " by $event->admin" : '';

  switch ($event->messageid)
  {
    case LOG_USER_CREATED:
      return "$user registered";
    case LOG_USER_LOGIN:
      return "$user logged in";
    case LOG_USER_STATE_CHANGE:
      $state = format_status((int)$event->state);
      return "$user moved to state $state" . $byAdmin;
    case LOG_NOTE_ADDED:
      return "$event->admin added a note to $user";
    case LOG_NOTE_DELETED:
      return "$event->admin deleted a note from $user";
    case LOG_TRAVEL_INFO_UPDATE:
      $details = $html ? "<pre>".htmlspecialchars($event->state)."</pre>" : $event->state;
      $delim = $html ? "<br/>" : "\n";
      return "$event->admin updated travel dates/details for $user$delim$details";
    case LOG_USER_DELETED:
      return "$event->admin deleted $user";
  }
}

?>
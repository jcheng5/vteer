<?php

# USE CASES:
# P1: Preview template e-mail to user
# P0: Send template e-mail to user
# P1: Preview template e-mail to dummy user
# P2: Send template e-mail to dummy user

$CI =& get_instance();
$CI->load->helper('html2text');

// E-mails to applicants
define('MAIL_INTRO', 1);
define('MAIL_CONFIRM_APP', 2);
define('MAIL_ACCEPTED', 3);
define('MAIL_DENIED', 4);
define('MAIL_ITINERARY_CONFIRMED', 5);
define('MAIL_TWO_MONTHS', 6);
define('MAIL_ONE_MONTH', 7);
define('MAIL_ONE_WEEK', 8);
define('MAIL_PASSWORD', 9);
// E-mails to administrators
define('ADMINMAIL_SUBMITTED_NOTIFICATION', 10);
define('ADMINMAIL_DECISION_DUE', 11);
define('ADMINMAIL_DECISION_OVERDUE', 12);
define('ADMINMAIL_CONFIRMATION_REMINDER', 13);

// Constants for DB field mail_template_versions.recipient
define('MAILRECIPIENT_APPLICANT', 1);
define('MAILRECIPIENT_ADMIN', 2);

function get_mail_templates()
{
  $db = new DbConn();
  $query = 'select mt.id, mtv.subject, mt.role
              from mail_templates as mt left join (mail_template_versions as mtv)
                on (mt.id = mtv.templateid)
              where mtv.id is null
                or mtv.id in (select max(id) from mail_template_versions where templateid = mt.id)';
  return $db->query($query);
}

/**
 * @param  $user_id
 * @param  $mail_id
 * @param DateTime $when The approximate date/time the e-mail should be sent
 * @param bool $allow_duplicates If false, won't schedule this e-mail if it has already been sent
 *    in the past, or if it's currently scheduled to be sent. If true, will schedule the e-mail
 *    no matter what. If NULL (or omitted) then the mail template's preferred setting will be used
 * @return void
 */
function schedule_mail($user_id, $mail_id, $when = FALSE, $allow_duplicates = NULL)
{
  $db = new DbConn();

  $template = get_mail_template($mail_id, TRUE);

  if ($allow_duplicates === FALSE || (is_null($allow_duplicates) && !$template->allowdupes))
  {
    $results = $db->query('select *
                           from mails_sent as ms, mail_template_versions as mtv
                           where ms.templateverid = mtv.id
                             and mtv.templateid = ?
                             and userid = ?', $mail_id, $user_id);
    if ($results->length > 0)
      return FALSE;

    $results = $db->query('select * from mails_scheduled where userid = ? and mailid = ?', $user_id, $mail_id);
    if ($results->length > 0)
      return FALSE;
  }

  if (!$when)
  {
    send_user_mail($template, $user_id);
    return TRUE;
  }
  else
  {
    $db->exec('insert into mails_scheduled (userid, mailid, due) values (?, ?, ?)',
              $user_id, $mail_id, $when);
    return TRUE;
  }
}

function send_mail($from, $to, $subject, $body)
{
  $CI =& get_instance();
  $CI->load->library('email');

  $CI->email->initialize(array('mailtype' => 'text'));
  $CI->email->clear(TRUE);
  $CI->email->from($from);
  $CI->email->to($to);
  $CI->email->subject($subject);
  $CI->email->message($body);
  $CI->email->send();
}

/**
 * $template_id - mail_templates.id
 * $user - User id or assoc array
 */
function send_user_mail($template, $user, $to = NULL)
{
  $CI =& get_instance();
  $CI->load->library('email');

  $mail_sender = $CI->config->item('mail_sender');

  if (!is_array($user))
  {
    $user = get_user_assoc($user);
  }

  if ($template->recipient == MAILRECIPIENT_ADMIN || $to)
  {
    $user['application_url'] = site_url('admin/volunteers/show/'.$user['id']);
  }

  $mail = render_mail($template, $user);

  $CI->email->initialize(array('mailtype' => 'html'));
  $CI->email->clear(TRUE);
  $CI->email->from($mail_sender);
  if ($to)
    $CI->email->to($to);
  else if ($template->recipient == MAILRECIPIENT_APPLICANT)
    $CI->email->to($user['email']);
  else if ($template->recipient == MAILRECIPIENT_ADMIN)
  {
    $CI->load->library('admin');
    // get all admin e-mails
    $emails = $CI->admin->get_admin_emails();
    $CI->email->to(implode(', ', $emails));
  }
  $CI->email->subject($mail->subject);
  $CI->email->message($mail->html);
  $CI->email->set_alt_message($mail->plaintext);

  /* The filenames that the attachments use on disk are not
     human-readable--they have IDs, not the original filenames.
     To restore the original filenames we must create a temp
     directory structure and then copy the files to the temp
     dir, attach from there, send the file, then clean up the
     temp dir. */
  $tmp = tempnam(sys_get_temp_dir(), 'vteer_mail_');
  if (!unlink($tmp) || !mkdir($tmp))
    throw new RuntimeException("Failed to create temp dir");

  while ($attachment = $template->attachments->next())
  {
    $filedata = make_attachment_path($attachment->id);
    $subtmp = $tmp.DIRECTORY_SEPARATOR.$attachment->id;
    $filetmp = $subtmp.DIRECTORY_SEPARATOR.$attachment->filename;
    if (!mkdir($subtmp) || !copy($filedata, $filetmp))
      throw new RuntimeException("Failed to attach file");
    $CI->email->attach($filetmp);
  }

  $CI->email->send();

  if ($template->recurrence)
  {
    schedule_mail($user['id'], $template->templateid, new DateTime($template->recurrence));
  }

  $db = new DbConn();
  $db->exec('insert into mails_sent (userid, templateverid, sent) values (?, ?, ?)',
            $user['id'],
            $template->id,
            date_create());

  deltree($tmp);
}

function deltree($dir)
{
  if ($dir == '')
    return FALSE;
  if (!is_dir($dir))
    return FALSE;

  if (substr($dir, strlen($dir) - 1) != DIRECTORY_SEPARATOR)
    $dir = $dir.DIRECTORY_SEPARATOR;

  $files = glob( $dir . '*', GLOB_MARK );
  foreach( $files as $file ){
    if( is_dir( $file ) )
      deltree( $file );
    else
      unlink( $file );
  }

  return rmdir( $dir );
}

function render_mail($template, $params)
{
  $template->html = replace_tokens($template->html, $params);
  $template->plaintext = replace_tokens($template->plaintext, $params);
  $template->subject = replace_tokens($template->subject, $params);

  return $template;
}

function replace_tokens($str, $params)
{
  foreach ($params as $key => $value)
  {
    $str = preg_replace("/\\#$key\\#/", $value, $str);
  }
  return $str;
}

function get_mail_template($template_id, $throw_on_not_found = FALSE)
{
  $mail_template = FALSE;

  if ($template_id)
  {
    $db = new DbConn();
    $mail_template = $db->fetch('select mtv.*, mt.role, mt.recipient, mt.allowdupes, mt.recurrence
                                 from mail_templates as mt
                                 left join (mail_template_versions as mtv)
                                 on mt.id = mtv.templateid
                                 where mt.id = ?
                                 order by id desc', $template_id);
  }

  if ($throw_on_not_found && !$mail_template)
    throw new RuntimeException("Mail template #$template_id not found");

  if ($mail_template)
  {
    $attachments = $db->query('select ma.id, ma.filename, ma.size
                                   from mail_attachments as ma, templatevers_to_attachments as t2a
                                   where ma.id = t2a.attachmentid and t2a.templateverid = ?',
                              $mail_template->id);

    $mail_template->attachments = $attachments;
  }

  return $mail_template;
}

# TODO: Plaintext representation contains extraneous tabs
function html_to_plaintext($html)
{
  $h2t = new html2text($html);
  return $h2t->get_text();
}

function make_attachment_path($fileId)
{
  return make_file_path(0, "mail$fileId");
}
?>
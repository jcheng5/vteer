<?php

# USE CASES:
# P1: Preview template e-mail to user
# P0: Send template e-mail to user
# P1: Preview template e-mail to dummy user
# P2: Send template e-mail to dummy user

require_once('Mail.php');
require_once('Mail/mime.php');
require_once("$lib/class.html2text.jmc.inc");

define('MAIL_INTRO', 1);
define('MAIL_CONFIRM_APP', 2);
define('MAIL_ACCEPTED', 3);
define('MAIL_DENIED', 4);
define('MAIL_ITINERARY_CONFIRMED', 5);
define('MAIL_TWO_MONTHS', 6);
define('MAIL_ONE_MONTH', 7);
define('MAIL_ONE_WEEK', 8);

function get_mail_templates()
{
   $db = new DbConn();
   $query = 'select mt.id, mt.name, mtv.subject
             from mail_templates as mt, mail_template_versions as mtv
             where mt.id = mtv.templateid
                     and mtv.id in (select max(id) from mail_template_versions where templateid = mt.id)';
   return $db->query($query);
}

function schedule_mail($user_id, $mail_id, $when=NULL)
{
   if (!$when)
      $when = new DateTime();

   $db = new DbConn();
   $db->exec('insert into mails_scheduled (userid, mailid, due) values (?, ?, ?)',
      $user_id, $mail_id, $when);
}

function send_mail($to, $headers, $body)
{
   global $mail_gmail_username, $mail_gmail_password;
   
   $sender =& Mail::factory('smtp', array(
      'host' => 'ssl://smtp.gmail.com',
      'port' => 465,
      'auth' => TRUE,
      'username' => $mail_gmail_username,
      'password' => $mail_gmail_password
      ));

   return $sender->send($to, $headers, $body);
}

/**
 * $template_id - mail_templates.id
 * $user - User id or assoc array
 */
function send_user_mail($template, $user, $to=NULL)
{
   global $mail_sender;

   if (!is_array($user))
   {
      $user = get_user_assoc($user);
   }

   $mail = render_mail($template, $user);
   
   $headers = array(
      'From' => $mail_sender,
      'Subject' => $mail->subject);
   
   $mime = new Mail_mime("\n");
   $mime->setTXTBody($mail->plaintext);
   $mime->setHTMLBody($mail->html);
   
   $body = $mime->get();
   $headers = $mime->headers($headers);
   
   if (!$to)
      $to = $user['email'];
      
   return send_mail($to, $headers, $body);
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
      $str = preg_replace("/\\\$$key\\\$/", $value, $str);
   }
   return $str;
}

function get_mail_template($template_id, $throw_on_not_found=FALSE)
{
   $mail_template = FALSE;
   
   if ($template_id)
   {
      $db = new DbConn();
      $mail_template = $db->fetch('select * from mail_template_versions where (templateid = ?) order by id desc', $template_id);
   }
   
   if ($throw_on_not_found && !$mail_template)
      throw new RuntimeException("Mail template #$template_id not found");
   
   return $mail_template;
}

# TODO: Plaintext representation contains extraneous tabs
function html_to_plaintext($html)
{
   $h2t = new html2text($html);
   return $h2t->get_text();
}

?>
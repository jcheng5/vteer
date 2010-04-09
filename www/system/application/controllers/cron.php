<?php

class Cron extends Controller
{

  function Cron()
  {
    parent::Controller();
  }

  function index()
  {
    $this->load->helper('mail');

    $db = new DbConn();
    $mails = $db->query('select * from mails_scheduled where due <= UTC_TIMESTAMP()');

    while ($mail = $mails->next())
    {
      $user_id = $mail->userid;
      $mail_id = $mail->mailid;

      $template = get_mail_template($mail_id, false);

      if (!$template)
      {
        continue;
      }

      send_user_mail($template, $user_id);

      $db->exec('delete from mails_scheduled where id = ?', $mail->id);
    }
  }
}

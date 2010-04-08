<?php

class Emails extends Controller
{

  function Emails()
  {
    parent::Controller();
    $this->load->library('admin');
    $this->admin->enforce();
  }

  function index($highlightid=FALSE)
  {
    $mails = get_mail_templates();

    $this->load->view('admin/header', array('title' => 'List E-mail Templates'));
    $this->load->view('admin/mail/list',
                      array('mails' => $mails,
                            'highlightid' => $highlightid));
    $this->load->view('admin/footer');
  }

  function compose($id=FALSE)
  {
    if ($id)
    {
      $id = (int)$id;
      $mailTemplate = get_mail_template($id, true);
      $subject = $mailTemplate->subject;
      $body = $mailTemplate->html;
    }
    else
    {
      $subject = '';
      $body = '';
    }


    $verb = $id ? 'Edit' : 'Create New';

    $this->load->view('admin/header', array('title' => "$verb E-mail Template"));
    $this->load->view('admin/mail/compose',
                      array('id' => $id,
                            'subject' => $subject,
                            'body' => $body));
    $this->load->view('admin/footer');
  }

  function update()
  {
    $this->load->helper('html2text');
    $id = $this->input->post('id');
    $subject = $this->input->post('subject');
    $htmlbody = $this->input->post('htmlbody');
    $textbody = html_to_plaintext($htmlbody);

    $db = new DbConn();

    if (!$id)
    {
      // New template
      $db->exec('insert into mail_templates () values ()');
      $id = $db->last_insert_id();
    }

    $rows = $db->exec('insert into mail_template_versions (templateid, subject, html, plaintext) values (?, ?, ?, ?)',
                      (int)$id, $subject, $htmlbody, $textbody);

    if ($rows != 1)
      throw new RuntimeException("Insertion failed!");

    redirect("admin/emails/index/$id");
  }
}

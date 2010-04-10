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
    $subject = '';
    $body = '';
    $attachments = FALSE;
    $role = FALSE;

    if ($id)
    {
      $id = (int)$id;
      $mailTemplate = get_mail_template($id, false);
      if ($mailTemplate)
      {
        $subject = $mailTemplate->subject;
        $body = $mailTemplate->html;
        $attachments = $mailTemplate->attachments;
        $role = $mailTemplate->role;
      }
    }

    $verb = $id ? 'Edit' : 'Create New';

    $this->load->view('admin/header', array('title' => "$verb E-mail Template"));
    $this->load->view('admin/mail/compose',
                      array('id' => $id,
                            'subject' => $subject,
                            'body' => $body,
                            'attachments' => $attachments,
                            'role' => $role));
    $this->load->view('admin/footer');
  }

  function update()
  {
    $this->load->helper('html2text');
    $id = $this->input->post('id');
    $subject = $this->input->post('subject');
    $htmlbody = $this->input->post('htmlbody');
    $textbody = html_to_plaintext($htmlbody);
    $attachments = $this->input->post('attachment');

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
    $newId = $db->last_insert_id();

    // process attachments
    if ($attachments)
    {
      foreach ($attachments as $attachId)
      {
        $attachId = (int)$attachId;
        $db->exec('insert into templatevers_to_attachments (templateverid, attachmentid) values (?, ?)',
                  $newId, $attachId);
      }
    }

    redirect("admin/emails/index/$id");
  }

  function attach()
  {
    $this->load->view('admin/header');
    $this->load->view('admin/mail/attach');
    $this->load->view('admin/footer');
  }

  function upload()
  {
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
      echo 'File upload failed';
      die($_FILES['file']['error']);
    }

    $filename = $_FILES['file']['name'];
    $filetype = $_FILES['file']['type'];
    $filesize = filesize($_FILES['file']['tmp_name']);

    $db = new DbConn();
    $db->exec('insert into mail_attachments (filename, type, size) values (?, ?, ?)',
              $filename, $filetype, $filesize);
    $fileId = $db->last_insert_id();

    $destfile = make_attachment_path($fileId);
    if (!move_uploaded_file($_FILES['file']['tmp_name'], $destfile))
      die('Upload failed');

    $this->load->view('admin/header');
    $this->load->view('admin/mail/uploaded',
                      array('fileid' => $fileId,
                            'filename' => $filename,
                            'filesize' => $filesize,
                            'filetype' => $filetype));
    $this->load->view('admin/footer');
  }

  function preview_attachment($attachId)
  {
    $db = new DbConn();
    $results = $db->query('select * from mail_attachments where id = ?', (int)$attachId);
    if ($results->length != 1)
      show_error("File not found", 404);

    $file = $results->next();
    $filename = $file->filename;
    $fileType = $file->type;
    if (!download_file(make_attachment_path($attachId), $filename, $fileType))
      show_error("File not found", 404);
  }
}

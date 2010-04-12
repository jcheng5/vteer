<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlentities(isset($title) ? $title : 'Living Hope'); ?></title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/admin.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/application.css"/>
  <?php $this->load->view('jquery'); ?>
  <script type="text/javascript">
    $(function() {
      $('.datepicker').datepicker( { dateFormat: 'MM d, yy',
                                     changeMonth: true,
                                     changeYear: true,
                                     showButtonPanel: true,
                                     showAnim: 'fadeIn' } );
      $('a.button').each(function()
      {
        new YAHOO.widget.Button(this);
      });
      $('button:not(.native)').each(function()
      {
        new YAHOO.widget.Button(this);
      });
    });
  </script>
  <?php $this->load->view('yui'); ?>
  <?php $this->load->view('googleanalytics'); ?>
</head>
<body class="yui-skin-sam">
<div id="pageframe">

  <?php if ($this->session->flashdata('message')): ?>
  <div id="flashdata">
    <?php  echo htmlspecialchars($this->session->flashdata('message')); ?>
  </div>
  <script type="text/javascript">
    setTimeout(function () {
      $('#flashdata').remove();
    }, 1500);
  </script>
  <?php endif; ?>
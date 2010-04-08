<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlentities(isset($title) ? $title : 'Living Hope'); ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/admin.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/application.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/redmond/jquery-ui-1.8.custom.css"/>
  <script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery-ui-1.8.custom.min.js"></script>
  <script type="text/javascript">
    $(function() {
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
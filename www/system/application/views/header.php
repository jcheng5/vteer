<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlentities(isset($title) ? $title : 'Living Hope Volunteer Application'); ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/application.css"/>
  <script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery.color.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>static/js/json2.js"></script>
  <?php //$this->load->view('yui'); ?>
  <?php $this->load->view('googleanalytics'); ?>
</head>
<body class="narrow">
<div id="pageframe">
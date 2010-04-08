<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlentities(isset($title) ? $title : 'Living Hope Volunteer Application'); ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/application.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/redmond/jquery-ui-1.8.custom.css"/>
  <script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery-ui-1.8.custom.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>static/js/json2.js"></script>
  <script type="text/javascript">
    $(function() {
      $('.datepicker').datepicker( { dateFormat: 'MM d, yy',
                                     changeMonth: true,
                                     changeYear: true,
                                     showButtonPanel: true } );
    });
  </script>
  <?php //$this->load->view('yui'); ?>
  <?php $this->load->view('googleanalytics'); ?>
</head>
<body class="narrow">
<div id="pageframe">
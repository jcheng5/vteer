<!DOCTYPE html>
<html>
<head>
   <title><?php echo htmlentities(isset($title) ? $title : 'Living Hope'); ?></title>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/admin.css" />
   <script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery-1.3.2.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery.color.js"></script>
   <?php $this->load->view('admin/yui'); ?>
</head>
<body class="yui-skin-sam">
<div id="pageframe">
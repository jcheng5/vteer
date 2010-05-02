<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlentities(isset($title) ? $title : 'Living Hope Volunteer Application'); ?></title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/application.css"/>
  <?php $this->load->view('jquery'); ?>
  <?php $this->load->view('yui'); ?>
  <script type="text/javascript" src="<?php echo base_url(); ?>static/js/json2.js"></script>
  <script type="text/javascript">
    window.date_select_handlers = {};
    $(function() {
      $('.datepicker').datepicker( { dateFormat: 'MM d, yy',
                                     changeMonth: true,
                                     changeYear: true,
                                     showButtonPanel: true,
                                     showAnim: 'fadeIn',
                                     onSelect: function(dateText, inst) {
                                       if (window.date_select_handlers[this.id])
                                         window.date_select_handlers[this.id](dateText, inst);
                                     }
                                   } );
      $('a.button').each(function() {
        new YAHOO.widget.Button(this);
      });
      $('button.yui').each(function() {
        new YAHOO.widget.Button(this);
      });
    });
  </script>
  <?php //$this->load->view('yui'); ?>
  <?php $this->load->view('googleanalytics'); ?>
  <style type="text/css">
  body {
    background: #053A66 url(<?php echo base_url()."static/images/page_bg.png"; ?>) top repeat-x;
  }
  #page {
    margin: 0 auto 0 auto;
    width: 924px;
  }
  #pageheader {
    position: relative;
    background: url(<?php echo base_url()."static/images/header.png"; ?>) no-repeat top center;
    width: 924px;
    height: 130px; 
  }
  #pagetop {
    background: url(<?php echo base_url()."static/images/main_top.png"; ?>) no-repeat top center;
    width: 100%;
    height: 35px;
  }
  #pagetile {
    width: 100%;
    background: url(<?php echo base_url()."static/images/main_bg.png"; ?>) repeat-y center;
  }
  #pageframe {
    min-height: 400px;
  }
  #pagebottom {
    background: url(<?php echo base_url()."static/images/main_bottom.png"; ?>) no-repeat top center;
    width: 100%;
    height: 35px;
  }
  .public .section {
    border: none;
  }
  #headergraphic a {
    text-decoration: none;
    position: absolute;
    top: 0;
    left: 10px;
    width: 340px;
    height: 90px;
  }
  .relative {
    position: relative;
    width: 100%;
    height: 100%;
  }
  .invisible {
    position: relative;
    left: -10000em;
  }
  </style>
</head>
<body class="narrow yui-skin-sam public">
<table id="page" cellspacing="0" cellpadding="0" border="0">
  <tr><td id="pageheader"><div class="relative">
    <h1 id="headergraphic"><a href="http://www.livinghope.co.za/"><span class="invisible">Living Hope</span></a></h1>
  </div></td></tr>
  <tr><td id="pagetop"></td></tr>
  <tr><td id="pagetile" valign="top">
  <div id="pageframe">
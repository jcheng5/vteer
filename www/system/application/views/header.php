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
</head>
<body class="narrow yui-skin-sam">
<div id="pageframe">
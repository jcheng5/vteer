<?php $this->load->view('header'); ?>

<script type="text/javascript" src="<?php echo site_url('apply/apply_js'); ?>"></script>

<form name="mainform" id="application" onsubmit="return false">

  <div id="identity">
    You're signed in as <strong><?php echo htmlspecialchars($user_email); ?></strong> |
    <a href="<?php echo htmlspecialchars($logout_link); ?>">Sign out</a>
  </div>
  
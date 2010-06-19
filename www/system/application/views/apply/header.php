<?php
  $this->load->view('header');
  
  function get_volunteer_coordinator_name()
  {
    $CI =& get_instance();
    $CI->load->library('admin');
    $volunteer_coordinator = $CI->admin->get_volunteer_coordinator();
    return $volunteer_coordinator->name;
  }
?>

<script type="text/javascript" src="<?php echo site_url('apply/apply_js'); ?>"></script>

<form name="mainform" id="application" onsubmit="return false">

  <div id="identity">
    You're signed in as <strong><?php echo htmlspecialchars($user_email); ?></strong> |
    <a href="<?php echo htmlspecialchars($logout_link); ?>">Sign out</a>
  </div>

  <div id="fileuploaddiv" style="display: none">
    <iframe id="fileuploadframe" src="javascript:false" style="width: 250px; height: 100px; border: none"></iframe>
  </div>
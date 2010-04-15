<script type="text/javascript">
  //<![CDATA[
  var existingInfo = downloadInfo();
  load(existingInfo);
  setInterval(function() {
    save(false, true);
  }, 60000);
  //]]>
</script>

<?php $this->load->view('footer'); ?>

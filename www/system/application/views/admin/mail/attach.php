<?php $this->load->helper('form'); ?>
<style type="text/css">
  div#pageframe {
    width: 100% !important;
  }
</style>

<form method="POST" enctype="multipart/form-data" action="<?php echo site_url('admin/emails/upload'); ?>">
  <p>Please choose a file to attach:</p>
  <input type="file" name="file"/>
  <br/>
  <br/>
  <button type="submit">Attach</button>
</form>
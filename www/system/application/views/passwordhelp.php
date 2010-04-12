<?php
$this->load->helper('form');
echo form_open('welcome/sendpassword');
?>

<h1>Forgot Your Password?</h1>

<p>No problem&mdash;just enter your e-mail address and we'll e-mail your password to you.</p>

<?php $this->load->view('error', array('error' => $error)); ?>

<div class="field">
  <label for="email">
    E-mail address
  </label>
  <br/>
  <input id="email" name="email" type="text" value="<?php echo set_value('email'); ?>" style="width: 250px"/>
</div>

<p><button type="submit" class="yui">Continue</button></p>

<?php echo form_close(); ?>
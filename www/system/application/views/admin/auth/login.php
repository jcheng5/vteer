<?php
$this->load->helper('form');
if (!isset($login_error))
  $login_error = FALSE;
?>

<h2>Administrator Sign In</h2>
<?php $this->load->view('error', array('error' => $login_error)); ?>

<?php echo form_open('admin/auth/verify'); ?>

<div class="field">
  <label for="username">Username</label>
  <br/>
  <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>"/>
</div>

<div class="field">
  <label for="password">Password</label>
  <br/>
  <input type="password" name="password" id="password" value=""/>
</div>

<div class="field">
  <input type="checkbox" name="persist" id="persist" <?php echo $this->input->post('persist') ? ' checked="checked"' : '' ?>/>
  <label for="persist">Keep me signed in until I sign out</label>
</div>

<?php
echo form_submit('', 'Log in');
echo form_close();
?>

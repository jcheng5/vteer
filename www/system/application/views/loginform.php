<?php
$this->load->helper('form');
$this->load->view('error', array('error' => $login_error));
?>

<?php echo form_open('welcome/login'); ?>

  <div class="field">
    <label for="login_email">
      E-mail address
    </label>
    <br/>
    <input id="login_email" name="login_email" type="text" value="<?php echo set_value('login_email'); ?>"/>
  </div>
  <div class="field">
    <label for="login_password">
      Password
    </label>
    <br/>
    <input id="login_password" name="login_password" type="password"/><br/>
    <?php echo anchor('welcome/passwordhelp', 'Forgot your password?'); ?>
  </div>
  <p><button class="yui" type="submit">Log in</button></p>
<?php echo form_close(); ?>

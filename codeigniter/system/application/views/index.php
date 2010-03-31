<?php
$this->load->helper('form');
if (!isset($register_error))
  $register_error = FALSE;
if (!isset($login_error))
  $login_error = FALSE;
?>

<style type="text/css">
h3 { font-weight: normal; }
input[type=text], input[type=password] { width: 250px; }
</style>

<h1>Living Hope Volunteer Application</h1>
<p>Thanks for your interest! Blah blah blah.</p>

<table><tr><td valign="top" style="padding-right: 6em">

<h3><strong>Let's get started!</strong></h3>
<?php $this->load->view('error', array('error' => $register_error)); ?>

<?php echo form_open('welcome/register'); ?>
  <div class="field">
    <label for="firstname">
      First name
    </label>
    <br />
    <input id="firstname" name="firstname" type="text" value="<?php echo set_value('firstname'); ?>" />
  </div>
  <div class="field">
    <label for="lastname">
      Surname
    </label>
    <br />
    <input id="lastname" name="lastname" type="text" value="<?php echo set_value('lastname'); ?>" />
  </div>
  <div class="field">
    <label for="email">
      E-mail address
    </label>
    <br />
    <input id="email" name="email" type="text" value="<?php echo set_value('email'); ?>" />
  </div>
  <div class="field">
    <label for="password">
      Password
    </label>
    <br />
    <input id="password" name="password" type="password" />
  </div>
  <div class="field">
    <label for="password2">
      Password (confirm)
    </label>
    <br />
    <input id="password2" name="password2" type="password" />
  </div>
  <p><input type="submit" value="Register" /></p>
<?php echo form_close(); ?>

</td><td valign="top">

<h3>Or, <strong>login to continue</strong> an application.</h3>

<?php $this->load->view('error', array('error' => $login_error)); ?>

<?php echo form_open('welcome/login'); ?>
  <div class="field">
    <label for="login_email">
      E-mail address
    </label>
    <br />
    <input id="login_email" name="login_email" type="text" value="<?php echo set_value('login_email'); ?>" />
  </div>
  <div class="field">
    <label for="login_password">
      Password
    </label>
    <br />
    <input id="login_password" name="login_password" type="password" />
  </div>
  <p><input type="submit" value="Log in" /></p>
<?php echo form_close(); ?>

</td></tr></table>
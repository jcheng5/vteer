<?php
$this->load->helper('form');
if (!isset($register_error))
  $register_error = FALSE;
if (!isset($login_error))
  $login_error = FALSE;
?>

<style type="text/css">
  h3 {
    font-weight: normal;
  }

  input[type=text], input[type=password] {
    width: 250px;
  }
</style>

<h2>Thank you for your interest in serving at Living Hope!</h2>
<p>Before you begin the application process, please take note of the following:</p>
<ul>
  <li>To complete the process, it will take 30-45 minutes</li>
  <li>You need to have your two letters of reference ready to load onto the web site with phone numbers</li>
  <li>You need to have a recent photo ready to loaded onto the web site.</li>
</ul>

<p>The application process does not guarantee you a position or specified dates. Upon receiving your application, the
  management will review your information, contact your references, and send you a letter stating your acceptance or
  denial.</p>
<p>If you have additional questions regarding our ministry before you apply, please visit our <a
    href="http://www.livinghope.co.za" target="_blank">web site</a> or send an email
  to <a href="mailto:mike@livinghope.co.za" target="_blank">mike@livinghope.co.za</a>. Specific questions regarding
  volunteer positions
  or opportunities will be answered upon receiving your application. For an overview of these positions and our various
  ministries, please click here <span style="background-color: yellow">(where?)</span>. A basic understanding of Living
  Hope will assist you in filling out the application.</p>
<p>Unless other arrangements are made, all accommodations and transportation needs for both individual and team
  volunteers are handled by <a href="http://www.actsoverland.com/" target="_blank">ACTS (African Christian Tours and
    Safaris)</a>. This arrangement has proved to be the most
  effective and cost efficient, and allows our volunteers to be assured of safe, suitable accommodations, reliable
  transportation and well-prepared meals. We are flexible to facilitate alternative arrangements for volunteers longer
  than 6 months. All arrangements, including additional information will be taken care of upon the acceptance of an
  application.</p>
<p>When completing the application form below, please give details of what skills you have and if there is any
  preference for the type of work you would like to be involved in during your time of ministry with us. Ultimately our
  goal is for you to come with a desire to serve our Father through our ministry in whatever area there is a need. We
  trust you come with that same desire to see Him glorified in whatever you do here.</p>
<p>Please note that Doctors, Dentists, Nurses and professional Counselors need to be registered with the South African
  Medical & Dental Council in order to practice in South Africa. This process can take some months.</p>
<p>However, Social Workers, nurses, physical therapists, and some others can work at Living Hope under the direct
  supervision of our resident professionals. For medical professionals who wish to serve with us in South Africa and
  become certified to practice here for a minimum service commitment of 12 months, Living Hope will gladly assist you in
  the certification process and handle any items that need hands-on care while you are still in your home country. This
  process takes from 12 to 24 months, but we will work to expedite the process where we can.</p>
<p>While we do not have a children's home or orphanage, there are many orphaned children in the surrounding communities
  and the children's clubs in which we serve. We work to instill life skills and biblical values into their lives to
  help them make good choices and protect them from becoming victims of HIV/AIDS. In the case of orphaned children, we
  make every attempt to find extended family for the children. If this is not possible, our social worker will endeavour
  to place them with a family in the community.</p>
<p>Thank you so much and God bless.</p>

<table>
  <tr>
    <td valign="top" style="padding-right: 6em">

    <h3><strong>Let's get started!</strong></h3>
    <?php $this->load->view('error', array('error' => $register_error)); ?>

    <?php echo form_open('welcome/register'); ?>

      <div class="field">
        <label for="firstname">
          First name
        </label>
        <br/>
        <input id="firstname" name="firstname" type="text" value="<?php echo set_value('firstname'); ?>"/>
      </div>
      <div class="field">
        <label for="lastname">
          Surname
        </label>
        <br/>
        <input id="lastname" name="lastname" type="text" value="<?php echo set_value('lastname'); ?>"/>
      </div>
      <div class="field">
        <label for="email">
          E-mail address
        </label>
        <br/>
        <input id="email" name="email" type="text" value="<?php echo set_value('email'); ?>"/>
      </div>
      <div class="field">
        <label for="password">
          Password
        </label>
        <br/>
        <input id="password" name="password" type="password"/>
      </div>
      <div class="field">
        <label for="password2">
          Password (confirm)
        </label>
        <br/>
        <input id="password2" name="password2" type="password"/>
      </div>
      <p><button class="yui" type="submit">Register</button></p>
    <?php echo form_close(); ?>

    </td>
    <td valign="top" nowrap="nowrap">

      <h3>Or, <strong>login to continue</strong> an application.</h3>

    <?php $this->load->view('error', array('error' => $login_error)); ?>

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
        <input id="login_password" name="login_password" type="password"/>
      </div>
      <p><button class="yui" type="submit">Log in</button></p>
    <?php echo form_close(); ?>

    </td>
  </tr>
</table>
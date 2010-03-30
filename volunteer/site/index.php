<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>Living Hope</title>
    <link href="stylesheets/application.css" media="all" rel="stylesheet" type="text/css"/>
    <script language="javascript" src="javascripts/nav.js" type="text/javascript"></script><script language="javascript" src="javascripts/json2.js" type="text/javascript"></script><script language="javascript" src="javascripts/jquery-1.3.2.min.js" type="text/javascript"></script>
  </head>
  <body>
    <h1>Living Hope Volunteer Application</h1>
    <p>Thanks for your interest! Blah blah blah.</p>
    <h3>Let's get started!</h3>
    <script type="text/javascript">
      //<![CDATA[
        // dummy handler arrays--will never be used
        load_handlers = [];
        save_handlers = [];
      //]]>
    </script>
    <form action="register.php" method="POST">
      <div class="field">
        <label for="firstname">
          First name
        </label>
        <br />
        <input id="firstname" name="firstname" type="text" />
        <script type="text/javascript">
          //<![CDATA[
            load_handlers.push(function (info) {
              var val = info['firstname'] || '';
              $('#firstname').get(0).value = val;
            });
            save_handlers.push(function (info, form) {
              info['firstname'] = $('#firstname').get(0).value;
            });
          //]]>
        </script>
      </div>
      <div class="field">
        <label for="lastname">
          Surname
        </label>
        <br />
        <input id="lastname" name="lastname" type="text" />
        <script type="text/javascript">
          //<![CDATA[
            load_handlers.push(function (info) {
              var val = info['lastname'] || '';
              $('#lastname').get(0).value = val;
            });
            save_handlers.push(function (info, form) {
              info['lastname'] = $('#lastname').get(0).value;
            });
          //]]>
        </script>
      </div>
      <div class="field">
        <label for="email">
          E-mail address
        </label>
        <br />
        <input id="email" name="email" type="text" />
        <script type="text/javascript">
          //<![CDATA[
            load_handlers.push(function (info) {
              var val = info['email'] || '';
              $('#email').get(0).value = val;
            });
            save_handlers.push(function (info, form) {
              info['email'] = $('#email').get(0).value;
            });
          //]]>
        </script>
      </div>
      <div class="field">
        <label for="password">
          Password
        </label>
        <br />
        <input id="password" name="password" type="password" />
        <script type="text/javascript">
          //<![CDATA[
            load_handlers.push(function (info) {
              var val = info['password'] || '';
              $('#password').get(0).value = val;
            });
            save_handlers.push(function (info, form) {
              info['password'] = $('#password').get(0).value;
            });
          //]]>
        </script>
      </div>
      <div class="field">
        <label for="password2">
          Password (confirm)
        </label>
        <br />
        <input id="password2" name="password2" type="password" />
        <script type="text/javascript">
          //<![CDATA[
            load_handlers.push(function (info) {
              var val = info['password2'] || '';
              $('#password2').get(0).value = val;
            });
            save_handlers.push(function (info, form) {
              info['password2'] = $('#password2').get(0).value;
            });
          //]]>
        </script>
      </div>
      <p>
        <input type="submit" value="Register" />
      </p>
    </form>
    <h3>Or, continue an application that's in progress...</h3>
    <form action="login.php" method="POST">
      <div class="field">
        <label for="email">
          E-mail address
        </label>
        <br />
        <input id="email" name="email" type="text" />
        <script type="text/javascript">
          //<![CDATA[
            load_handlers.push(function (info) {
              var val = info['email'] || '';
              $('#email').get(0).value = val;
            });
            save_handlers.push(function (info, form) {
              info['email'] = $('#email').get(0).value;
            });
          //]]>
        </script>
      </div>
      <div class="field">
        <label for="password">
          Password
        </label>
        <br />
        <input id="password" name="password" type="password" />
        <script type="text/javascript">
          //<![CDATA[
            load_handlers.push(function (info) {
              var val = info['password'] || '';
              $('#password').get(0).value = val;
            });
            save_handlers.push(function (info, form) {
              info['password'] = $('#password').get(0).value;
            });
          //]]>
        </script>
      </div>
      <p>
        <input type="submit" value="Log in" />
      </p>
    </form>
  </body>
</html>
<div class="section">
  <h2>References</h2>
  <h4>
    Please list four people we can contact as references. They must include your pastor, a friend, your employer, and one other person in leadership over you.
    <strong id="twoletters">
      Please submit a reference letter from at least two of those people together with your application.
    </strong>
  </h4>
  <div class="reference">
    <h3>
      <label for="pastor">
        Pastor Reference
      </label>
    </h3>
    <div class="field">
      <label for="pastor_name">
        Name
        *
      </label>
      <br />
      <input id="pastor_name" name="pastor_name" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['pastor_name'] || '';
            $('#pastor_name').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['pastor_name'] = $('#pastor_name').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'pastor_name'))
            {
              error_field_required('pastor_name');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="pastor_address">
        Address
        *
      </label>
      <br />
      <textarea cols="30" id="pastor_address" name="pastor_address" rows="3"></textarea>
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['pastor_address'] || '';
            $('#pastor_address').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['pastor_address'] = $('#pastor_address').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'pastor_address'))
            {
              error_field_required('pastor_address');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="pastor_phone">
        Phone
        *
      </label>
      <br />
      <input id="pastor_phone" name="pastor_phone" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['pastor_phone'] || '';
            $('#pastor_phone').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['pastor_phone'] = $('#pastor_phone').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'pastor_phone'))
            {
              error_field_required('pastor_phone');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="pastor_email">
        E-mail
        *
      </label>
      <br />
      <input id="pastor_email" name="pastor_email" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['pastor_email'] || '';
            $('#pastor_email').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['pastor_email'] = $('#pastor_email').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'pastor_email'))
            {
              error_field_required('pastor_email');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="pastor_letter">
        Reference Letter
      </label>
      <br />
      <div class="nofile" id="pastor_letter-nofile">
        <span>
          <i>(None attached)</i>
        </span>
        <button id="pastor_letter-attach" type="button">
          Attach File
        </button>
      </div>
      <div class="hasfile" id="pastor_letter-hasfile">
        <a href="#" id="pastor_letter-link" target="_blank"></a>
        <button id="pastor_letter-remove" onclick="javascript:if (detach_file('pastor_letter')) {$('#pastor_letter-nofile').get(0).style.display = 'inline'; $('#pastor_letter-hasfile').get(0).style.display = 'none'; }" type="button">
          Remove File
        </button>
      </div>
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function(info) {
            var val = info['pastor_letter'];
            var link = $('#pastor_letter-link').get(0);
            link.href = "<?php echo site_url('apply/download/pastor_letter') ?>"; // TODO
            if (val) {
              link.innerText = val['name'];
              $('#pastor_letter-nofile').get(0).style.display = 'none';
              $('#pastor_letter-hasfile').get(0).style.display = 'inline';
            }
            else {
              $('#pastor_letter-nofile').get(0).style.display = 'inline';
              $('#pastor_letter-hasfile').get(0).style.display = 'none';
            }
          });
          save_handlers.push(function(info) {
            // info['pastor_letter'] = value;
          });
          $('#pastor_letter-attach').get(0).onclick = function() {
            // TODO: pass field label, not just ID
            var childWindow = window.open('<?php echo site_url('apply/attach/pastor_letter'); ?>', 'vteer_attach', 'height=200,width=350,location=0,menubar=0,resizable=0,scrollbars=0,status=1,titlebar=1,toolbar=0');
            child_windows.push(childWindow);
          };
        //]]>
      </script>
    </div>
  </div>
  <div class="reference">
    <h3>
      <label for="friend">
        Friend Reference
      </label>
    </h3>
    <div class="field">
      <label for="friend_name">
        Name
        *
      </label>
      <br />
      <input id="friend_name" name="friend_name" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['friend_name'] || '';
            $('#friend_name').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['friend_name'] = $('#friend_name').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'friend_name'))
            {
              error_field_required('friend_name');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="friend_address">
        Address
        *
      </label>
      <br />
      <textarea cols="30" id="friend_address" name="friend_address" rows="3"></textarea>
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['friend_address'] || '';
            $('#friend_address').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['friend_address'] = $('#friend_address').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'friend_address'))
            {
              error_field_required('friend_address');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="friend_phone">
        Phone
        *
      </label>
      <br />
      <input id="friend_phone" name="friend_phone" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['friend_phone'] || '';
            $('#friend_phone').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['friend_phone'] = $('#friend_phone').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'friend_phone'))
            {
              error_field_required('friend_phone');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="friend_email">
        E-mail
        *
      </label>
      <br />
      <input id="friend_email" name="friend_email" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['friend_email'] || '';
            $('#friend_email').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['friend_email'] = $('#friend_email').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'friend_email'))
            {
              error_field_required('friend_email');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="friend_letter">
        Reference Letter
      </label>
      <br />
      <div class="nofile" id="friend_letter-nofile">
        <span>
          <i>(None attached)</i>
        </span>
        <button id="friend_letter-attach" type="button">
          Attach File
        </button>
      </div>
      <div class="hasfile" id="friend_letter-hasfile">
        <a href="#" id="friend_letter-link" target="_blank"></a>
        <button id="friend_letter-remove" onclick="javascript:if (detach_file('friend_letter')) {$('#friend_letter-nofile').get(0).style.display = 'inline'; $('#friend_letter-hasfile').get(0).style.display = 'none'; }" type="button">
          Remove File
        </button>
      </div>
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function(info) {
            var val = info['friend_letter'];
            var link = $('#friend_letter-link').get(0);
            link.href = "<?php echo site_url('apply/download/friend_letter') ?>"; // TODO
            if (val) {
              link.innerText = val['name'];
              $('#friend_letter-nofile').get(0).style.display = 'none';
              $('#friend_letter-hasfile').get(0).style.display = 'inline';
            }
            else {
              $('#friend_letter-nofile').get(0).style.display = 'inline';
              $('#friend_letter-hasfile').get(0).style.display = 'none';
            }
          });
          save_handlers.push(function(info) {
            // info['friend_letter'] = value;
          });
          $('#friend_letter-attach').get(0).onclick = function() {
            // TODO: pass field label, not just ID
            var childWindow = window.open('<?php echo site_url('apply/attach/friend_letter'); ?>', 'vteer_attach', 'height=200,width=350,location=0,menubar=0,resizable=0,scrollbars=0,status=1,titlebar=1,toolbar=0');
            child_windows.push(childWindow);
          };
        //]]>
      </script>
    </div>
  </div>
  <div class="reference">
    <h3>
      <label for="employer">
        Employer Reference
      </label>
    </h3>
    <div class="field">
      <label for="employer_name">
        Name
        *
      </label>
      <br />
      <input id="employer_name" name="employer_name" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['employer_name'] || '';
            $('#employer_name').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['employer_name'] = $('#employer_name').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'employer_name'))
            {
              error_field_required('employer_name');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="employer_address">
        Address
        *
      </label>
      <br />
      <textarea cols="30" id="employer_address" name="employer_address" rows="3"></textarea>
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['employer_address'] || '';
            $('#employer_address').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['employer_address'] = $('#employer_address').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'employer_address'))
            {
              error_field_required('employer_address');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="employer_phone">
        Phone
        *
      </label>
      <br />
      <input id="employer_phone" name="employer_phone" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['employer_phone'] || '';
            $('#employer_phone').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['employer_phone'] = $('#employer_phone').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'employer_phone'))
            {
              error_field_required('employer_phone');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="employer_email">
        E-mail
        *
      </label>
      <br />
      <input id="employer_email" name="employer_email" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['employer_email'] || '';
            $('#employer_email').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['employer_email'] = $('#employer_email').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'employer_email'))
            {
              error_field_required('employer_email');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="employer_letter">
        Reference Letter
      </label>
      <br />
      <div class="nofile" id="employer_letter-nofile">
        <span>
          <i>(None attached)</i>
        </span>
        <button id="employer_letter-attach" type="button">
          Attach File
        </button>
      </div>
      <div class="hasfile" id="employer_letter-hasfile">
        <a href="#" id="employer_letter-link" target="_blank"></a>
        <button id="employer_letter-remove" onclick="javascript:if (detach_file('employer_letter')) {$('#employer_letter-nofile').get(0).style.display = 'inline'; $('#employer_letter-hasfile').get(0).style.display = 'none'; }" type="button">
          Remove File
        </button>
      </div>
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function(info) {
            var val = info['employer_letter'];
            var link = $('#employer_letter-link').get(0);
            link.href = "<?php echo site_url('apply/download/employer_letter') ?>"; // TODO
            if (val) {
              link.innerText = val['name'];
              $('#employer_letter-nofile').get(0).style.display = 'none';
              $('#employer_letter-hasfile').get(0).style.display = 'inline';
            }
            else {
              $('#employer_letter-nofile').get(0).style.display = 'inline';
              $('#employer_letter-hasfile').get(0).style.display = 'none';
            }
          });
          save_handlers.push(function(info) {
            // info['employer_letter'] = value;
          });
          $('#employer_letter-attach').get(0).onclick = function() {
            // TODO: pass field label, not just ID
            var childWindow = window.open('<?php echo site_url('apply/attach/employer_letter'); ?>', 'vteer_attach', 'height=200,width=350,location=0,menubar=0,resizable=0,scrollbars=0,status=1,titlebar=1,toolbar=0');
            child_windows.push(childWindow);
          };
        //]]>
      </script>
    </div>
  </div>
  <div class="reference">
    <h3>
      <label for="leader">
        Other Leadership Reference
      </label>
    </h3>
    <div class="field">
      <label for="leader_name">
        Name
        *
      </label>
      <br />
      <input id="leader_name" name="leader_name" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['leader_name'] || '';
            $('#leader_name').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['leader_name'] = $('#leader_name').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'leader_name'))
            {
              error_field_required('leader_name');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="leader_address">
        Address
        *
      </label>
      <br />
      <textarea cols="30" id="leader_address" name="leader_address" rows="3"></textarea>
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['leader_address'] || '';
            $('#leader_address').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['leader_address'] = $('#leader_address').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'leader_address'))
            {
              error_field_required('leader_address');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="leader_phone">
        Phone
        *
      </label>
      <br />
      <input id="leader_phone" name="leader_phone" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['leader_phone'] || '';
            $('#leader_phone').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['leader_phone'] = $('#leader_phone').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'leader_phone'))
            {
              error_field_required('leader_phone');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="leader_email">
        E-mail
        *
      </label>
      <br />
      <input id="leader_email" name="leader_email" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['leader_email'] || '';
            $('#leader_email').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['leader_email'] = $('#leader_email').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'leader_email'))
            {
              error_field_required('leader_email');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="leader_letter">
        Reference Letter
      </label>
      <br />
      <div class="nofile" id="leader_letter-nofile">
        <span>
          <i>(None attached)</i>
        </span>
        <button id="leader_letter-attach" type="button">
          Attach File
        </button>
      </div>
      <div class="hasfile" id="leader_letter-hasfile">
        <a href="#" id="leader_letter-link" target="_blank"></a>
        <button id="leader_letter-remove" onclick="javascript:if (detach_file('leader_letter')) {$('#leader_letter-nofile').get(0).style.display = 'inline'; $('#leader_letter-hasfile').get(0).style.display = 'none'; }" type="button">
          Remove File
        </button>
      </div>
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function(info) {
            var val = info['leader_letter'];
            var link = $('#leader_letter-link').get(0);
            link.href = "<?php echo site_url('apply/download/leader_letter') ?>"; // TODO
            if (val) {
              link.innerText = val['name'];
              $('#leader_letter-nofile').get(0).style.display = 'none';
              $('#leader_letter-hasfile').get(0).style.display = 'inline';
            }
            else {
              $('#leader_letter-nofile').get(0).style.display = 'inline';
              $('#leader_letter-hasfile').get(0).style.display = 'none';
            }
          });
          save_handlers.push(function(info) {
            // info['leader_letter'] = value;
          });
          $('#leader_letter-attach').get(0).onclick = function() {
            // TODO: pass field label, not just ID
            var childWindow = window.open('<?php echo site_url('apply/attach/leader_letter'); ?>', 'vteer_attach', 'height=200,width=350,location=0,menubar=0,resizable=0,scrollbars=0,status=1,titlebar=1,toolbar=0');
            child_windows.push(childWindow);
          };
        //]]>
      </script>
    </div>
  </div>
</div>
<div class="section">
  <h2>Emergency Information</h2>
  <div class="field">
    <label for="emcontact">
      Emergency Contact Name
      *
    </label>
    <br />
    <input id="emcontact" name="emcontact" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['emcontact'] || '';
          $('#emcontact').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['emcontact'] = $('#emcontact').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'emcontact'))
          {
            error_field_required('emcontact');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="emrelationship">
      Relationship
      *
    </label>
    <br />
    <input id="emrelationship" name="emrelationship" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['emrelationship'] || '';
          $('#emrelationship').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['emrelationship'] = $('#emrelationship').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'emrelationship'))
          {
            error_field_required('emrelationship');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="emphone1">
      Phone Number
      *
    </label>
    <br />
    <input id="emphone1" name="emphone1" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['emphone1'] || '';
          $('#emphone1').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['emphone1'] = $('#emphone1').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'emphone1'))
          {
            error_field_required('emphone1');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="emphone2">
      Alternate Phone Number
    </label>
    <br />
    <input id="emphone2" name="emphone2" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['emphone2'] || '';
          $('#emphone2').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['emphone2'] = $('#emphone2').get(0).value;
        });
      //]]>
    </script>
    
  </div>
</div>
<script type="text/javascript">
  //<![CDATA[
    validation_handlers.push(function(info) {
      if ($('div.hasfile:hidden').length > 2) {
        $('#twoletters').addClass('error_required');
        return false;
      }
      return true;
    });
  //]]>
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>Living Hope</title>
    <link href="stylesheets/application.css" media="all" rel="stylesheet" type="text/css"/>
    <script language="javascript" src="javascripts/nav.js" type="text/javascript"></script><script language="javascript" src="javascripts/json2.js" type="text/javascript"></script><script language="javascript" src="javascripts/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      //<![CDATA[
        if (typeof(Array.prototype.indexOf) == 'undefined') {
          Array.prototype.indexOf = function(value, start) {
            if (typeof(start) == 'undefined')
              start = 0;
            for (var i = start; i < this.length; i++) {
              if (this[i] == value)
                return i;
            }
            return -1;
          }
        }
        
        function getHTTPObject() {
          if (typeof XMLHttpRequest != 'undefined') {
            return new XMLHttpRequest();
          }
          try {
            return new ActiveXObject("Msxml2.XMLHTTP");
          }
          catch (e) {
            try {
              return new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
          }
          alert("An unexpected error has occurred--your browser may not be supported");
          return null;
        }
        
        function syncExplain(baseId) {
          var display = $('#' + baseId + '-yes').get(0).checked ? 'block' : 'none';
          $('#' + baseId + '-explaincontainer').css('display', display);
        }
        
        function uploadInfo(info) {
          var xhr = getHTTPObject();
          xhr.open('POST', 'update.php', false);
          xhr.send(info);
          if (xhr.status == 200)
            return true;
          alert("Error while saving: " + xhr.responseText);
          return false;
        }
        
        function downloadInfo() {
          var xhr = getHTTPObject();
          xhr.open('GET', 'retrieve.php', false);
          xhr.send(null);
          if (xhr.readyState==4 && xhr.status==200) {
            return JSON.parse(xhr.responseText);
          }
          else {
            alert("Couldn't load existing data!\n" + xhr.responseText);
            return null;
          }
        }
        
        function save() {
          var info = {};
          for (var i = 0; i < save_handlers.length; i++) {
            save_handlers[i](info, document.mainform);
          }
          // Replacer function is a hack to work around this IE8 bug:
          // http://blogs.msdn.com/jscript/archive/2009/06/23/serializing-the-value-of-empty-dom-elements-using-native-json-in-ie8.aspx
          var payload = JSON.stringify(info, function(k, v) { return v === "" ? "" : v });
          //console.log(payload);
          return uploadInfo(payload);
        }
        
        function load(info) {
          for (var i = 0; i < load_handlers.length; i++) {
            load_handlers[i](info, document.mainform);
          }
        }
        
        function finish() {
          var xhr = getHTTPObject();
          xhr.open('GET', 'submit.php', false);
          xhr.send(null);
          if (xhr.readyState==4 && xhr.status==200) {
            location.href = 'success.html';
          }
          else {
            alert("Unable to submit application:\n" + xhr.responseText);
            return null;
          }
        }
        
        load_handlers = [];
        save_handlers = [];
        child_windows = [];
        
        function closeChildWindows() {
          for (var i = 0; i < child_windows.length; i++)
            child_windows[i].close();
        }
      //]]>
    </script>
  </head>
  <body onunload="closeChildWindows();">
    <form name="mainform">
      <div class="section">
        <h2>Basic Information</h2>
        <div class="field">
          <label for="firstname">
            First Name
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
          <label for="dob">
            Date of birth
          </label>
          <br />
          <input id="dob" name="dob" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['dob'] || '';
                $('#dob').get(0).value = val;
              });
              save_handlers.push(function (info) {
                info['dob'] = $('#dob').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="gender">
            Gender
          </label>
          <br />
          <input id="gender0" name="gender" type="radio" value="Male" />
          <label class="option" for="gender0">
            Male
          </label>
          <input id="gender1" name="gender" type="radio" value="Female" />
          <label class="option" for="gender1">
            Female
          </label>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info, form) {
                var val = info['gender'];
                var options = form.elements['gender'];
                for (var i = 0; i < options.length; i++) {
                  if (options[i].value == val) {
                    options[i].checked = true;
                    break;
                  }
                }
              });
              save_handlers.push(function (info, form) {
                var options = form.elements['gender'];
                var value = '';
                for (var i = 0; i < options.length; i++) {
                  if (options[i].checked) {
                    value = options[i].value;
                    break;
                  }
                }
                info['gender'] = value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="marital">
            Marital Status
          </label>
          <br />
          <input id="marital0" name="marital" type="radio" value="Single" />
          <label class="option" for="marital0">
            Single
          </label>
          <input id="marital1" name="marital" type="radio" value="Married" />
          <label class="option" for="marital1">
            Married
          </label>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info, form) {
                var val = info['marital'];
                var options = form.elements['marital'];
                for (var i = 0; i < options.length; i++) {
                  if (options[i].value == val) {
                    options[i].checked = true;
                    break;
                  }
                }
              });
              save_handlers.push(function (info, form) {
                var options = form.elements['marital'];
                var value = '';
                for (var i = 0; i < options.length; i++) {
                  if (options[i].checked) {
                    value = options[i].value;
                    break;
                  }
                }
                info['marital'] = value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="ssn">
            Social Security # or ID #
          </label>
          <br />
          <input id="ssn" name="ssn" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['ssn'] || '';
                $('#ssn').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['ssn'] = $('#ssn').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="nickname">
            What you like to be called (name you go by)
          </label>
          <br />
          <input id="nickname" name="nickname" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['nickname'] || '';
                $('#nickname').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['nickname'] = $('#nickname').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="address">
            Mailing Address
          </label>
          <br />
          <textarea cols="30" id="address" name="address" rows="3"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['address'] || '';
                $('#address').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['address'] = $('#address').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="phone">
            Telephone
          </label>
          <br />
          <input id="phone" name="phone" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['phone'] || '';
                $('#phone').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['phone'] = $('#phone').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="fax">
            Fax
          </label>
          <br />
          <input id="fax" name="fax" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['fax'] || '';
                $('#fax').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['fax'] = $('#fax').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="email">
            E-mail
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
          <label for="referrer">
            How did you hear about our ministry?
          </label>
          <br />
          <select id="referrer" name="referrer">
            <option value=""></option>
            <option>
              ACTS
            </option>
            <option>
              African Encounter
            </option>
            <option>
              Living Hope
            </option>
            <option>
              Friend
            </option>
            <option>
              I am a former volunteer
            </option>
            <option>
              Through my local church
            </option>
            <option>
              Internet Living Hope/Way/Grace
            </option>
            <option>
              Internet ACTS
            </option>
            <option>
              Internet African Encounter
            </option>
            <option>
              Other
            </option>
          </select>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info, form) {
                var val = info['referrer'];
                var select = form.elements['referrer'];
                for (var i = 0; i < select.options.length; i++) {
                  if (select.options[i].value == val) {
                    select.selectedIndex = i;
                    break;
                  }
                }
              });
              save_handlers.push(function (info, form) {
                var select = form.elements['referrer'];
                if (select.selectedIndex >= 0)
                  info['referrer'] = select.options[select.selectedIndex].value;
                else
                  info['referrer'] = '';
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Preferred Dates</h2>
        <h4>Please indicate when you would like to visit. Since there are many factors involved in scheduling volunteers, please indicate your first, second, and third preferences for working with Living Hope. We have a minimum service time commitment of 30 days.</h4>
        <div class="field">
          <label for="dates1-from">
            First preference of dates
          </label>
          <br />
          <input id="dates1-from" name="dates1-from" />
          <input id="dates1-to" name="dates1-to" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['dates1'] || [null, null];
                $('#dates1-from').get(0).value = val[0] || '';
                $('#dates1-to').get(0).value = val[1] || '';
              });
              save_handlers.push(function (info) {
                info['dates1'] = [$('#dates1-from').get(0).value, $('#dates1-to').get(0).value];
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="dates2-from">
            Second preference of dates
          </label>
          <br />
          <input id="dates2-from" name="dates2-from" />
          <input id="dates2-to" name="dates2-to" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['dates2'] || [null, null];
                $('#dates2-from').get(0).value = val[0] || '';
                $('#dates2-to').get(0).value = val[1] || '';
              });
              save_handlers.push(function (info) {
                info['dates2'] = [$('#dates2-from').get(0).value, $('#dates2-to').get(0).value];
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="dates3-from">
            Third preference of dates
          </label>
          <br />
          <input id="dates3-from" name="dates3-from" />
          <input id="dates3-to" name="dates3-to" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['dates3'] || [null, null];
                $('#dates3-from').get(0).value = val[0] || '';
                $('#dates3-to').get(0).value = val[1] || '';
              });
              save_handlers.push(function (info) {
                info['dates3'] = [$('#dates3-from').get(0).value, $('#dates3-to').get(0).value];
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Transport</h2>
        <h4>Please note that there is no public transportation in our area.</h4>
        <div class="field">
          <label for="transport">
            Will you have your own transportation? (Do you plan to rent or purchase a car?)
          </label>
          <br />
          <input id="transport-yes" name="transport" type="radio" value="Yes" />
          <label class="option" for="transport-yes">
            Yes
          </label>
          <input id="transport-no" name="transport" type="radio" value="No" />
          <label class="option" for="transport-no">
            No
          </label>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function(info) {
                var val = info['transport'];
                $('#transport-yes').get(0).checked = (val === 'Yes');
                $('#transport-no').get(0).checked = (val === 'No');
              });
              save_handlers.push(function(info) {
                var value;
                if ($('#transport-yes').get(0).checked)
                  value = 'Yes';
                else if ($('#transport-no').get(0).checked)
                  value = 'No';
                else
                  value = '';
                
                info['transport'] = value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="license">
            Do you have an international driver's license?
          </label>
          <br />
          <input id="license-yes" name="license" type="radio" value="Yes" />
          <label class="option" for="license-yes">
            Yes
          </label>
          <input id="license-no" name="license" type="radio" value="No" />
          <label class="option" for="license-no">
            No
          </label>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function(info) {
                var val = info['license'];
                $('#license-yes').get(0).checked = (val === 'Yes');
                $('#license-no').get(0).checked = (val === 'No');
              });
              save_handlers.push(function(info) {
                var value;
                if ($('#license-yes').get(0).checked)
                  value = 'Yes';
                else if ($('#license-no').get(0).checked)
                  value = 'No';
                else
                  value = '';
                
                info['license'] = value;
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Education</h2>
        <div class="field">
          <label for="educationlevel">
            Highest level of education completed
          </label>
          <br />
          <select id="educationlevel" name="educationlevel">
            <option value=""></option>
            <option>
              Some high school
            </option>
            <option>
              High school diploma or equivalent
            </option>
            <option>
              Some college
            </option>
            <option>
              Associate Degree
            </option>
            <option>
              Bachelor Degree
            </option>
            <option>
              Advanced Degree
            </option>
          </select>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info, form) {
                var val = info['educationlevel'];
                var select = form.elements['educationlevel'];
                for (var i = 0; i < select.options.length; i++) {
                  if (select.options[i].value == val) {
                    select.selectedIndex = i;
                    break;
                  }
                }
              });
              save_handlers.push(function (info, form) {
                var select = form.elements['educationlevel'];
                if (select.selectedIndex >= 0)
                  info['educationlevel'] = select.options[select.selectedIndex].value;
                else
                  info['educationlevel'] = '';
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="schools">
            List any post-high school institutions attended, as well as the dates attended, degrees attained, and major/minor fields of study.
          </label>
          <br />
          <textarea cols="40" id="schools" name="schools" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['schools'] || '';
                $('#schools').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['schools'] = $('#schools').get(0).value;
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Career History</h2>
        <div class="field">
          <label for="occupation">
            Present Occupation
          </label>
          <br />
          <input id="occupation" name="occupation" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['occupation'] || '';
                $('#occupation').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['occupation'] = $('#occupation').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="employer">
            Company/Organization
          </label>
          <br />
          <input id="employer" name="employer" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['employer'] || '';
                $('#employer').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['employer'] = $('#employer').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="datehired">
            Date Hired
          </label>
          <br />
          <input id="datehired" name="datehired" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['datehired'] || '';
                $('#datehired').get(0).value = val;
              });
              save_handlers.push(function (info) {
                info['datehired'] = $('#datehired').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="employercontact">
            Contact &amp; Phone
          </label>
          <br />
          <input id="employercontact" name="employercontact" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['employercontact'] || '';
                $('#employercontact').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['employercontact'] = $('#employercontact').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="career">
            Briefly describe your career history and tell us how this relates to your ministry.
          </label>
          <br />
          <textarea cols="40" id="career" name="career" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['career'] || '';
                $('#career').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['career'] = $('#career').get(0).value;
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Ministry</h2>
        <div class="field">
          <label for="crosscultural">
            Do you have experience in cross-cultural ministry?
          </label>
          <br />
          <input id="crosscultural-yes" name="crosscultural" type="radio" value="Yes" />
          <label class="option" for="crosscultural-yes">
            Yes
          </label>
          <input id="crosscultural-no" name="crosscultural" type="radio" value="No" />
          <label class="option" for="crosscultural-no">
            No
          </label>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function(info) {
                var val = info['crosscultural'];
                $('#crosscultural-yes').get(0).checked = (val === 'Yes');
                $('#crosscultural-no').get(0).checked = (val === 'No');
              });
              save_handlers.push(function(info) {
                var value;
                if ($('#crosscultural-yes').get(0).checked)
                  value = 'Yes';
                else if ($('#crosscultural-no').get(0).checked)
                  value = 'No';
                else
                  value = '';
                
                info['crosscultural'] = value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="travel">
            List the countries you have been to, including the dates, the organization(s) you traveled with, the types of ministry you were involved in, and any leadership positions you held.
          </label>
          <br />
          <textarea cols="70" id="travel" name="travel" rows="12"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['travel'] || '';
                $('#travel').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['travel'] = $('#travel').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="ministry">
            List any other formal ministry experience you have had and leadership positions you have held. For each, list the organization/church, responsibilities, and dates.
          </label>
          <br />
          <textarea cols="70" id="ministry" name="ministry" rows="12"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['ministry'] || '';
                $('#ministry').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['ministry'] = $('#ministry').get(0).value;
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Church</h2>
        <div class="field">
          <label for="church">
            Name of your home church
          </label>
          <br />
          <input id="church" name="church" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['church'] || '';
                $('#church').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['church'] = $('#church').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="churchaddress">
            Address
          </label>
          <br />
          <textarea cols="30" id="churchaddress" name="churchaddress" rows="3"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['churchaddress'] || '';
                $('#churchaddress').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['churchaddress'] = $('#churchaddress').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="churchphone">
            Phone
          </label>
          <br />
          <input id="churchphone" name="churchphone" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['churchphone'] || '';
                $('#churchphone').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['churchphone'] = $('#churchphone').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="pastor">
            Senior Pastor
          </label>
          <br />
          <input id="pastor" name="pastor" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['pastor'] || '';
                $('#pastor').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['pastor'] = $('#pastor').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="attendance">
            Length of time in attendance
          </label>
          <br />
          <input id="attendance" name="attendance" type="text" />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['attendance'] || '';
                $('#attendance').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['attendance'] = $('#attendance').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="involvement">
            Describe your involvement
          </label>
          <br />
          <textarea cols="40" id="involvement" name="involvement" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['involvement'] || '';
                $('#involvement').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['involvement'] = $('#involvement').get(0).value;
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Health</h2>
        <div class="field">
          <label for="healthissues">
            Do you have any physical handicaps, disabilities, or diseases that might affect your ability to fully function in remote areas or harsh conditions?
          </label>
          <br />
          <input id="healthissues-yes" name="healthissues" onclick="syncExplain('healthissues')" type="radio" value="Yes" />
          <label class="option" for="healthissues-yes">
            Yes
          </label>
          <input id="healthissues-no" name="healthissues" onclick="syncExplain('healthissues')" type="radio" value="No" />
          <label class="option" for="healthissues-no">
            No
          </label>
          <div class="explain" id="healthissues-explaincontainer">
            <div class="field">
              <label for="healthissues-explain">
                If yes, please explain
              </label>
              <br />
              <textarea cols="40" id="healthissues-explain" name="healthissues-explain" rows="5"></textarea>
              <script type="text/javascript">
                //<![CDATA[
                  load_handlers.push(function (info) {
                    var val = info['healthissues-explain'] || '';
                    $('#healthissues-explain').get(0).value = val;
                  });
                  save_handlers.push(function (info, form) {
                    info['healthissues-explain'] = $('#healthissues-explain').get(0).value;
                  });
                //]]>
              </script>
            </div>
          </div>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function(info) {
                var val = info['healthissues'];
                $('#healthissues-yes').get(0).checked = (val === 'Yes');
                $('#healthissues-no').get(0).checked = (val === 'No');
                syncExplain('healthissues');
              });
              save_handlers.push(function (info) {
                var value;
                if ($('#healthissues-yes').get(0).checked)
                  value = 'Yes';
                else if ($('#healthissues-no').get(0).checked)
                  value = 'No';
                else
                  value = '';
                
                info['healthissues'] = value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="chronicconditions">
            Do you have any chronic illnesses or allergies?
          </label>
          <br />
          <input id="chronicconditions-yes" name="chronicconditions" onclick="syncExplain('chronicconditions')" type="radio" value="Yes" />
          <label class="option" for="chronicconditions-yes">
            Yes
          </label>
          <input id="chronicconditions-no" name="chronicconditions" onclick="syncExplain('chronicconditions')" type="radio" value="No" />
          <label class="option" for="chronicconditions-no">
            No
          </label>
          <div class="explain" id="chronicconditions-explaincontainer">
            <div class="field">
              <label for="chronicconditions-explain">
                If yes, please explain
              </label>
              <br />
              <textarea cols="40" id="chronicconditions-explain" name="chronicconditions-explain" rows="5"></textarea>
              <script type="text/javascript">
                //<![CDATA[
                  load_handlers.push(function (info) {
                    var val = info['chronicconditions-explain'] || '';
                    $('#chronicconditions-explain').get(0).value = val;
                  });
                  save_handlers.push(function (info, form) {
                    info['chronicconditions-explain'] = $('#chronicconditions-explain').get(0).value;
                  });
                //]]>
              </script>
            </div>
          </div>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function(info) {
                var val = info['chronicconditions'];
                $('#chronicconditions-yes').get(0).checked = (val === 'Yes');
                $('#chronicconditions-no').get(0).checked = (val === 'No');
                syncExplain('chronicconditions');
              });
              save_handlers.push(function (info) {
                var value;
                if ($('#chronicconditions-yes').get(0).checked)
                  value = 'Yes';
                else if ($('#chronicconditions-no').get(0).checked)
                  value = 'No';
                else
                  value = '';
                
                info['chronicconditions'] = value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="foodallergies">
            Do you have any food or drug related allergies?
          </label>
          <br />
          <input id="foodallergies-yes" name="foodallergies" onclick="syncExplain('foodallergies')" type="radio" value="Yes" />
          <label class="option" for="foodallergies-yes">
            Yes
          </label>
          <input id="foodallergies-no" name="foodallergies" onclick="syncExplain('foodallergies')" type="radio" value="No" />
          <label class="option" for="foodallergies-no">
            No
          </label>
          <div class="explain" id="foodallergies-explaincontainer">
            <div class="field">
              <label for="foodallergies-explain">
                If yes, please explain
              </label>
              <br />
              <textarea cols="40" id="foodallergies-explain" name="foodallergies-explain" rows="5"></textarea>
              <script type="text/javascript">
                //<![CDATA[
                  load_handlers.push(function (info) {
                    var val = info['foodallergies-explain'] || '';
                    $('#foodallergies-explain').get(0).value = val;
                  });
                  save_handlers.push(function (info, form) {
                    info['foodallergies-explain'] = $('#foodallergies-explain').get(0).value;
                  });
                //]]>
              </script>
            </div>
          </div>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function(info) {
                var val = info['foodallergies'];
                $('#foodallergies-yes').get(0).checked = (val === 'Yes');
                $('#foodallergies-no').get(0).checked = (val === 'No');
                syncExplain('foodallergies');
              });
              save_handlers.push(function (info) {
                var value;
                if ($('#foodallergies-yes').get(0).checked)
                  value = 'Yes';
                else if ($('#foodallergies-no').get(0).checked)
                  value = 'No';
                else
                  value = '';
                
                info['foodallergies'] = value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="otherhealth">
            Do you have any other medical problems that we should be aware of?
          </label>
          <br />
          <input id="otherhealth-yes" name="otherhealth" onclick="syncExplain('otherhealth')" type="radio" value="Yes" />
          <label class="option" for="otherhealth-yes">
            Yes
          </label>
          <input id="otherhealth-no" name="otherhealth" onclick="syncExplain('otherhealth')" type="radio" value="No" />
          <label class="option" for="otherhealth-no">
            No
          </label>
          <div class="explain" id="otherhealth-explaincontainer">
            <div class="field">
              <label for="otherhealth-explain">
                If yes, please explain
              </label>
              <br />
              <textarea cols="40" id="otherhealth-explain" name="otherhealth-explain" rows="5"></textarea>
              <script type="text/javascript">
                //<![CDATA[
                  load_handlers.push(function (info) {
                    var val = info['otherhealth-explain'] || '';
                    $('#otherhealth-explain').get(0).value = val;
                  });
                  save_handlers.push(function (info, form) {
                    info['otherhealth-explain'] = $('#otherhealth-explain').get(0).value;
                  });
                //]]>
              </script>
            </div>
          </div>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function(info) {
                var val = info['otherhealth'];
                $('#otherhealth-yes').get(0).checked = (val === 'Yes');
                $('#otherhealth-no').get(0).checked = (val === 'No');
                syncExplain('otherhealth');
              });
              save_handlers.push(function (info) {
                var value;
                if ($('#otherhealth-yes').get(0).checked)
                  value = 'Yes';
                else if ($('#otherhealth-no').get(0).checked)
                  value = 'No';
                else
                  value = '';
                
                info['otherhealth'] = value;
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Personal History</h2>
        <div class="field">
          <label for="alcoholdrugs">
            Do you use alcohol or drugs?
          </label>
          <br />
          <input id="alcoholdrugs-yes" name="alcoholdrugs" onclick="syncExplain('alcoholdrugs')" type="radio" value="Yes" />
          <label class="option" for="alcoholdrugs-yes">
            Yes
          </label>
          <input id="alcoholdrugs-no" name="alcoholdrugs" onclick="syncExplain('alcoholdrugs')" type="radio" value="No" />
          <label class="option" for="alcoholdrugs-no">
            No
          </label>
          <div class="explain" id="alcoholdrugs-explaincontainer">
            <div class="field">
              <label for="alcoholdrugs-explain">
                If yes, please explain
              </label>
              <br />
              <textarea cols="40" id="alcoholdrugs-explain" name="alcoholdrugs-explain" rows="5"></textarea>
              <script type="text/javascript">
                //<![CDATA[
                  load_handlers.push(function (info) {
                    var val = info['alcoholdrugs-explain'] || '';
                    $('#alcoholdrugs-explain').get(0).value = val;
                  });
                  save_handlers.push(function (info, form) {
                    info['alcoholdrugs-explain'] = $('#alcoholdrugs-explain').get(0).value;
                  });
                //]]>
              </script>
            </div>
          </div>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function(info) {
                var val = info['alcoholdrugs'];
                $('#alcoholdrugs-yes').get(0).checked = (val === 'Yes');
                $('#alcoholdrugs-no').get(0).checked = (val === 'No');
                syncExplain('alcoholdrugs');
              });
              save_handlers.push(function (info) {
                var value;
                if ($('#alcoholdrugs-yes').get(0).checked)
                  value = 'Yes';
                else if ($('#alcoholdrugs-no').get(0).checked)
                  value = 'No';
                else
                  value = '';
                
                info['alcoholdrugs'] = value;
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Biographical Information</h2>
        <div class="field">
          <label for="conversion">
            How and when did you become a Christian?
          </label>
          <br />
          <textarea cols="40" id="conversion" name="conversion" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['conversion'] || '';
                $('#conversion').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['conversion'] = $('#conversion').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="lifechange">
            Describe how your life has changed.
          </label>
          <br />
          <textarea cols="40" id="lifechange" name="lifechange" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['lifechange'] || '';
                $('#lifechange').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['lifechange'] = $('#lifechange').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="history">
            Please write a brief overview of your personal history (where you grew up, childhood experiences, and how these affect your life now).
          </label>
          <br />
          <textarea cols="70" id="history" name="history" rows="12"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['history'] || '';
                $('#history').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['history'] = $('#history').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="strength">
            What would others say is your strongest quality, and why?
          </label>
          <br />
          <textarea cols="40" id="strength" name="strength" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['strength'] || '';
                $('#strength').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['strength'] = $('#strength').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="weakness">
            What would others say is your weakest quality, and why?
          </label>
          <br />
          <textarea cols="40" id="weakness" name="weakness" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['weakness'] || '';
                $('#weakness').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['weakness'] = $('#weakness').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="submission">
            When do you find it difficult to submit to others?
          </label>
          <br />
          <textarea cols="40" id="submission" name="submission" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['submission'] || '';
                $('#submission').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['submission'] = $('#submission').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="churchhistory">
            Describe your personal church history (various ones you've attended, why you switched, etc.).
          </label>
          <br />
          <textarea cols="70" id="churchhistory" name="churchhistory" rows="12"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['churchhistory'] || '';
                $('#churchhistory').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['churchhistory'] = $('#churchhistory').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="faith">
            Describe your personal &quot;statement of faith.&quot; What do you believe?
          </label>
          <br />
          <textarea cols="70" id="faith" name="faith" rows="12"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['faith'] || '';
                $('#faith').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['faith'] = $('#faith').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="southafrica">
            Do you feel specifically called to South Africa? Explain.
          </label>
          <br />
          <textarea cols="40" id="southafrica" name="southafrica" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['southafrica'] || '';
                $('#southafrica').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['southafrica'] = $('#southafrica').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="fiveyearplan">
            Where do you want to be in five years? What is your personal vision for your life and ministry?
          </label>
          <br />
          <textarea cols="40" id="fiveyearplan" name="fiveyearplan" rows="5"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['fiveyearplan'] || '';
                $('#fiveyearplan').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['fiveyearplan'] = $('#fiveyearplan').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="calling">
            Explain how and why you feel God is calling you to be part of Living Hope. Also include what area of ministry you would specifically like to get involved in and how you see yourself fitting in.
          </label>
          <br />
          <textarea cols="70" id="calling" name="calling" rows="12"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['calling'] || '';
                $('#calling').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['calling'] = $('#calling').get(0).value;
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="gifts">
            Please check all areas you consider yourself gifted in
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              save_handlers.push(function (info) {
                info['gifts'] = [];
              });
            //]]>
          </script>
          <input id="gifts0" name="gifts" type="checkbox" value="Sports" />
          <label class="option" for="gifts0">
            Sports
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['gifts'];
                $('#gifts0').get(0).checked = (typeof(val) != 'undefined')
                                                 && (val.indexOf('Sports') >= 0);
              });
              save_handlers.push(function (info) {
                var values = [];
                if ($('#gifts0').get(0).checked)
                  info['gifts'].push('Sports')
              });
            //]]>
          </script>
          <input id="gifts1" name="gifts" type="checkbox" value="Administration" />
          <label class="option" for="gifts1">
            Administration
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['gifts'];
                $('#gifts1').get(0).checked = (typeof(val) != 'undefined')
                                                 && (val.indexOf('Administration') >= 0);
              });
              save_handlers.push(function (info) {
                var values = [];
                if ($('#gifts1').get(0).checked)
                  info['gifts'].push('Administration')
              });
            //]]>
          </script>
          <input id="gifts2" name="gifts" type="checkbox" value="Children" />
          <label class="option" for="gifts2">
            Children
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['gifts'];
                $('#gifts2').get(0).checked = (typeof(val) != 'undefined')
                                                 && (val.indexOf('Children') >= 0);
              });
              save_handlers.push(function (info) {
                var values = [];
                if ($('#gifts2').get(0).checked)
                  info['gifts'].push('Children')
              });
            //]]>
          </script>
          <input id="gifts3" name="gifts" type="checkbox" value="Healthcare" />
          <label class="option" for="gifts3">
            Healthcare
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['gifts'];
                $('#gifts3').get(0).checked = (typeof(val) != 'undefined')
                                                 && (val.indexOf('Healthcare') >= 0);
              });
              save_handlers.push(function (info) {
                var values = [];
                if ($('#gifts3').get(0).checked)
                  info['gifts'].push('Healthcare')
              });
            //]]>
          </script>
          <input id="gifts4" name="gifts" type="checkbox" value="Photography" />
          <label class="option" for="gifts4">
            Photography
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['gifts'];
                $('#gifts4').get(0).checked = (typeof(val) != 'undefined')
                                                 && (val.indexOf('Photography') >= 0);
              });
              save_handlers.push(function (info) {
                var values = [];
                if ($('#gifts4').get(0).checked)
                  info['gifts'].push('Photography')
              });
            //]]>
          </script>
          <input id="gifts5" name="gifts" type="checkbox" value="Landscaping" />
          <label class="option" for="gifts5">
            Landscaping
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['gifts'];
                $('#gifts5').get(0).checked = (typeof(val) != 'undefined')
                                                 && (val.indexOf('Landscaping') >= 0);
              });
              save_handlers.push(function (info) {
                var values = [];
                if ($('#gifts5').get(0).checked)
                  info['gifts'].push('Landscaping')
              });
            //]]>
          </script>
          <input id="gifts6" name="gifts" type="checkbox" value="Construction or Maintenance" />
          <label class="option" for="gifts6">
            Construction or Maintenance
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['gifts'];
                $('#gifts6').get(0).checked = (typeof(val) != 'undefined')
                                                 && (val.indexOf('Construction or Maintenance') >= 0);
              });
              save_handlers.push(function (info) {
                var values = [];
                if ($('#gifts6').get(0).checked)
                  info['gifts'].push('Construction or Maintenance')
              });
            //]]>
          </script>
          <input id="gifts7" name="gifts" type="checkbox" value="Music" />
          <label class="option" for="gifts7">
            Music
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['gifts'];
                $('#gifts7').get(0).checked = (typeof(val) != 'undefined')
                                                 && (val.indexOf('Music') >= 0);
              });
              save_handlers.push(function (info) {
                var values = [];
                if ($('#gifts7').get(0).checked)
                  info['gifts'].push('Music')
              });
            //]]>
          </script>
          <input id="gifts8" name="gifts" type="checkbox" value="Schoolteacher" />
          <label class="option" for="gifts8">
            Schoolteacher
          </label>
          <br />
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['gifts'];
                $('#gifts8').get(0).checked = (typeof(val) != 'undefined')
                                                 && (val.indexOf('Schoolteacher') >= 0);
              });
              save_handlers.push(function (info) {
                var values = [];
                if ($('#gifts8').get(0).checked)
                  info['gifts'].push('Schoolteacher')
              });
            //]]>
          </script>
        </div>
        <div class="field">
          <label for="leadgifts">
            Of the areas you checked, please note which ones you would consider yourself strong enough to lead a team in projects within this area.
          </label>
          <br />
          <textarea cols="30" id="leadgifts" name="leadgifts" rows="3"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['leadgifts'] || '';
                $('#leadgifts').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['leadgifts'] = $('#leadgifts').get(0).value;
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Volunteer Positions</h2>
        <div style="color:red">TODO</div>
      </div>
      <div class="section">
        <h2>References</h2>
        <h4>
          Please list four people we can contact as references. They must include your pastor, a friend, your employer, and one other person in leadership over you.
          <strong>
            Please submit a reference letter from at least two of those people together with your application.
            <span style="color:red">TODO</span>
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
          </div>
          <div class="field">
            <label for="pastor_address">
              Address
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
          </div>
          <div class="field">
            <label for="pastor_phone">
              Phone
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
          </div>
          <div class="field">
            <label for="pastor_email">
              E-mail
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
          </div>
          <div class="field">
            <label for="pastor_letter">
              Reference Letter
            </label>
            <br />
            <div id="pastor_letter-nofile">
              <span>
                <i>(None attached)</i>
              </span>
              <button id="pastor_letter-attach" type="button">
                Attach File
              </button>
            </div>
            <div id="pastor_letter-hasfile">
              <a href="#" id="pastor_letter-link" target="_blank"></a>
              <button id="pastor_letter-remove" type="button">
                Remove File
              </button>
            </div>
            <script type="text/javascript">
              //<![CDATA[
                load_handlers.push(function(info) {
                  var val = info['pastor_letter'];
                  if (val) {
                    var link = $('#pastor_letter-link').get(0);
                    link.href = '#'; // TODO
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
                  var childWindow = window.open('attach.php?id=pastor_letter', 'vteer_attach', 'height=200,width=350,location=0,menubar=0,resizable=0,scrollbars=0,status=1,titlebar=1,toolbar=0');
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
          </div>
          <div class="field">
            <label for="friend_address">
              Address
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
          </div>
          <div class="field">
            <label for="friend_phone">
              Phone
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
          </div>
          <div class="field">
            <label for="friend_email">
              E-mail
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
          </div>
          <div class="field">
            <label for="friend_letter">
              Reference Letter
            </label>
            <br />
            <div id="friend_letter-nofile">
              <span>
                <i>(None attached)</i>
              </span>
              <button id="friend_letter-attach" type="button">
                Attach File
              </button>
            </div>
            <div id="friend_letter-hasfile">
              <a href="#" id="friend_letter-link" target="_blank"></a>
              <button id="friend_letter-remove" type="button">
                Remove File
              </button>
            </div>
            <script type="text/javascript">
              //<![CDATA[
                load_handlers.push(function(info) {
                  var val = info['friend_letter'];
                  if (val) {
                    var link = $('#friend_letter-link').get(0);
                    link.href = '#'; // TODO
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
                  var childWindow = window.open('attach.php?id=friend_letter', 'vteer_attach', 'height=200,width=350,location=0,menubar=0,resizable=0,scrollbars=0,status=1,titlebar=1,toolbar=0');
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
          </div>
          <div class="field">
            <label for="employer_address">
              Address
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
          </div>
          <div class="field">
            <label for="employer_phone">
              Phone
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
          </div>
          <div class="field">
            <label for="employer_email">
              E-mail
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
          </div>
          <div class="field">
            <label for="employer_letter">
              Reference Letter
            </label>
            <br />
            <div id="employer_letter-nofile">
              <span>
                <i>(None attached)</i>
              </span>
              <button id="employer_letter-attach" type="button">
                Attach File
              </button>
            </div>
            <div id="employer_letter-hasfile">
              <a href="#" id="employer_letter-link" target="_blank"></a>
              <button id="employer_letter-remove" type="button">
                Remove File
              </button>
            </div>
            <script type="text/javascript">
              //<![CDATA[
                load_handlers.push(function(info) {
                  var val = info['employer_letter'];
                  if (val) {
                    var link = $('#employer_letter-link').get(0);
                    link.href = '#'; // TODO
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
                  var childWindow = window.open('attach.php?id=employer_letter', 'vteer_attach', 'height=200,width=350,location=0,menubar=0,resizable=0,scrollbars=0,status=1,titlebar=1,toolbar=0');
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
          </div>
          <div class="field">
            <label for="leader_address">
              Address
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
          </div>
          <div class="field">
            <label for="leader_phone">
              Phone
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
          </div>
          <div class="field">
            <label for="leader_email">
              E-mail
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
          </div>
          <div class="field">
            <label for="leader_letter">
              Reference Letter
            </label>
            <br />
            <div id="leader_letter-nofile">
              <span>
                <i>(None attached)</i>
              </span>
              <button id="leader_letter-attach" type="button">
                Attach File
              </button>
            </div>
            <div id="leader_letter-hasfile">
              <a href="#" id="leader_letter-link" target="_blank"></a>
              <button id="leader_letter-remove" type="button">
                Remove File
              </button>
            </div>
            <script type="text/javascript">
              //<![CDATA[
                load_handlers.push(function(info) {
                  var val = info['leader_letter'];
                  if (val) {
                    var link = $('#leader_letter-link').get(0);
                    link.href = '#'; // TODO
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
                  var childWindow = window.open('attach.php?id=leader_letter', 'vteer_attach', 'height=200,width=350,location=0,menubar=0,resizable=0,scrollbars=0,status=1,titlebar=1,toolbar=0');
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
        </div>
        <div class="field">
          <label for="emrelationship">
            Relationship
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
        </div>
        <div class="field">
          <label for="emphone1">
            Phone Number
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
      <div class="section">
        <h2>Comments/Concerns</h2>
        <div class="field">
          <label for="comments">
            Please note any additional comments or concerns you have.
          </label>
          <br />
          <textarea cols="70" id="comments" name="comments" rows="12"></textarea>
          <script type="text/javascript">
            //<![CDATA[
              load_handlers.push(function (info) {
                var val = info['comments'] || '';
                $('#comments').get(0).value = val;
              });
              save_handlers.push(function (info, form) {
                info['comments'] = $('#comments').get(0).value;
              });
            //]]>
          </script>
        </div>
      </div>
      <div class="section">
        <h2>Application Commitment</h2>
        <div class="commitment">
          <p>I hereby commit myself to serving with FHBCCT (should my application be accepted) in whichever area I am designated by Management. I understand that I am a volunteer and that I will not be receiving any financial reimbursement for the work that I do while at FHBCCT. I commit myself to abide by the policies and procedures of the FHBCCT and to the mission, aims and objectives of the organization.</p>
          <div class="field">
            <label for="signature">
              Signature (type your full name)
            </label>
            <br />
            <input id="signature" name="signature" type="text" />
            <script type="text/javascript">
              //<![CDATA[
                load_handlers.push(function (info) {
                  var val = info['signature'] || '';
                  $('#signature').get(0).value = val;
                });
                save_handlers.push(function (info, form) {
                  info['signature'] = $('#signature').get(0).value;
                });
              //]]>
            </script>
          </div>
          <div class="field">
            <label for="signaturedate">
              Today's Date
            </label>
            <br />
            <input id="signaturedate" name="signaturedate" type="text" />
            <script type="text/javascript">
              //<![CDATA[
                load_handlers.push(function (info) {
                  var val = info['signaturedate'] || '';
                  $('#signaturedate').get(0).value = val;
                });
                save_handlers.push(function (info, form) {
                  info['signaturedate'] = $('#signaturedate').get(0).value;
                });
              //]]>
            </script>
          </div>
        </div>
      </div>
      <div class="section">
        <h2>Statement of Faith</h2>
        <div class="statementoffaith"></div>
      </div>
    </form>
    <script type="text/javascript">
      //<![CDATA[
        var existingInfo = downloadInfo();
        load(existingInfo);
        setInterval(save, 3000);
      //]]>
    </script>
  </body>
</html>

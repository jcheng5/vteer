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
      <div class="nav">
        <button disabled="disabled" onclick="if (save()) nav(0)" type="button">
          Previous page
        </button>
        &nbsp; Page 1 of 6 &nbsp;
        <button onclick="if (save()) nav(2)" type="button">
          <b>Next page</b>
        </button>
      </div>
      <div class="section">
        <h2>Basic Information</h2>
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
      <div class="nav">
        <button disabled="disabled" onclick="if (save()) nav(0)" type="button">
          Previous page
        </button>
        &nbsp; Page 1 of 6 &nbsp;
        <button onclick="if (save()) nav(2)" type="button">
          <b>Next page</b>
        </button>
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

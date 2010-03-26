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
        <button onclick="if (save()) nav(1)" type="button">
          Previous page
        </button>
        &nbsp; Page 2 of 6 &nbsp;
        <button onclick="if (save()) nav(3)" type="button">
          <b>Next page</b>
        </button>
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
      <div class="nav">
        <button onclick="if (save()) nav(1)" type="button">
          Previous page
        </button>
        &nbsp; Page 2 of 6 &nbsp;
        <button onclick="if (save()) nav(3)" type="button">
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

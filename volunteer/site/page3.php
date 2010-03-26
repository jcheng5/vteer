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
        <button onclick="if (save()) nav(2)" type="button">
          Previous page
        </button>
        &nbsp; Page 3 of 6 &nbsp;
        <button onclick="if (save()) nav(4)" type="button">
          <b>Next page</b>
        </button>
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
      <div class="nav">
        <button onclick="if (save()) nav(2)" type="button">
          Previous page
        </button>
        &nbsp; Page 3 of 6 &nbsp;
        <button onclick="if (save()) nav(4)" type="button">
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

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
        <button onclick="if (save()) nav(5)" type="button">
          Previous page
        </button>
        &nbsp; Page 6 of 6 &nbsp;
        <button onclick="if (save()) finish()" type="button">
          <b>Submit application</b>
        </button>
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
      <div class="nav">
        <button onclick="if (save()) nav(5)" type="button">
          Previous page
        </button>
        &nbsp; Page 6 of 6 &nbsp;
        <button onclick="if (save()) finish()" type="button">
          <b>Submit application</b>
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

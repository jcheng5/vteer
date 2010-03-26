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
      <h2>Thank you</h2>
      <p>Your application has been submitted successfully! TODO</p>
    </form>
  </body>
</html>

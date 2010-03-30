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
        <button onclick="if (save()) nav(4)" type="button">
          Previous page
        </button>
        &nbsp; Page 5 of 6 &nbsp;
        <button onclick="if (save()) nav(6)" type="button">
          <b>Next page</b>
        </button>
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
      <div class="nav">
        <button onclick="if (save()) nav(4)" type="button">
          Previous page
        </button>
        &nbsp; Page 5 of 6 &nbsp;
        <button onclick="if (save()) nav(6)" type="button">
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
<?php header('Content-type: text/javascript'); ?>
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
  xhr.open('POST', '<?php echo site_url('apply/update'); ?>', false);
  xhr.send(info);
  if (xhr.status == 200)
    return true;
  alert("Error while saving: " + xhr.responseText);
  return false;
}

function downloadInfo() {
  var xhr = getHTTPObject();
  xhr.open('GET', '<?php echo site_url('apply/retrieve'); ?>', false);
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

$(window).unload(closeChildWindows);

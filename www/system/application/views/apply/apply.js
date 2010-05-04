if (typeof(Array.prototype.indexOf) == 'undefined')
{
  Array.prototype.indexOf = function(value, start)
  {
    if (typeof(start) == 'undefined')
      start = 0;
    for (var i = start; i < this.length; i++)
    {
      if (this[i] == value)
        return i;
    }
    return -1;
  }
}

function getHTTPObject()
{
  if (typeof XMLHttpRequest != 'undefined')
  {
    return new XMLHttpRequest();
  }
  try
  {
    return new ActiveXObject("Msxml2.XMLHTTP");
  }
  catch (e)
  {
    try
    {
      return new ActiveXObject("Microsoft.XMLHTTP");
    }
    catch (e)
    {}
  }
  alert("An unexpected error has occurred--your browser may not be supported");
  return null;
}

function syncExplain(baseId)
{
  var display = $('#' + baseId + '-yes').get(0).checked ? 'block' : 'none';
  $('#' + baseId + '-explaincontainer').css('display', display);
}

function uploadInfo(info)
{
  var xhr = getHTTPObject();
  xhr.open('POST', '<?php echo site_url("apply/update"); ?>', false);
  xhr.send(info);
  if (xhr.status == 200)
    return true;
  alert("Error while saving: " + xhr.responseText);
  return false;
}

function downloadInfo()
{
  var xhr = getHTTPObject();
  xhr.open('GET', '<?php echo site_url("apply/retrieve"); ?>', false);
  xhr.send(null);
  if (xhr.readyState == 4 && xhr.status == 200)
  {
    return JSON.parse(xhr.responseText);
  }
  else
  {
    alert("Couldn't load existing data!\n" + xhr.responseText);
    return null;
  }
}

function save(should_validate /* = false */, auto_save /* = false */)
{
  if (typeof(should_validate) == 'undefined')
    should_validate = false;
  if (typeof(auto_save) == 'undefined')
    auto_save = false;

  var info = {};
  for (var i = 0; i < save_handlers.length; i++)
  {
    save_handlers[i](info, document.mainform);
  }

  if (auto_save && typeof(last_known_state) != 'undefined')
  {
    // Remove values that are not known to have changed. Unless we
    // do this, it's possible for a browser that's sitting idly on
    // an apply page to pound over changes that the user is actively
    // making from another browser.
    for (var key in last_known_state)
    {
      if (info[key] === last_known_state[key])
        delete info[key];
    }
  }

  // Replacer function is a hack to work around this IE8 bug:
  // http://blogs.msdn.com/jscript/archive/2009/06/23/serializing-the-value-of-empty-dom-elements-using-native-json-in-ie8.aspx
  var payload = JSON.stringify(info, function(k, v) { return v === "" ? "" : v });
  //console.log(payload);
  if (!uploadInfo(payload))
    return false;

  for (var key in info)
  {
    if (info[key] == null)
      delete last_known_state[key];
    else
      last_known_state[key] = info[key];
  }

  if (should_validate)
    return validate(info);

  return true;
}

function validate(info)
{
  // clear existing errors
  $('span.error').remove();
  $('.error').removeClass('error error_required');
  var success = true;
  for (var i = 0; i < validation_handlers.length; i++)
  {
    success &= validation_handlers[i](info);
  }

  if (!success)
  {
    var errors = $('.error');
    if (errors)
      errors.get(0).scrollIntoView(true);
    alert('Please correct the problems highlighted in red, then try again.');
  }

  return success;
}

function load(info)
{
  for (var i = 0; i < load_handlers.length; i++)
  {
    load_handlers[i](info, document.mainform);
  }
  last_known_state = info;
}

function detach_file(field_id)
{
  var xhr = getHTTPObject();
  xhr.open('POST', '<?php echo site_url("apply/detach"); ?>/' + field_id, false);
  xhr.send(null);
  if (xhr.readyState == 4 && xhr.status == 200)
    return true;
  else
  {
    alert("Error detaching file:\n" + xhr.responseText);
    return false;
  }
}

function error_field_required(field_id)
{
  $('label[for="' + field_id + '"]').each(function(index, el) {
    var img = document.createElement("img");
    img.src = '<?php echo base_url() . "static/images/required.png"; ?>';
    img.align = 'baseline';
    img.style.marginTop = '-10px';
    var span = document.createElement("span");
    span.className = 'error';
    span.appendChild(img);
    span.style.marginLeft = '1em';
    if (el.nextSibling)
      el.parentElement.insertBefore(span, el.nextSibling);
    else
      el.parentElement.appendChild(span);
  });
}

function has_value(info, key)
{
  var value = info[key];
  return typeof(value) != 'undefined'
        && value != null
        && value != ''
        && value.replace(/^\s+|\s+$/g, '') != '';
}

load_handlers = [];
save_handlers = [];
validation_handlers = [];
child_windows = [];

function closeChildWindows()
{
  for (var i = 0; i < child_windows.length; i++)
    child_windows[i].close();
}

$(window).unload(closeChildWindows);

function finishFileUpload()
{
  $('#fileuploaddiv').dialog('destroy');
}
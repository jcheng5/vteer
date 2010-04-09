<?php

function format_duration($secs)
{
  if ($secs === NULL)
    return '?';

  $minutes = $secs / 60;
  if (abs($minutes) < 1)
    return number_format($secs) . " seconds";

  $hours = $minutes / 60;
  if (abs($hours) < 1)
    return number_format($minutes) . " minutes";

  $days = $hours / 24;
  if (abs($days) < 1)
    return number_format($hours) . " hours";

  return number_format($days) . " days";
}

function format_datetime_ago($datetime)
{
  $dt = new DateTime($datetime);
  $seconds_ago = time() - (int) $dt->format('U');
  return format_duration($seconds_ago) . " ago";
}

function format_filesize($bytes)
{
  if ($bytes < 1048576)
    return number_format($bytes/1024, 1) . ' KB';

  return number_format($bytes/1048576, 1) . ' MB';
}

function render_field($id, $data, $userId)
{
  $type_hint = FALSE;

  $result = preg_split('/\./', $id);
  if (count($result) > 1)
  {
    $id = $result[0];
    $type_hint = $result[1];
  }

  if ($type_hint == 'daterange')
  {
    if (isset($data["$id-from"]) && isset($data["$id-to"]))
      $data[$id] = $data["$id-from"] . " to " . $data["$id-to"];
  }

  if (!isset($data[$id]))
    return format_value(NULL);

  if ($type_hint == 'file')
  {
    return anchor("admin/volunteers/download/$userId/$id",
                  $data[$id]['name'],
                  array('target' => '_blank'));
  }

  return format_value($data[$id], $type_hint);
}

function format_value($value, $type_hint = FALSE)
{
  if (is_null($value) || $value === '')
  {
    return '<span class="blank">(blank)</span>';
  }
  else if (is_array($value))
  {
    // dates or checkboxes
    if (count($value) == 0)
    {
      return '<span class="blank">(blank)</span>';
    }
    $str_val = '';
    $delim = '';
    foreach ($value as $el)
    {
      $str_val = $str_val . $delim . format_value($el);
      $delim = ', ';
    }
    return $str_val;
  }
  else if (is_string($value))
  {
    return nl2br(htmlspecialchars($value));
  }
  else
  {
    echo("(Warning: Unknown data type)");
    return format_value("$value");
  }
}

?>
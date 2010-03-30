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

function format_datetime_ago($datetime) {
   $dt = new DateTime($datetime);
   $seconds_ago = time() - (int)$dt->format('U');
   return format_duration($seconds_ago) . " ago";
}

function format_value($value)
{
  if (is_null($value) || $value === '') {
    return '<em>(blank)</em>';
  }
  else if (is_array($value)) {
    // dates or checkboxes
    if (count($value) == 0) {
      return '<em>(blank)</em>';
    }
    $str_val = '';
    $delim = '';
    foreach ($value as $el) {
      $str_val = $str_val . $delim . format_value($el);
      $delim = ', ';
    }
    return $str_val;
  }
  else if (is_string($value)) {
    return nl2br(htmlspecialchars($value));
  }
  else {
    echo("(Warning: Unknown data type)");
    return format_value("$value");
  }
}

?>
<?php

function vt_format_duration($secs)
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

function vt_format_datetime_ago($datetime) {
   $dt = new DateTime($datetime);
   $seconds_ago = time() - (int)$dt->format('U');
   return vt_format_duration($seconds_ago) . " ago";
}
?>
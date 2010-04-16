<?php

class EventCalendar
{
  function __construct($month, $year, $rangespec)
  {
    $this->start = new DateTime();
    $this->start->setDate($year, $month, 1);
    $this->start->setTime(0, 0, 0);
    $this->end = clone $this->start;
    $this->end->modify($rangespec);

    $this->events = array();
    $this->colors = array();
  }

  function start()
  {
    return clone $this->start;
  }

  function end()
  {
    return clone $this->end;
  }

  function addEvent($desc, $startDate, $endDate, $url=FALSE, $tentative=FALSE, $color=FALSE)
  {
    if (!$color)
      $color = $this->nextColor();
    array_push($this->events, new Event($desc, $startDate, $endDate, $url, $tentative, $color));
  }

  function render()
  {
    // head and tail are dates that indicate the beginning (inclusive) and
    // end (exclusive) of the week we're working on
    
    $head = clone $this->start;
    // Move to previous Sunday, if not there already
    $dayOfWeek = (int)$head->format('w');
    if ($dayOfWeek > 0)
      $head->modify("-$dayOfWeek days");

    $tail = clone $head;
    $tail->modify('+1 week');

    echo "<div class=\"calendar\"><div class=\"month\">\n";

    while ($this->daysSinceEpoch($head) < $this->daysSinceEpoch($this->end))
    {
      echo "<div class=\"week\">\n";

      $pos = clone $head;
      for ($i = 0; $i < 7; $i++)
      {
        $day = strtolower($pos->format('l'));
        $date = $pos->format('j');
        if ($date == '1')
          $date = $pos->format('M Y');
        $remnant = $this->daysSinceEpoch($pos) < $this->daysSinceEpoch($this->start)
              || $this->daysSinceEpoch($pos) >= $this->daysSinceEpoch($this->end) ? ' remnant' : '';
        echo "<div class=\"day $day$remnant\">$date</div>\n";
        $pos->modify('+1 day');
      }
      echo "<br clear=\"all\"/>\n";

      $headD = $this->daysSinceEpoch($head);
      $tailD = $this->daysSinceEpoch($tail);

      foreach ($this->events as $event)
      {
        // Figure out how many days away the event's start and end are,
        // relative to the beginning of this week
        $startDiff = $this->daysSinceEpoch($event->startDate) - $headD;
        $endDiff = $this->daysSinceEpoch($event->endDate) - $headD + 1;

        if ($startDiff < 0 && $endDiff < 0)
          continue; // Whole event falls before this week
        if ($startDiff > 6 && $endDiff > 6)
          continue; // Whole event falls after this week

        $offset = max($startDiff, 0);
        $length = min($endDiff, 7) - $offset;

        $this->renderEvent($event, $offset, $length);
      }

      echo "</div>\n"; // <div class="week">

      // add 1 week to $pos
      $head->modify('+1 week');
      $tail->modify('+1 week');
    }

    echo "</div></div>\n";
  }

  function renderEvent($event, $offset, $length)
  {
    $desc = htmlspecialchars($event->desc);
    $tentative = $event->tentative ? ' tentative' : '';
    $anchorStart = '';
    $anchorEnd = '';
    if ($event->url)
    {
      $anchorStart = "<a href=\"$event->url\">";
      $anchorEnd = '</a>';
    }

    $tooltip = $event->startDate->format('l, F j, Y') . ' &ndash; ' . $event->endDate->format('l, F j, Y');

    echo "<div class=\"event offset$offset length$length$tentative\" title=\"$tooltip\" style=\"background-color: $event->color\">$anchorStart$desc$anchorEnd</div>\n";
  }

  function daysSinceEpoch($date)
  {
    return (int)$date->format('U') / (60 * 60 * 24);
  }

  function nextColor()
  {
    if (!$this->colors)
      $this->colors = array('#FFF618', '#F77B1B', '#56F6B6', '#5490D8', '#36F2F3', '#BFE118');
    return array_pop($this->colors);
  }
}

class Event
{
  function __construct($desc, $startDate, $endDate, $url, $tentative, $color)
  {
    $this->desc = $desc;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->url = $url;
    $this->tentative = $tentative;
    $this->color = $color;
  }
}

?>
<?php

class Calendar extends Controller
{

  function Calendar()
  {
    parent::Controller();
    $this->load->library('admin');
    $this->admin->enforce();
    $this->load->helper('calendar');
  }

  function index()
  {
    $now = getdate();
    $year = (int)$now['year'];
    $month = (int)$now['mon'];
    $this->show($year, $month);
  }

  function show($year, $month)
  {
    $calendar = new EventCalendar($month, $year, '+1 year');
    $start = $calendar->start();
    $end = $calendar->end();

    $db = new DbConn();
    $results = $db->query('select * from users
                           where status in ?
                             and arrivaldate is not null
                             and departuredate is not null
                             and ((arrivaldate >= ? and arrivaldate < ?)
                                or (departuredate >= ? and departuredate < ?))
                             order by arrivaldate asc',
                          array(STATUS_ACCEPTED, STATUS_CONFIRMED),
                          $start, $end,
                          $start, $end);

    while ($user = $results->next())
    {
      $calendar->addEvent("$user->firstname $user->lastname",
                          $this->_to_date($user->arrivaldate),
                          $this->_to_date($user->departuredate),
                          site_url("admin/volunteers/show/$user->id"),
                          $user->status != STATUS_CONFIRMED);
    }

    $prev = clone $start;
    $prev->modify('-1 year');
    $next = clone $start;
    $next->modify('+1 year');

    $this->load->view('admin/header');
    $this->load->view('admin/calendar', array('calendar' => $calendar,
                                              'date' => $this->_make_date($year, $month),
                                              'prev' => $prev,
                                              'next' => $next));
    $this->load->view('admin/footer');
  }

  function _to_date($dateStr)
  {
    $chunks = explode('-', $dateStr);
    return $this->_make_date($chunks[0], $chunks[1], $chunks[2]);
  }

  function _make_date($year, $month, $day = 1)
  {
    $date = new DateTime();
    $date->setDate($year, $month, $day);
    $date->setTime(0, 0, 0);
    $date->setTimezone(new DateTimeZone('UTC'));
    return $date;
  }
}

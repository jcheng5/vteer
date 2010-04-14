<style type="text/css">
.calendar {
  font-size: 12px;
  font-family: Lucida Grande;
}
.month {
  width: 718px;
}
.week {
  background-color: white;
  border: #ccc solid 1px;
  min-height: 90px;
  margin-bottom: 8px;
  padding: 8px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
}
.day {
  float: left;
  width: 90px;
  background-color: #ddd;
  color: black;
  font-weight: bold;
  padding-left: 10px;
  margin-bottom: 12px;
  text-transform: uppercase;
}
.day.remnant {
  color: #999;
}
.monday, .tuesday, .wednesday, .thursday, .friday {
}
.saturday, .sunday {
  background-color: #eee;
}
.sunday {
  -moz-border-radius-topleft: 8px;
  -moz-border-radius-bottomleft: 8px;
  -webkit-border-top-left-radius: 8px;
  -webkit-border-bottom-left-radius: 8px;
}
.saturday {
  -moz-border-radius-topright: 8px;
  -moz-border-radius-bottomright: 8px;
  -webkit-border-top-right-radius: 8px;
  -webkit-border-bottom-right-radius: 8px;
}
.event {
  position: relative;
  padding: 2px 8px 2px 8px;
  margin-top: 2px;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
}
.offset0 {
}
.offset1 {
  left: 100px;
}
.offset2 {
  left: 200px;
}
.offset3 {
  left: 300px;
}
.offset4 {
  left: 400px;
}
.offset5 {
  left: 500px;
}
.offset6 {
  left: 600px;
}
.event.tentative {
  opacity: 0.5;
  font-style: italic;
}
.event a {
  text-decoration: none;
  color: black;
}
.event a:hover {
  text-decoration: underline;
}
.length1 {
  width: 84px;
}
.length2 {
  width: 184px;
}
.length3 {
  width: 284px;
}
.length4 {
  width: 384px;
}
.length5 {
  width: 484px;
}
.length6 {
  width: 584px;
}
.length7 {
  width: 684px;
}

#pageframe {
  width: 100% !important;
}
.month {
  margin-left: auto;
  margin-right: auto;
}
#topnav {
  width: 718px;
  margin-left: auto;
  margin-right: auto;
}
</style>

<div id="topnav">
  <div style="float: left"><a class="button" href="<?php echo site_url('admin/calendar/show/'.$prev->format('Y/n')); ?>">&larr; <?php echo $prev->format('F Y'); ?></a></div>
  <div style="float: right"><a class="button" href="<?php echo site_url('admin/calendar/show/'.$next->format('Y/n')); ?>"><?php echo $next->format('F Y'); ?> &rarr;</a></div>
  <h2 align="center"><?php echo $date->format('F Y'); ?></h2>
</div>
<?php $calendar->render(); ?>
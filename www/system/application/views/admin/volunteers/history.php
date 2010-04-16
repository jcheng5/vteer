<?php $this->load->helper('format'); ?>

<style type="text/css">
  .event {
    margin-bottom: 1.5em;
  }
  .event+.event {
    padding-top: 1.5em;
    border-top: 1px solid #ccc;
  }
  .event .desc {
    font-size: 10pt;
  }
  .event .when {
    font-size: 9pt;
    color: #888;
  }
  .event pre {
    margin: 0 0 0 2em;
    font-family: Lucida Grande;
  }
</style>

<div class="history">

<?php if ($pagetitle) { echo "<h1>$pagetitle</h1>"; } ?>
    
<?php while ($event = $events->next()): ?>

  <div class="event">
    <div class="desc"><?php echo format_log_event($event); ?></div>
    <div class="when"><?php echo format_datetime_ago($event->when) . " &mdash; $event->when"; ?></div>
  </div>

<?php endwhile; ?>

</div>
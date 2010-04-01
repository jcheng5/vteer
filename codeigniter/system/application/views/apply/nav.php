<div class="nav">
  <button <?php if (!$prev_link) echo 'disabled="disabled"'; ?> onclick="if (save()) location.href = '<?php echo $prev_link; ?>';" type="button">
    Previous page
  </button>
  &nbsp;
  <?php echo "Page $page_num of $max_page"; ?>
  &nbsp;
  <button onclick="if (save()) location.href = '<?php echo $next_link; ?>';" type="button">
    <b><?php echo $next_label; ?></b>
  </button>
</div>

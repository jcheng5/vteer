<div class="nav">
  <button <?php if (!$prev_link) echo 'disabled="disabled"'; ?>
      onclick="if (save(false)) location.href = '<?php echo $prev_link; ?>';" type="button">
    Previous page
  </button>
  &nbsp;
<?php echo "Page $page_num of $max_page"; ?>
  &nbsp;
  <button onclick="if (save(false)) alert('Your changes have been saved.');" type="button">Save changes</button>
  <button onclick="if (save(true)) location.href = '<?php echo $next_link; ?>';" type="button">
    <b><?php echo $next_label; ?></b>
  </button>
</div>

<style type="text/css">
  td, th {
    padding: .5em;
    text-align: left;
  }

  tr.odd {
    background-color: #ddd;
  }

  tr.even {
    background-color: #eee;
  }

  h3 {
    margin: 3em 0 0.4em 0;
  }
</style>
<script type="text/javascript">
  $(function()
  {
    $('.detaillink').each(function()
    {
      new YAHOO.widget.Button(this);
    });
  });
</script>

<h1>Volunteer Dashboard</h1>

<?php for ($j = 0; $j < sizeof($user_groups); $j++): ?>
   <?php $title = $titles[$j];
$users = $user_groups[$j]; ?>

<h3><?php echo htmlspecialchars($title); ?> (<?php echo $users->length; ?>)</h3>
<?php if ($users->length > 0): ?>

<table class="data" cellspacing="0">
  <tr>
    <th></th>
    <th>Name</th>
    <th>Submitted</th>
  </tr>
<?php $i = 0; while ($user = $users->next()): ?>

  <tr class="<?php echo ($i++ % 2) == 0 ? 'odd' : 'even'; ?>">
    <td width="120"><a id="detail<?php echo $user->id; ?>" class="detaillink"
                       href="<?php echo site_url("admin/volunteers/show/$user->id"); ?>">View details</a></td>
    <td class="name" width="200">
    <?php echo htmlentities("$user->firstname $user->lastname"); ?>
         </td>
    <td width="115"><?php
            $submitted = '?';
    if ($user->submitdate)
      $submitted = format_datetime_ago($user->submitdate);
    echo $submitted;
    ?></td>
  </tr>
<?php endwhile; ?>
      </table>
<?php endif; ?>
<?php endfor; ?>

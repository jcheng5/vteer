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

  .seeall {
    text-align: right !important;
    padding-right: 0 !important;
  }
  .seeall a {
    font-weight: bold;
    text-decoration: none;
  }

  table.data {
    width: 500px;
  }

  .history {
    float: right;
    width: 350px;
    background-color: #eef;
    padding: 12px;
    border: 1px solid #ccc;
  }
  .history h1 {
    font-size: 16pt;
    margin-top: 0;
  }
  .history .event .desc {
    font-size: 8pt;
  }

  #pageframe {
    width: 900px !important;
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

<?php for ($j = 0; $j < sizeof($user_groups); $j++): ?>
   <?php $title = $titles[$j]; $users = $user_groups[$j]; ?>
  <h3><?php echo htmlspecialchars($title); ?> (<?php echo $users->length; ?>)</h3>
  <?php if ($users->length > 0): ?>
    <table class="data" cellspacing="0">
      <tr>
        <th></th>
        <th>Name</th>
        <th><?php echo htmlspecialchars($datetitles[$j]); ?></th>
      </tr>
      <?php $i = 0; while (($user = $users->next()) && (!$limit || $i < $limit)): ?>

        <tr class="<?php echo ($i++ % 2) == 0 ? 'odd' : 'even'; ?>">
          <td width="120"><a id="detail<?php echo $user->id; ?>" class="detaillink"
                             href="<?php echo site_url("admin/volunteers/show/$user->id"); ?>">View details</a></td>
          <td class="name" width="200">
          <?php echo htmlentities("$user->firstname $user->lastname"); ?>
               </td>
          <td width="115"><?php echo $user->laststatuschange ? format_datetime_ago($user->laststatuschange) : '?'; ?></td>
        </tr>
      <?php endwhile; ?>
      <?php if ($limit && $limit < $users->length): ?>
        <tr>
          <td colspan="3" class="seeall"><?php echo anchor("admin/volunteers/status/$statuses[$j]", 'Show all'); ?></td>
        </tr>
      <?php endif; ?>
    </table>
  <?php endif; ?>
<?php endfor; ?>

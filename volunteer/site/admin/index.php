<?php
require_once('./common.inc');
vt_require_yui();
vt_header('Volunteers');

$users = get_users_by_state(STATUS_SUBMITTED);
?>
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
</style>
<script type="text/javascript" src="index.js"></script>

<h1>Volunteer Dashboard</h1>

<h3>Applicants needing review (<?php echo $users->length; ?>)</h3>
<table cellspacing="0">
<tr>
   <th></th>
   <th>Name</th>
   <th>Submitted</th>
</tr>
<?php $i = 0; while ($user = $users->next()): ?>
<tr class="<?php echo ($i++ % 2) == 0 ? 'odd' : 'even'; ?>">
   <td><a id="detail<?php echo $user->id; ?>" class="detaillink" href="volunteers/view.php?id=<?php echo $user->id; ?>">View details</a></td>
   <td class="name">
      <?php echo htmlentities("$user->firstname $user->lastname"); ?>
   </td>
   <td><?php
      $submitted = '?';
      if ($user->submitdate)
      {
         $submittime = new DateTime($user->submitdate);
         $seconds_ago = time() - (int)$submittime->format('U');
         $submitted = vt_format_duration($seconds_ago) . " ago";
      }
      echo $submitted;
   ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php vt_footer(); ?>
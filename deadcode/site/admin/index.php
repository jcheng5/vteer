<?php
require_once('./common.inc');
vt_require_yui();
vt_header('Volunteers');

$users_submitted = get_users_by_state(STATUS_SUBMITTED);
$users_accepted = get_users_by_state(STATUS_ACCEPTED);
$users_rejected = get_users_by_state(STATUS_REJECTED);

$user_groups = array($users_submitted, $users_accepted, $users_rejected);
$titles = array('Applicants needing review',
                'Applicants that have been accepted',
                'Applicants that have been rejected');
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
h3 {
   margin: 3em 0 0.4em 0;
}
</style>
<script type="text/javascript" src="index.js"></script>

<h1>Volunteer Dashboard</h1>

<?php for ($j = 0; $j < sizeof($user_groups); $j++): ?>
   <?php $title = $titles[$j]; $users = $user_groups[$j]; ?>
   
   <h3><?php echo htmlspecialchars($title); ?> (<?php echo $users->length; ?>)</h3>
   <?php if ($users->length > 0): ?>
      <table cellspacing="0">
      <tr>
         <th></th>
         <th>Name</th>
         <th>Submitted</th>
      </tr>
      <?php $i = 0; while ($user = $users->next()): ?>
      <tr class="<?php echo ($i++ % 2) == 0 ? 'odd' : 'even'; ?>">
         <td width="120"><a id="detail<?php echo $user->id; ?>" class="detaillink" href="volunteers/view.php?id=<?php echo $user->id; ?>">View details</a></td>
         <td class="name" width="200">
            <?php echo htmlentities("$user->firstname $user->lastname"); ?>
         </td>
         <td width="115"><?php
            $submitted = '?';
            if ($user->submitdate)
               $submitted = vt_format_datetime_ago($user->submitdate);
            echo $submitted;
         ?></td>
      </tr>
      <?php endwhile; ?>
      </table>
   <?php endif; ?>
<?php endfor; ?>

<?php vt_footer(); ?>
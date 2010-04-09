<style type="text/css">
  div#pageframe {
    width: 100%;
  }
</style>

<h1>Manage E-mail Templates</h1>

<table class="data" cellspacing="0">
  <tr>
    <th></th>
    <th>Role</th>
    <th>Subject</th>
  </tr>
  <?php $i = 0; while ($mail = $mails->next()): ?>
  <tr class="<?php echo ($i++ % 2) == 0 ? 'odd' : 'even'; ?>"
      id="mail<?php echo $mail->id; ?>">
    <td>
      <?php echo anchor("admin/emails/compose/$mail->id", "View/Edit",
                        array('class' => 'button')); ?>
    </td>
    <td>
      <?php if (!is_null($mail->role)): ?>
        <strong><?php echo htmlspecialchars($mail->role); ?></strong>
      <?php else: ?>
        Custom
      <?php endif; ?>
    </td>
    <td>
      <?php echo htmlspecialchars($mail->subject); ?>
     </td>
  </tr>
  <?php endwhile; ?>
</table>

<!--
<p>
  <?php echo anchor('admin/emails/compose',
                    'Create a new mail template',
                    array('class' => 'button')); ?>
</p>
-->

<?php if ($highlightid): ?>
<script type="text/javascript">
  $(document).ready(function(){
    var hlrow = $('#mail<?php echo (int)$highlightid; ?>');
    hlrow.css('backgroundColor', '#FF9');
    hlrow.animate({backgroundColor:'#FF9'}, 3000)
         .animate({backgroundColor:'#FFF'}, 750);
  });
</script>
<?php endif; ?>


<script type="text/javascript">
$(function(){
  new YAHOO.widget.Button('lnkCreate');
});
</script>

<h1>Manage E-mail Templates</h1>

<table class="data" cellspacing="0">
  <tr>
    <th></th>
    <th>Subject</th>
    <th>Role</th>
  </tr>
  <?php $i = 0; while ($mail = $mails->next()): ?>
  <tr class="<?php echo ($i++ % 2) == 0 ? 'odd' : 'even'; ?>"
      id="mail<?php echo $mail->id; ?>">
    <td>
      <?php echo anchor("admin/emails/compose/$mail->id", "Edit",
                        array('class' => 'button')); ?>
    </td>
    <td>
      <?php echo htmlspecialchars($mail->subject); ?>
     </td>
    <td>
      <?php echo htmlspecialchars($mail->role); ?>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

<p>
  <?php echo anchor('admin/emails/compose',
                    'Create a new mail template',
                    array('id' => 'lnkCreate')); ?>
</p>

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


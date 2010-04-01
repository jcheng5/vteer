<?php

require_once('common.inc');

$mails = get_mail_templates();
$highlightid = $_REQUEST['highlight'];

vt_header('List E-mail Templates');
vt_require_yui();
?>

<script type="text/javascript">
$(function(){
   new YAHOO.widget.Button('lnkCreate');
});
</script>

<table>
<?php while ($mail = $mails->next()): ?>
<tr id="mail<?php echo $mail->id; ?>">
   <td>
      <a href="compose.php?id=<?php echo $mail->id; ?>">
         <?php echo htmlspecialchars($mail->subject); ?>
      </a>
   </td>
</tr>
<?php endwhile; ?>
</table>

<p><a id="lnkCreate" href="compose.php">Create a new mail template</a></p>

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

<?php vt_footer(); ?>
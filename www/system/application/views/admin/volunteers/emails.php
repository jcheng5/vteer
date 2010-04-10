<?php $this->load->helper('format'); ?>
<style type="text/css">
h3.subject {
  margin-bottom: 0;
}
div.date {
  color: #888;
  font-style: italic;
}
</style>

<script type="text/javascript">
$(function() {
  new YAHOO.widget.Button('lnkBack');
});
</script>

<div style="float: right">
<?php echo anchor("admin/volunteers/show/$user->id", 'Back to profile', array('id' => 'lnkBack')); ?>
</div>

<h1>E-mail history for <?php echo $user->firstname . ' ' . $user->lastname; ?></h1>

<div class="section">
<h2>Mails Scheduled</h2>
<?php
if ($scheduledMails->length > 0):
  while ($mail = $scheduledMails->next()):
?>
  <div class="email">
    <h3 class="subject"><?php echo htmlspecialchars($mail->role); ?></h3>
    <div class="date">
      Scheduled for <?php echo htmlspecialchars($mail->due); ?>
    </div>
  </div>
<?php
  endwhile;
endif;
?>
</div>

<div class="section">
<h2>Mails Sent</h2>
<?php while ($mail = $sentMails->next()): ?>
  <div class="email">
    <h3 class="subject"><?php echo htmlspecialchars($mail->subject); ?></h3>
    <div class="date">
      Sent
      <?php echo format_value(format_datetime_ago($mail->sent)); ?>
      (<?php echo $mail->sent; ?>)
    </div>
    <blockquote>
      <?php echo htmlspecialchars($mail->plaintext); ?>
    </blockquote>
  </div>
<?php endwhile; ?>
</div>
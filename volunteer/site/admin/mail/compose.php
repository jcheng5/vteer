<?php

require_once('common.inc');

$id = $_REQUEST["id"];
if ($id)
{
   $id = (int)$id;
   $mail_template = get_mail_template($id, true);
}

$verb = $mail_template ? "Edit" : "Create New";

?>
<?php
vt_header("$verb E-mail");
vt_require_yui();
?>
<script type="text/javascript" src="../../javascripts/ckeditor/ckeditor_basic.js"></script>
<script type="text/javascript" src="compose.js"></script>
<style type="text/css">
#subject {
   width: 100%;
}
</style>

<form name="email" method="POST" action="update.php">

<?php if ($mail_template): ?>
<input type="hidden" name="id" value="<?php echo (int)$id ?>" />
<?php endif; ?>

<table width="100%">
<tr>
   <td><label>Subject:&nbsp;</label></td>
   <td width="99%"><input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($mail_template->subject); ?>" /></td>
</tr>
</table>

<p><textarea name="htmlbody"><?php echo $mail_template->html; ?></textarea>

<div class="actionbar" style="text-align: right">
   <div style="float:left">
      <button id="btnInsert" type="button">Insert placeholder</button>
      <select id="selInsertMenu">
         <option value="$firstname$">Applicant's first name</option>
         <option value="$lastname$">Applicant's last name</option>
         <option value="$nickname$">Applicant's nickname</option>
      </select>
      <button id="btnPreview" type="button">Preview</button>
   </div>

   <button id="btnSave" type="submit"><?php echo $mail_template ? 'Save changes' : 'Save' ?></button>

   <button id="btnCancel" type="button">Cancel</button>
</div>

</form>

<?php vt_footer(); ?>
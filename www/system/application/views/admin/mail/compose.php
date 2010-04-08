<?php $this->load->helper('form'); ?>
<script type="text/javascript" src="<?php echo base_url() . 'static/js/ckeditor/ckeditor_basic.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'static/js/compose.js'; ?>"></script>
<style type="text/css">
  #subject {
    width: 100%;
  }
</style>

<div style="float: right">
<?php echo anchor('admin/emails', 'Back to list', array('class' => 'button')); ?>
</div>

<h2><?php echo $id ? 'Edit' : 'Create New'; ?> E-mail Template</h2>

<?php echo form_open('admin/emails/update', array('name' => 'email')); ?>

<?php if ($id): ?>
<input type="hidden" name="id" value="<?php echo $id ?>" />
<?php endif; ?>

<table width="100%">
  <tr>
    <td><label>Subject:&nbsp;</label></td>
    <td width="99%">
      <input type="text" id="subject" name="subject"
             value="<?php echo htmlspecialchars($subject); ?>" />
    </td>
  </tr>
</table>

<p><textarea name="htmlbody"><?php echo $body; ?></textarea>

<div class="actionbar" style="text-align: right">
  <div style="float:left">
    <button class="native" id="btnInsert" type="button">Insert placeholder</button>
    <select id="selInsertMenu">
      <option value="$firstname$">Applicant's first name</option>
      <option value="$lastname$">Applicant's last name</option>
      <option value="$nickname$">Applicant's nickname</option>
      <option value="$email$">Applicant's e-mail</option>
    </select>
    <!-- Disable previewing for now -->
    <!--<button id="btnPreview" type="button">Preview</button>-->
  </div>

  <button id="btnSave" type="submit"><?php echo $id ? 'Save changes' : 'Save' ?></button>

<?php echo anchor('admin/emails/', 'Cancel', array('class' => 'button')); ?>
</div>

</form>

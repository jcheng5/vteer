<?php $this->load->helper('form'); ?>
<?php $this->load->helper('format'); ?>
<script type="text/javascript" src="<?php echo base_url() . 'static/js/ckeditor/ckeditor_basic.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'static/js/compose.js'; ?>"></script>
<script type="text/javascript">
$(function() {
  ckeditor = CKEDITOR.replace(
      'htmlbody',
      {
        toolbar:
            [
              ['Format','Font','FontSize'],
              ['Bold','Italic','Underline','Strike','-','TextColor'],
              '/',
              ['Cut','Copy','Paste','PasteText','PasteFromWord'],
              ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
              ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
              ['Link','Unlink'],
            ]
      });

  new YAHOO.widget.Button('btnInsert', {
    type: 'menu',
    menu: 'selInsertMenu'
  }).getMenu().subscribe('click', function(type, args) {
    ckeditor.insertHtml(args[1].value + ' ');
    ckeditor.focus();
  });

  new YAHOO.widget.Button('btnAttach').on('click', function() {
    showUploadForm();
  });
});

function showUploadForm() {
  $('#uploadform').dialog({
    width: 350,
    height: 200,
    modal: true,
    open: function(event, ui) {
      document.getElementById('uploadframe').src = '<?php echo site_url('admin/emails/attach'); ?>';
    }
  });
}

function onUploadComplete(id, name, size, type) {
  $('#uploadform').dialog('destroy');
  addFile(id, name, size);
}

function addFile(id, name, size) {
  var div = document.createElement('div');
  div.className = 'file';

  var link = document.createElement('a');
  link.target = '_blank';
  link.href = "<?php echo site_url('admin/emails/preview_attachment'); ?>/" + id;
  link.innerText = name;
  div.appendChild(link);

  var size = document.createTextNode(" (" + size + ")");
  div.appendChild(size);

  var deleteLink = document.createElement('a');
  deleteLink.href = '';
  div.appendChild(deleteLink);
  $(deleteLink).click(function() {
    $(div).remove();
    return false;
  });

  var img = document.createElement('img');
  img.className = 'delete';
  img.alt = 'Delete';
  img.src = "<?php echo base_url().'static/images/delete.png'; ?>";
  img.width = 14;
  img.height = 14;
  img.border = 0;
  deleteLink.appendChild(img);

  var field = document.createElement('input');
  field.type = 'hidden';
  field.name = 'attachment[]';
  field.value = id;
  div.appendChild(field);

  $('.files').append(div);
}
</script>
<style type="text/css">
  #subject {
    width: 100%;
  }
  #attachments {
    border: 1px #ccc solid;
    padding: 8px;
    margin-bottom: 1em;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
  }
  #attachments h3 {
    margin: 0 0 0.75em 0;
  }
  #attachments .files {
    float: left;
    clear: both;
  }
  #attachments .file {
    display: block;
    float: left;
    border: 1px #ccc solid;
    margin: 0 4px 8px 0;
    padding: 3px 2px 4px 8px;
    background-color: #eef;
    font-size: 8pt;
    vertical-align: baseline;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
  }
  #attachments .file a {
    color: #00a;
    text-decoration: none;
  }
  #attachments img.delete {
    position: relative;
    top: 3px;
    margin: -4px 2px 0 4px;
  }
  #addline {
    clear: both;
  }
  #uploadform iframe {
    border: 0;
    width: 300;
    height: 150;
  }
</style>

<div style="float: right">
<?php echo anchor('admin/emails', 'Back to list', array('class' => 'button')); ?>
</div>

<h2><?php echo $id ? 'Edit' : 'Create New'; ?> <?php echo $role ? "\"$role\"" : ''; ?> E-mail Template</h2>

<?php echo form_open('admin/emails/update', array('name' => 'email')); ?>

<?php if ($id): ?>
<input type="hidden" name="id" value="<?php echo $id ?>" />
<?php endif; ?>

<table width="100%">
  <tr>
    <td><label>Subject:&nbsp;</label></td>
    <td width="99%">
      <input type="text" id="subject" name="subject"
             value="<?php echo form_prep($subject); ?>" />
    </td>
  </tr>
</table>

<p><textarea name="htmlbody"><?php echo $body; ?></textarea></p>

<div id="attachments">
  <h3>File Attachments</h3>
  <div class="files">
  </div>
  <div id="addline">
    <button id="btnAttach" class="native" type="button">Add attachment</button>
  </div>
  <?php if ($attachments): ?>
    <script type="text/javascript">
      $(function() {
        <?php while ($attach = $attachments->next()) {
          $size = format_filesize($attach->size);
          echo "addFile($attach->id, '$attach->filename', '$size');";
        } ?>
      });
    </script>
   <?php endif; ?>
</div>

<div class="actionbar" style="text-align: right">
  <div style="float:left">
    <button class="native" id="btnInsert" type="button">Insert placeholder</button>
    <select id="selInsertMenu">
      <option value="#firstname#">Applicant's first name</option>
      <option value="#lastname#">Applicant's last name</option>
      <option value="#email#">Applicant's e-mail</option>
      <option value="&lt;a href=&quot;#application_url#&quot;&gt;#application_url#&lt;/a&gt;">Link to application (only for e-mails to Administrators)</option>
      <option value="&lt;a href=&quot;#homepage_url#&quot;&gt;#homepage_url#&lt;/a&gt;">Link to volunteer application homepage (<?php echo base_url(); ?>)</option>
    </select>
  </div>

  <button id="btnSave" type="submit"><?php echo $id ? 'Save changes' : 'Save' ?></button>

<?php echo anchor('admin/emails/', 'Cancel', array('class' => 'button')); ?>
</div>

<div id="uploadform" title="Attach File">
  <iframe id="uploadframe" scrolling="no"></iframe>

</div>

</form>

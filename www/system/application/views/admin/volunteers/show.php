<style type="text/css">
  .field {
    font-size: 1.2em;
    margin-left: 2em;
  }

  .field .name {
    margin-top: 1em;
  }

  .field .value {
    color: #5A5A5A;
    margin-left: 1em;
  }

  h2 {
    border-bottom: 1px solid #5A5A5A;
    padding-top: 4px;
    margin-top: 1.3em;
  }

  .note {
    border: 1px solid #aaa;
    padding: 0.5em;
    background-color: #ffd;
    margin-bottom: 1em;
  }

  .note .metadata {
    font-weight: bold;
    margin-bottom: 1em;
    border-bottom: 1px solid #aaa;
    padding-bottom: 0.4em;
  }

  #addnote {
    margin-top: 2em;
  }

  #status {
    font-size: 1.5em;
    margin-bottom: 1em;
  }

  #statusvalue {
    font-weight: bold;
  }
</style>
<script type="text/javascript">
  $(function()
  {
    var btnAccept = new YAHOO.widget.Button('btnAccept');
    btnAccept.on('click', function() {
      return confirm("Are you sure you want to ACCEPT this application?");
    });
    var btnReject = new YAHOO.widget.Button('btnReject');
    btnReject.on('click', function() {
      return confirm("Are you sure you want to REJECT this application?");
    });
    new YAHOO.widget.Button('btnAddNote');    
  });
</script>

<div style="float: right">
<?php echo anchor('admin/volunteers', 'Back to list'); ?>
</div>

<h1><?php echo format_value("$user->firstname $user->lastname"); ?></h1>

<div id="status">Status: <span id="statusvalue"><?php echo htmlspecialchars(format_status($user->status)); ?></span>
</div>

<?php if ($user->status == STATUS_SUBMITTED): ?>

<?php
  $this->load->helper('form');
  echo form_open('admin/volunteers/acceptreject');
?>
  <input type="hidden" name="id" value="<?php echo $user->id; ?>"
  <button id="btnAccept" type="submit" name="action" value="accept"><h3 style="color: #060">Accept</h3></button>
  <button id="btnReject" type="submit" name="action" value="reject"><h3 style="color: #D00">Reject</h3></button>
</form>
<?php endif; ?>

<h2>Notes</h2>

<?php while ($note = $notes->next()): ?>

<div class="note">
  <div class="metadata">
    Posted by <?php echo $note->adminid == $admin_id ? 'you' : htmlspecialchars($note->author); ?>,
  <?php echo format_datetime_ago($note->created); ?>
      (<?php echo $note->created; ?>)
  <?php if ($note->adminid == $admin_id): ?>

    <div style="float: right"><a href="deletenote.php?id=<?php echo $note->id; ?>"
                                 onclick="return confirm('This note will be permanently deleted. Are you sure?');">Delete</a>
    </div>
  <?php endif; ?>
   </div>
  <div class="content">
  <?php echo format_value($note->content); ?>
   </div>
</div>
<?php endwhile; ?>

<div id="addnote">
  <?php echo form_open('admin/volunteers/addnote'); ?>
    <input type="hidden" name="userid" value="<?php echo $user->id; ?>"/>
    <input type="hidden" name="source" value="Web"/>
    <textarea name="contents" cols="40" rows="6"></textarea><br/>
    <button id="btnAddNote" type="submit">Add Note</button>
  </form>
</div>

<h2>Application</h2>
<div id="appbody">
<?php foreach ($fields as $section): ?>
<h3><?php echo htmlspecialchars($section->name); ?></h3>
  <div class="fields">
  <?php foreach ($section->fields as $field): ?>
  <?php foreach ($field as $id => $label): ?>

    <div class="field">
      <div class="name">
      <?php echo htmlspecialchars($label); ?>
      </div>
      <div class="value">
      <?php echo render_field($id, $data, $user->id); ?>
      </div>
    </div>
  <?php endforeach; ?>
<?php endforeach; ?>
</div>
<?php endforeach; ?>
</div>

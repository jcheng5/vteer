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

  .deletenote {
    color: black;
    text-decoration: none;
  }

  .deletenote:hover {
    text-decoration: underline;
  }

  #addnote {
    margin-top: 2em;
    display: none;
  }
  #addnote form,
  #addnote input[type='hidden'],
  #addnote textarea {
    margin: 0;
    padding: 0;
  }

  #status {
    font-size: 1.5em;
    margin-bottom: 1em;
  }

  .statustimeline {
    font-size: 0.66em;
    color: #777;
  }

  .statusvalue#status<?php echo $user->status ?> {
    font-size: 1.5em;
    color: black;
    font-weight: bold;
  }
</style>
<script type="text/javascript">
  $(function()
  {
    new YAHOO.widget.Button('btnAddNote');    
    var btnShowAddNote = new YAHOO.widget.Button('btnShowAddNote');
    btnShowAddNote.on('click', function() {
      $('#btnShowAddNote').css('display', 'none');
      $('#addnote').css('display', 'block');
    });

    var btnDeleteUser = new YAHOO.widget.Button('btnDeleteUser');
    btnDeleteUser.on('click', function(e) {
      if (!confirm('Are you sure you want to PERMANENTLY delete this application?'))
        YAHOO.util.Event.preventDefault(e);
    });

    <?php if ($user->status == STATUS_SUBMITTED): ?>
      new YAHOO.widget.Button('btnAccept').on('mousedown', function(e) {
        if (confirm('Are you sure you want to ACCEPT this application?')) {
          location.href = '<?php echo site_url("admin/volunteers/acceptreject/$user->id/accept"); ?>';
        }
      });
      new YAHOO.widget.Button('btnReject').on('mousedown', function(e) {
        if (confirm('Are you sure you want to REJECT this application?')) {
          location.href = '<?php echo site_url("admin/volunteers/acceptreject/$user->id/reject"); ?>';
        }
      });
    <?php endif; ?>

    new YAHOO.widget.Button('lnkBackToList');
  });
</script>

<div style="float: right">
<?php echo anchor('admin/volunteers', 'Back to list', array('id' => 'lnkBackToList')); ?>
</div>

<h1><?php echo format_value("$user->firstname $user->lastname"); ?></h1>

<div id="status">
  Status:

  <span class="statustimeline">
    <?php
      $progression = array(STATUS_CREATED, STATUS_DRAFT, STATUS_SUBMITTED, STATUS_ACCEPTED, STATUS_CONFIRMED);
      if (in_array($user->status, $progression)) {
        foreach($progression as $status) {
          echo "<span class='statusvalue' id='status$status'>" . htmlspecialchars(format_status($status)) . '</span>';
          if ($status != $progression[sizeof($progression) - 1])
            echo " &rarr; ";
        }
      }
      else {
        echo "<span class='statusvalue' id='status$user->status'>" . htmlspecialchars(format_status($user->status)) . '</span>';
      }
    ?>
  </span>
</div>

<?php if ($user->status == STATUS_SUBMITTED): ?>
  <button id="btnAccept" class="native" type="button"><h3 style="color: #060">Accept</h3></button>
  <button id="btnReject" class="native" type="button"><h3 style="color: #D00">Reject</h3></button>
<?php endif; ?>

<p><?php echo anchor("admin/volunteers/email_history/$user->id", 'View system-generated e-mail history', array('class' => 'button')); ?></p>

<h2>Notes</h2>

<?php while ($note = $notes->next()): ?>

<div class="note">
  <div class="metadata">
    Posted by <?php echo $note->adminid == $admin_id ? 'you' : htmlspecialchars($note->author); ?>,
  <?php echo format_datetime_ago($note->created); ?>
      (<?php echo $note->created; ?>)
  <?php if ($note->adminid == $admin_id): ?>

    <div style="float: right"><a class="deletenote" href="<?php echo site_url("admin/volunteers/deletenote/$user->id/$note->id"); ?>"
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
    <button id="btnAddNote" type="submit">Save Note</button>
  </form>
</div>
<button id="btnShowAddNote" type="button">Add Note</button>

<?php if ($user->status == STATUS_ACCEPTED || $user->status == STATUS_CONFIRMED): ?>
  <h2>Travel Logistics</h2>
  <?php echo form_open('admin/volunteers/change_dates/' . $user->id); ?>
    <div style="float: left">
      <label for="arrivaldate">Arrival Date</label><br />
      <input type="text" class="datepicker" name="arrivaldate" id="arrivaldate" value="<?php echo form_prep(format_date($user->arrivaldate)); ?>">
    </div>
    <div style="float: left">
      <label for="departuredate">Departure Date</label><br />
      <input type="text" class="datepicker" name="departuredate" id="departuredate" value="<?php echo form_prep(format_date($user->departuredate)); ?>">
    </div>

    <br clear="all" />

    <p>
      <input type="checkbox" name="datesconfirmed" id="datesconfirmed" value="yes"
          onclick="if (this.checked && ($('#arrivaldate').val() == '' || $('#departuredate').val() == '')) {this.checked=false;alert('Please provide arrival and departure dates before attempting to mark the dates confirmed.');}"
          <?php echo $user->status == STATUS_CONFIRMED ? 'checked disabled' : ''; ?>>
      <label for="datesconfirmed">Dates are confirmed</label>
    </p>

    <p>Flight/Travel Info<br/>
    <textarea name="travelnotes" cols="30" rows="4"><?php echo form_prep($user->travelnotes); ?></textarea></p>

    <button type="submit">Save Changes</button>
  <?php echo form_close(); ?>
<?php endif; ?>

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

<?php echo anchor("admin/volunteers/delete/$user->id", 'Permanently Delete User',
                  array('id' => 'btnDeleteUser')); ?>
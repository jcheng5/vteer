<?php
require_once('./common.inc');
vt_require_yui();

function format_value($value) {
  if (is_null($value) || $value === '') {
    return '<em>(blank)</em>';
  }
  else if (is_array($value)) {
    // dates or checkboxes
    if (count($value) == 0) {
      return '<em>(blank)</em>';
    }
    $str_val = '';
    $delim = '';
    foreach ($value as $el) {
      $str_val = $str_val . $delim . format_value($el);
      $delim = ', ';
    }
    return $str_val;
  }
  else if (is_string($value)) {
    return nl2br(htmlspecialchars($value));
  }
  else {
    echo("(Warning: Unknown data type)");
    return format_value("$value");
  }
}

$id = (int)$_REQUEST['id'];
$user = get_user($id);

$fields = json_decode(file_get_contents('fields.json'));
$data = json_decode($user->data, TRUE);

vt_header("Volunteer - $user->firstname $user->lastname");
?>
<style type="text/css">
.field {
  font-size: 1.2em;
  margin-left: 2em;
}
.field .name {
  font-weight: bold;
  margin-top: 1em;
}
.field .value {
  color: #5A5A5A;
  margin-left: 1em;
}
</style>
<script type="text/javascript" src="view.js"></script>

<h1><?php echo format_value("$user->firstname $user->lastname"); ?></h1>

<form action="acceptreject.php" method="POST">
<input type="hidden" name="id" value="<?php echo $user->id; ?>"
<button id="btnAccept" type="submit" name="action" value="accept"><h3 style="color: #060">Accept</h3></button>
<button id="btnReject" type="submit" name="action" value="reject"><h3 style="color: #D00">Reject</h3></button>
</form>

<h2></h2>

<?php foreach ($fields as $section): ?>
<h2><?php echo htmlspecialchars($section->name); ?></h2>
<div class="fields">
<?php foreach ($section->fields as $field): ?>
  <?php foreach ($field as $id=>$label): ?>
    <div class="field">
      <div class="name">
        <?php echo htmlspecialchars($label); ?>
      </div>
      <div class="value">
        <?php echo format_value($data[$id]); ?>
      </div>
    </div>
  <?php endforeach; ?>
<?php endforeach; ?>
</div>
<?php endforeach; ?>

<?php vt_footer(); ?>

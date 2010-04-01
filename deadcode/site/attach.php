<?php
session_start();

require_once('common.inc');

if (!$_SESSION['userid'])
  die('Not logged in');

$fieldId = $_GET['id'];
?>

<form method="POST" enctype="multipart/form-data" action="attach-do.php">

<input type="hidden" name="field_id" value="<?php echo htmlspecialchars($fieldId) ?>"/>
<input type="file" name="file"/>
<br/>
<br/>
<input type="submit" value="Attach"/>

</form>
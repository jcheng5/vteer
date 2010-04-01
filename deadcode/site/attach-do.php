<?php
session_start();

require_once('common.inc');

if (!$_SESSION['userid'])
  die('Not logged in');

$fieldId = $_POST['field_id'];
if (!preg_match('/^[a-z0-9\-_]+$/i', $fieldId))
  die('Illegal field ID');

if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
  echo 'File upload failed';
  die($_FILES['file']['error']);
}
  
$filename = $_FILES['file']['name'];
$filetype = $_FILES['file']['type'];

$destfile = $upload_dir . DIRECTORY_SEPARATOR . ((int)$_SESSION['userid']) . "-" . $fieldId;
echo $destfile;
if (!move_uploaded_file($_FILES['file']['tmp_name'], $destfile))
  die('Upload failed');

merge_data($_SESSION['userid'], json_encode(array(
  $fieldId => array(
    'name' => $filename,
    'type' => $filetype
  )
)));

?>
<script type="text/javascript">
var odoc = window.opener.document;
var link = odoc.getElementById('<?php echo $fieldId; ?>-link');
link.innerText = "<?php echo $filename; ?>";
link.href = "http://www.google.com";
odoc.getElementById('<?php echo $fieldId; ?>-nofile').style.display = 'none';
odoc.getElementById('<?php echo $fieldId; ?>-hasfile').style.display = 'inline';
window.close();
</script>
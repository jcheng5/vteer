<script type="text/javascript">
var odoc = window.opener.document;
var link = odoc.getElementById('<?php echo $fieldId; ?>-link');
link.innerText = "<?php echo $filename; ?>";
odoc.getElementById('<?php echo $fieldId; ?>-nofile').style.display = 'none';
odoc.getElementById('<?php echo $fieldId; ?>-hasfile').style.display = 'inline';
window.close();
</script>
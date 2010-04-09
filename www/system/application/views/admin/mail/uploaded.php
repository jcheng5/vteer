<?php $this->load->helper('format'); ?>
<script type="text/javascript">
parent.onUploadComplete(<?php echo $fileid; ?>, "<?php echo $filename; ?>", "<?php echo format_filesize($filesize); ?>", "<?php echo $filetype; ?>");
</script>

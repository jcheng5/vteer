<form method="POST" enctype="multipart/form-data" action="<?php echo site_url("apply/upload/$field_id"); ?>">
  <input type="hidden" name="field_id" value="<?php echo htmlspecialchars($field_id) ?>"/>
  <input type="file" name="file"/>
  <br/>
  <br/>
  <input type="submit" value="Attach"/>
</form>
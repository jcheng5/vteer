<?php
require_once('./common.inc');
vt_require_yui();

$id = (int)$_REQUEST['id'];
$user = get_user($id);

vt_header("Volunteer - $user->firstname $user->lastname");
?>
<script type="text/javascript" src="view.js"></script>

<h1><?php echo "$user->firstname $user->lastname"; ?></h1>

<button id="btnAccept" type="button"><h3 style="color: #060">Accept</h3></button>
<button id="btnReject" type="button"><h3 style="color: #D00">Reject</h3></button>

<?php vt_footer(); ?>

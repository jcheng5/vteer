<?php

require_once('common.inc');

$user_id = $_REQUEST['userid'];
$mail_id = $_REQUEST['mailid'];

var_dump(send_mail($mail_id, $user_id));

?>
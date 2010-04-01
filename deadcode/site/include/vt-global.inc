<?php

require_once('vt-config.inc');

if (!is_dir($upload_dir))
  die("Incorrect configuration: $upload_dir doesn't exist");

date_default_timezone_set('UTC');

require_once('PEAR.php');
PEAR::setErrorHandling(PEAR_ERROR_EXCEPTION);

$base = $base ? $base : '.';
$lib = "$base/lib";

function restrict_to_admins()
{
	# TODO: enforce admin role, preferably using BASIC auth
   global $admin_id;
	$admin_id = 1;
}

require_once('vt-db.inc');
require_once('vt-user.inc');
require_once('vt-mail.inc');
require_once('vt-util.inc');
require_once('vt-notes.inc');

header('Content-Type: text/html;charset=utf-8');

function vt_header($page_name)
{
   global $vt_page_title, $base;
   $vt_page_title = $page_name;
   include("page/vt-header.inc");
}

function vt_footer()
{
   global $base;
   include("page/vt-footer.inc");
}

function redirect($url)
{
   header("Location: $url");
}

function vt_require_yui()
{
   require_once("vt-yui.inc");
}
?>

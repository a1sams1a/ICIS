<?php
define('ICIS', '0.2');
include_once('core/library_common.php');
include_once('core/library_web.php');
	
if (false) {
	include('page/working.php');
	exit();
}

if (!isset($_COOKIE['uid']) || !isset($_COOKIE['key']) || !Library::Validate($_COOKIE['uid'], $_COOKIE['key'])) {
	echo '<meta http-equiv="refresh" content="0;url=login.php">';
	exit();
}

if (!isset($_GET['action']))
	$_GET['action'] = 'main';
	
$page_file_name = 'page/'.$_GET['action'].'.php';
if (is_file($page_file_name))
	$GLOBALS['current-page'] = $page_file_name;
else
	$GLOBALS['current-page'] = 'page/error.php';
		
include ('page/header.php');
include ($GLOBALS['current-page']);
include ('page/footer.php');

?>
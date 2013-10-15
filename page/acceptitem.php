<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');

if (!isset($_GET['pid'])) {
	echo '<meta http-equiv="refresh" content="0;url=?action=error">';
	exit();
}

$result = WebLibrary::AcceptItem($_GET['pid'], $_COOKIE['uid']);

if ($result === true)
	echo '<meta http-equiv="refresh" content="0;url=?action=success">';
else
	echo '<meta http-equiv="refresh" content="0;url=?action=error">';
?>
<?php

define('ICIS', '0.2');
include_once('./../lib/library_api.php');
include_once('./../lib/fnc_logincheck.php');

if (!isset($_POST['pid']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo APILibrary::AcceptItem($_POST['pid'], $_COOKIE['uid']);

?>
<?php

define('ICIS', '0.2');
include_once('./../lib/library_api.php');
include_once('./../lib/fnc_logincheck.php');

if (!isset($_POST['pw']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo APILibrary::ChangePassword($_COOKIE['uid'], $_POST['pw']);

?>
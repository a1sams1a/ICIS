<?php

define('ICIS', '0.2');
include_once('./../lib/library_api.php');
include_once('./../lib/fnc_logincheck.php');

if (!isset($_POST['touid']) || !isset($_POST['date']) || !isset($_POST['money']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo APILibrary::GiveMoney($_COOKIE['uid'], $_POST['touid'], $_POST['date'], $_POST['money']);

?>
<?php

define('ICIS', '0.2');
include_once('./../lib/library_api.php');
include_once('./../lib/fnc_logincheck.php');

if (!isset($_POST['name']) || !isset($_POST['date']) || !isset($_POST['debtlist']) || !isset($_POST['paylist']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo APILibrary::AddItem($_POST['name'], $_POST['date'], $_POST['debtlist'], $_POST['paylist']);

?>
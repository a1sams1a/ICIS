<?php

define('ICIS', '0.2');
include_once('./../lib/library_api.php');

if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['pw']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo APILibrary::Register($_POST['id'], $_POST['name'], $_POST['pw']);

?>
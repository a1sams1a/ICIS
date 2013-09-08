<?php

define('__ICISAPI__', '0.1');
include_once('./../lib/Library.php');

if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['pw']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo Library::Register($_POST['id'], $_POST['name'], $_POST['pw']);

?>
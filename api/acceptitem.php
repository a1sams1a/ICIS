<?php

define('__ICISAPI__', '0.1');
include_once('./../lib/Library.php');
include_once('./../lib/LoginCheck.php');

if (!isset($_POST['pid']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo Library::AcceptItem($_POST['pid'], $_COOKIE['uid']);

?>
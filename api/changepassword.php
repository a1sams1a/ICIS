<?php

define('__ICISAPI__', '0.1');
include_once('./../lib/Library.php');
include_once('./../lib/LoginCheck.php');

if (!isset($_POST['pw']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo Library::ChangePassword($_COOKIE['uid'], $_POST['pw']);

?>
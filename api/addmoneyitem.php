<?php

define('__ICISAPI__', '0.1');
include_once('./../lib/Library.php');
include_once('./../lib/LoginCheck.php');

if (!isset($_POST['touid']) || !isset($_POST['date']) || !isset($_POST['money']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo Library::GiveMoney($_COOKIE['uid'], $_POST['touid'], $_POST['date'], $_POST['money']);

?>
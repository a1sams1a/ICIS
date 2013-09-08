<?php

define('__ICISAPI__', '0.1');
include_once('./../lib/Library.php');
include_once('./../lib/LoginCheck.php');

if (!isset($_POST['name']) || !isset($_POST['date']) || !isset($_POST['debtlist']) || !isset($_POST['paylist']))
	die('#ICIS#@ERROR@206@NOT_PARAM_SET');
	
echo Library::AddItem($_POST['name'], $_POST['date'], $_POST['debtlist'], $_POST['paylist']);

?>
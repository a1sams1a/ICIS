<?php

if (!defined('__ICISAPI__'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once('Library.php');

if (!isset($_COOKIE['uid']) || !isset($_COOKIE['key']))
	die('#ICIS#@ERROR@205@NOT_LOGGED_IN');

$result = Library::Validate($_COOKIE['uid'], $_COOKIE['key']);

if ($result === false)
	die('#ICIS#@ERROR@206@INVALID_COOKIE');
	
?>
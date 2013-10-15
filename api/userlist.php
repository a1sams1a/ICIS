<?php

define('ICIS', '0.2');
include_once('./../lib/library_api.php');
include_once('./../lib/fnc_logincheck.php');
	
echo APILibrary::UserList();

?>
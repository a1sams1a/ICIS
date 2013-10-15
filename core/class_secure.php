<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

class Secure {
	public static function GetDBPassword() {
		return 'db-password';
	}
	
	public static function GetKey($uid) {
		return sha1($uid.'abcdef'.$uid.'abcdef');
	}
}

?>
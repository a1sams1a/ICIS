<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

class Secure {
	public static function GetDBPassword() {
		return 'db-password';
	}
	
	public static function GetKey($uid, $salt) {
		return sha1($uid.'abcdef'.$uid.'abcdef'.$salt);
	}
	
	public static function MakeSalt($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
		$size = strlen($chars);
		$str = '';
		for($i = 0; $i < $length; $i += 1)
			$str .= $chars[rand(0, $size-1)];
		return $str;
	}
}

?>
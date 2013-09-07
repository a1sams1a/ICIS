<?php
include_once ('./../class/User.php');
include_once ('./../class/Item.php');
include_once ('./../class/Error.php');
include_once ('DBEngine.php');

static class useraction {
	public static function makeuser($name, $pw) {
		$invaildlist = array('@', ':', ',');
		foreach ($invalidlist as $ch)
			if (strpos($name, $ch) !== false)
				return new error('200', 'User name contains invaild char: '.$ch);
		if (strlen($pw) < 8) {
			return new error('201', 'Password should be at least 8 characters');
		
		//TODO: insert DB
	}
	
	public static function getuserinfo($pid) {
		
	
	}
}

?>
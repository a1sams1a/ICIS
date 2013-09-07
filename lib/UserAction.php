<?php
include_once ('./../class/User.php');
include_once ('./../class/Item.php');
include_once ('./../class/Error.php');
include_once ('DBEngine.php');

static class UserAction {
	public static function MakeUser($id, $name, $pw) {
		if (strlen($id) < 4 || strlen($name) < 2)
			return new Error('201', '');
		else if (strlen($id) > 15 || strlen($name) > 8)
			return new Error('200', '');
		
		if (strlen($pw) < 8) {
			return new Error('201', 'Password should be at least 8 characters');
		
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery(); // TODO: Make Query for check dup id
		if ($result === false) return new Error('101', 'DB select fail');
		
		if (count($result) != 0) return new Error('200', 'User id duplicate');
		
		$result = $dEngine->RunQuery(); // TODO: Make Query for Insert user
		if ($result === false) return new Error('101', 'DB select fail');
		
		return 'success';
	}
	
	public static function UpdateUser($uid, $user) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery(); // TODO: Make Query for update user
		if ($result === false) return new Error('102', 'DB update fail');
		
		return 'success';
	}

	public static function GetUser($uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery(); // TODO: Make Query for get userinfo
		if ($result === false) return new Error('101', 'DB select fail');
		
		if (count($result) == 0) return new Error('203', 'User id '.$uid.' does not exist');
		$userdata = $row[0];
		return new User($userdata['uid'], $userdata['id'], $userdata['name'], $userdata['pw']);
	}
	
	public static function GetUserList() {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery(); // TODO: Make Query for get user list
		if ($result === false) return new Error('101', 'DB select fail');
		
		return $result;
	}
		
	public static function AuthUser($id, $pw) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery(); // TODO: Make Query for change password
		if ($result === false) return new Error('101', 'DB select fail');
		
		if (count($result) == 0) return false;
		return true;
	}
}

?>
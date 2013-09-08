<?php
include_once ('./../class/User.php');
include_once ('./../class/Item.php');
include_once ('./../class/Error.php');
include_once ('DBEngine.php');

static class UserAction {
	public static function MakeUser($id, $name, $pw) {
		if (strlen($id) < 4 || strlen($name) < 2)
			return new Error('211', 'INPUT_IS_TOO_SHORT');
		else if (strlen($id) > 15 || strlen($name) > 8)
			return new Error('212', 'INPUT_IS_TOO_LONG');
		
		if (strlen($pw) < 8) {
			return new Error('211', 'INPUT_IS_TOO_SHORT');
		
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM user WHERE id = ".$id);
		if ($result === false) return new Error('102', 'DB_SELECT_FAIL');
		
		if (count($result) != 0) return new Error('213', 'INPUT_MUST_BE_UNIQUE');
		
		$result = $dEngine->RunQuery("INSERT INTO user (id, name, pw) VALUES ('".$id."', '".$name."', '".$pw."')");
		if ($result === false) return new Error('101', 'DB_INSERT_FAIL');
		
		return true;
	}
	
	public static function ChangePassword($uid, $pw) {
		if (strlen($pw) < 8) {
			return new Error('211', 'INPUT_IS_TOO_SHORT');
			
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("UPDATE user SET pw = '".$pw."' WHERE uid = ".$uid);
		if ($result === false) return new Error('103', 'DB_UPDATE_FAIL');
		
		return true;
	}

	public static function GetUser($uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM user WHERE uid = ".$uid);
		if ($result === false) return new Error('102', 'DB_SELECT_FAIL');
		
		if (count($result) == 0) return new Error('201', 'SUCH_UID_NOT_EXIST');
		$userdata = $result[0];
		return new User($userdata['uid'], $userdata['id'], $userdata['name'], $userdata['pw']);
	}
	
	public static function GetUserList() {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT uid FROM user");
		if ($result === false) return new Error('102', 'DB_SELECT_FAIL');
		
		$userlist = array();
		foreach ($result as $row)
			array_push(GetUser($row['uid']), $userlist);  
		return $userlist;
	}
		
	public static function AuthUser($id, $pw) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM user WHERE id = '".$id."' AND pw = '".$pw."'");
		if ($result === false) return new Error('102', 'DB_SELECT_FAIL');
		
		if (count($result) == 0) return false;
		return true;
	}
}

?>
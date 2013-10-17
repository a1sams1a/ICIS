<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once ('class_user.php');
include_once ('class_item.php');
include_once ('class_dbengine.php');

class UserAction {
	public static function MakeUser($id, $name, $pw) {
		if (strlen($id) < 4 || strlen($name) < 2) return false;
		if (strlen($id) > 15 || strlen($name) > 15) return false;
		
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM user WHERE id = '".$id."'");
		if ($result === false) return false;
		if (count($result) != 0) return false;
		$result = $dEngine->RunQuery("INSERT INTO user (id, name, pw, salt) VALUES ('".$id."', '".$name."', '".$pw."', '')");
		if ($result === false) return false;
		
		return true;
	}
	
	public static function ChangePassword($uid, $pw) {
		if ($uid == 1) return false;
			
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("UPDATE user SET pw = '".$pw."' WHERE uid = ".$uid);
		if ($result === false) return false;
		
		return true;
	}

	public static function ChangeSalt($uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("UPDATE user SET salt = '".Secure::MakeSalt(15)."' WHERE uid = ".$uid);
		if ($result === false) return false;
		
		return true;
	}
		
	public static function GetUser($uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM user WHERE uid = ".$uid);
		if ($result === false) return false;
		
		if (count($result) == 0) return false;
		$userdata = $result[0];
		return new User($userdata['uid'], $userdata['id'], $userdata['name'], $userdata['pw'], $userdata['salt']);
	}
	
	public static function GetUserList() {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT uid FROM user");
		if ($result === false) return false;
		
		$userlist = array();
		foreach ($result as $row)
			$userlist[] = UserAction::GetUser($row['uid']);
		return $userlist;
	}
		
	public static function AuthUser($id, $pw) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM user WHERE id = '".$id."' AND pw = '".$pw."'");
		if ($result === false) return false;
		if (count($result) == 0) return false;
		
		$user = $result[0];
		$newsalt = Secure::MakeSalt(15);
		$result = $dEngine->RunQuery("UPDATE user SET salt = '".$newsalt."' WHERE uid = ".$user['uid']);
		if ($result === false) return false;
		
		$user['salt'] = $newsalt;
		return $user;
	}
		
	public static function GetNumberOfUser() {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT uid FROM user");
		if ($result === false) return false;

		return count($result);
	}
	
	public static function GetUserStatus($uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT touid, money FROM userstatus WHERE uid = ".$uid);
		if ($result === false) return false;

		return $result;
	}
}

?>
<?php

if (!defined('__ICIS__'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once ('./../class/User.php');
include_once ('./../class/Item.php');
include_once ('DBEngine.php');

class UserAction {
	public static function MakeUser($id, $name, $pw) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM ICIS_user WHERE id = '".$id."'");
		if ($result === false) return false;
		if (count($result) != 0) return false;
		
		$result = $dEngine->RunQuery("INSERT INTO ICIS_user (id, name, pw) VALUES ('".$id."', '".$name."', '".$pw."')");
		if ($result === false) return false;
		
		return true;
	}
	
	public static function ChangePassword($uid, $pw) {
		if (strlen($pw) < 8)
			return false;
			
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("UPDATE ICIS_user SET pw = '".$pw."' WHERE uid = ".$uid);
		if ($result === false) return false;
		
		return true;
	}

	public static function GetUser($uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM ICIS_user WHERE uid = ".$uid);
		if ($result === false) return false;
		
		if (count($result) == 0) return false;
		$userdata = $result[0];
		return new User($userdata['uid'], $userdata['id'], $userdata['name'], $userdata['pw']);
	}
	
	public static function GetUserList() {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT uid FROM ICIS_user");
		if ($result === false) return false;
		
		$userlist = array();
		foreach ($result as $row)
			$userlist[] = GetUser($row['uid']);
		return $userlist;
	}
		
	public static function AuthUser($id, $pw) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM ICIS_user WHERE id = '".$id."' AND pw = '".$pw."'");
		if ($result === false) return false;
		
		if (count($result) == 0) return false;
		return $result[0];
	}
		
	public static function GetNumberOfUser() {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT uid FROM ICIS_user");
		if ($result === false) return false;

		return count($result);
	}
}

?>
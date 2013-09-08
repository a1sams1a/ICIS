<?php

if (!defined('__ICISAPI__'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

define('__ICIS__', '0.1');
include_once('UserAction.php');
include_once('ItemAction.php');

static class Library {
	private static function generateKey($uid) {
		return sha1($uid.'aj439aAvjk4qdVssakjkl4ASFgji4d'.$uid.'ejaaq%#9v2hdVSajeka');
	}
	
	private static function filterValue($arr) {
		$restricted = array(';', '\'', '@', '#', '$', '*', '"');
		foreach ($arr as $input)
			foreach ($restricted $re) {
				if (strpos($input, $re) !== false)
					return false;
		return true;
	}
	
	private static function strToList($str) {
		$list = array();
		$dt = explode(',', $str);
		foreach ($dt as $onedt) {
			$kv = explode(':', $onedt);
			if (count($kv) != 2) return false;
			$list[$kv[0]] = $kv[1];
		}
		return $list;
	}
	
	public static function Login($id, $pw) {
		if (!filterValue(array($id, $pw))
			return implode('@', array('#ICIS#', 'ERROR', '201', 'CONTAIN_RESTRICTED_CHAR'));
		
		$uid = UserAction::AuthUser($id, $pw);
		if ($uid !== false)
			return implode('@', array('#ICIS#', 'COOKIE', $uid, generateKey($uid)));
		return implode('@', array('#ICIS#', 'ERROR', '301', 'NOT_VAILD_USER_INFO'));
	}
	
	public static function Validate($uid, $key) {
		$corrkey = generateKey($uid);
		if ($corrkey == $key)
			return true;
		return false;
	}
	
	public static function Register($id, $name, $pw) {
		if (!filterValue(array($id, $name, $pw))
			return implode('@', array('#ICIS#', 'ERROR', '201', 'CONTAIN_RESTRICTED_CHAR'));
				
		if (strlen($id) < 4 || strlen($name) < 2)
			return implode('@', array('#ICIS#', 'ERROR', '202', 'INPUT_IS_TOO_SHORT'));

		if (strlen($id) > 15 || strlen($name) > 8)
			return implode('@', array('#ICIS#', 'ERROR', '203', 'INPUT_IS_TOO_LONG'));

		if (strlen($pw) < 8) {
			return implode('@', array('#ICIS#', 'ERROR', '202', 'INPUT_IS_TOO_SHORT'));
			
		if (UserAction::MakeUser($id, $name, $pw) === false)
			return implode('@', array('#ICIS#', 'ERROR', '302', 'USER_ID_MUST_BE_UNIQUE'));
		
		return implode('@', array('#ICIS#', 'SUCCESS'));
	}
	
	public static function UserStatus($uid) {
		// TODO
	}

	public static function ItemList($uid) {
		$itemlist = ItemAction::GetItemList($uid);
		if ($itemlist === false)
			return implode('@', array('#ICIS#', 'ERROR', '101', 'UNKNOWN_QUERY_ERROR'));
		
		$result = '';
		foreach ($itemlist as $item)
			$result .= $item->ToString();
			
		return $result;
	}
	
	public static function AddItem($name, $date, $debtliststr, $payliststr) {
		if (!filterValue(array($name, $date, $debtliststr, $payliststr))
			return implode('@', array('#ICIS#', 'ERROR', '201', 'CONTAIN_RESTRICTED_CHAR'));
			
		if (strlen($name) < 3 || strlen($date) < 10)
			return implode('@', array('#ICIS#', 'ERROR', '202', 'INPUT_IS_TOO_SHORT'));

		if (strlen($name) > 15 || strlen($date) > 10)
			return implode('@', array('#ICIS#', 'ERROR', '203', 'INPUT_IS_TOO_LONG'));
		
		$debtlist = strToList($debtliststr);
		$paylist = strToList($payliststr);
		if ($debtlist === false || $paylist === false)
			return implode('@', array('#ICIS#', 'ERROR', '204', 'INPUT_MUST_BE_LIST'));
			
		$result = ItemAction::MakeItem($name, $date, $debtlist, $paylist);
		if ($result === false)
			return implode('@', array('#ICIS#', 'ERROR', '101', 'UNKNOWN_QUERY_ERROR'));
			
		return implode('@', array('#ICIS#', 'SUCCESS'));
	}
	
	public static function AcceptItem($pid, $uid) {
		if (!filterValue(array($pid, $uid))
			return implode('@', array('#ICIS#', 'ERROR', '201', 'CONTAIN_RESTRICTED_CHAR'));
			
		$result = ItemAction::AcceptItem($pid, $uid);
		if ($result === false)
			return implode('@', array('#ICIS#', 'ERROR', '101', 'UNKNOWN_QUERY_ERROR'));
			
		return implode('@', array('#ICIS#', 'SUCCESS'));
	}
	
	public static function UserList() {
		$userlist = UserAction::GetUserList();
		if ($userlist === false)
			return implode('@', array('#ICIS#', 'ERROR', '101', 'UNKNOWN_QUERY_ERROR'));
		
		$result = '';
		foreach ($userlist as $user)
			$result .= $user->ToString();
			
		return $result;
	}
	
	public static function RequestList($uid) {
		$itemlist = ItemAction::GetItemList($uid);
		if ($itemlist === false)
			return implode('@', array('#ICIS#', 'ERROR', '101', 'UNKNOWN_QUERY_ERROR'));
		
		$result = '';
		foreach ($itemlist as $item)
			if ($item->statusList[$uid] != 'TRUE')
				$result .= $item->ToString();
				
		return $result;
	}
?>
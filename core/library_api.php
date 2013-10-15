<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once('library_common.php');

class APILibrary {
	private static function stringToList($str) {
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
		$result = Library::Login($id, $pw);
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		
		return implode('@', array('#ICIS#', 'COOKIE', $result[0], $result[1], $result[2]));
	}
	
	public static function ChangePassword($uid, $pw) {
		$result = Library::ChangePassword($uid, $pw);
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		return '#ICIS#@SUCCESS';
	}
	
	public static function Register($id, $name, $pw) {
		$result = Library::Register($id, $name, $pw);
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		return '#ICIS#@SUCCESS';
	}
	
	public static function UserStatus($uid) {
		$result = Library::UserStatus($uid);
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		return implode('@', array('#ICIS#', 'MONEY', $result[0], $result[1], $result[2], $result[3]));
	}

	public static function ItemList($uid) {
		$result = Library::ItemList($uid);
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		$output = '';
		foreach ($result as $item)
			$output .= $item->ToString()."\n";
		return $output;
	}
	
	public static function GiveMoney($uid, $touid, $date, $money) {
		$result = Library::GiveMoney($uid, $touid, $date, $money);
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		return '#ICIS#@SUCCESS';
	}
	
	public static function AddItem($name, $date, $debtliststr, $payliststr) {
		$debtlist = APILibrary::stringToList($debtliststr);
		$paylist = APILibrary::stringToList($payliststr);
		if ($debtlist === false || $paylist === false) return '#ICIS#@ERROR@101@NOT_LIST';
		
		$result = Library::AddItem($name, $date, $debtlist, $paylist);
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		return '#ICIS#@SUCCESS';
	}
	
	public static function AcceptItem($pid, $uid) {
		$result = Library::AcceptItem($pid, $uid);
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		return '#ICIS#@SUCCESS';
	}
	
	public static function UserList() {
		$result = Library::UserList();
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		$output = '';
		foreach ($result as $user)
			$output .= $user->ToString()."\n";
		return $output;
	}
	
	public static function RequestList($uid) {
		$result = Library::RequestList($uid);
		if ($result === false) return '#ICIS#@ERROR@100@SERVER_ERROR';
		$output = '';
		foreach ($result as $item)
			$output .= $item->ToString()."\n";
		return $output;
	}
}
?>
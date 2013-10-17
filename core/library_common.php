<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once('action_user.php');
include_once('action_item.php');
include_once('action_calc.php');

class Library {
	private static function filterValue($arr) {
		$restricted = array(";", "'", "@", "#", "$", "*", '\\', '"');
		foreach ($arr as $input)
			foreach ($restricted as $re)
				if (gettype($input) == 'string' && strpos($input, $re) !== false)
					return false;
		return true;
	}
	
	public static function Login($id, $pw) {
		if (Library::filterValue(array($id, $pw)) === false) return false;
		$result = UserAction::AuthUser($id, $pw);
		if ($result === false) return false;
		return array($result['uid'], $result['name'], Secure::GetKey($result['uid'], $result['salt']));
	}
	
	public static function ChangePassword($uid, $pw) {
		if (Library::filterValue(array($uid, $pw)) === false) return false;
		if (UserAction::ChangePassword($uid, $pw) === false) return false;	
		return true;
	}
	
	public static function ChangeSalt($uid) {
		if (Library::filterValue(array($uid)) === false) return false;
		if (UserAction::ChangeSalt($uid) === false) return false;	
		return true;
	}
	
	public static function KickUser() {
		$n = UserAction::GetNumberOfUser();
		for ($i = 2; $i <= $n; $i += 1)
			if (Library::ChangeSalt($i) === false)
				return false;
		return true;
	}
	
	public static function Validate($uid, $key) {
		$corrkey = Secure::GetKey($uid, Library::GetSalt($uid));
		if ($corrkey == $key) return true;
		return false;
	}
	
	public static function GetSalt($uid) {
		if (Library::filterValue(array($uid)) === false) return false;
		$result = UserAction::GetUser($uid);
		if ($result === false) return false;
		return $result->GetSalt();
	}
	
	public static function Register($id, $name, $pw) {
		if (!Library::filterValue(array($id, $name, $pw))) return false;
		if (UserAction::MakeUser($id, $name, $pw) === false) return false;
		return true;
	}
	
	public static function UserStatus($uid) {
		if (Library::filterValue(array($uid)) === false) return false;
		return UserAction::GetUserStatus($uid);
	}

	public static function ItemList($uid) {
		if (Library::filterValue(array($uid)) === false) return false;
		$itemlist = ItemAction::GetItemList($uid);
		if ($itemlist === false) return false;
		return $itemlist;
	}
	
	public static function GiveMoney($uid, $touid, $date, $money) {
		if (!Library::filterValue(array($uid, $touid, $date, $money))) return false;
		$debtlist = array($touid => $money);
		$paylist = array($uid => $money);
		$result = ItemAction::MakeItem('채무 관계 정산', $date, $debtlist, $paylist);
		if ($result === false) return false;
		return true;
	}
	
	public static function AddItem($name, $date, $debtlist, $paylist) {
		if (!Library::filterValue(array($name, $date, $debtlist, $paylist))) return false;
		$result = ItemAction::MakeItem($name, $date, $debtlist, $paylist);
		if ($result === false) return false;
		return true;
	}
	
	public static function AcceptItem($pid, $uid) {
		if (!Library::filterValue(array($pid, $uid))) return false;	
		$result = ItemAction::AcceptItem($pid, $uid);
		if ($result === false) return false;
		
		if (ItemAction::IsAllAgreed($pid)) {
			$result = CalcAction::UpdateStatus(ItemAction::GetAcceptItemList(), UserAction::GetNumberOfUser());
			if ($result === false) return false;
		}
		return true;
	}
	
	public static function UserList() {
		$userlist = UserAction::GetUserList();
		if ($userlist === false) return false;
		return $userlist;
	}
	
	public static function RequestList($uid) {
		$itemlist = ItemAction::GetItemList($uid);
		if ($itemlist === false) return false;
		
		$requestitemlist = array();
		foreach ($itemlist as $item) {
			$statuslist = $item->GetStatusList();
			if ($statuslist[$uid] != 'TRUE')
				$requestitemlist[] = $item;
		}
		return $requestitemlist;
	}
}

?>
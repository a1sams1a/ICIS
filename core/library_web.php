<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once('library_common.php');

class WebLibrary {
	public static function ShiftListArr($list) {
		$newlist = array();
		foreach ($list as $key => $value)
			$newlist[$key + 1] = $value;
		return $newlist;
	}
	
	public static function ListToString($list) {
		$str = '';
		foreach ($arr as $key => $value) {
			if ($value == '') continue;
			$str .= ($key + 1).':'.$value.',';
		}
		return substr($str, 0, -1);
	}
	
	public static function MakeAddItemTable() {
		$tablestr = '';
		$userlist = WebLibrary::UserList();
		for ($i = 0; $i < count($userlist); $i += 1) {
			$tablestr .= '<tr>';
			$tablestr .= '<td>'.$userlist[$i]->GetName().'</td>';
			$tablestr .= '<td><input type="text" class="form-control" pattern="[0-9]*" name="debt[]"></td>
				<td><input type="text" class="form-control" pattern="[0-9]*" name="pay[]"></td>
				</tr>';
		}
		return $tablestr;
	}
	
	public static function MakeUserSelect($uid) {
		$selectstr = '';
		$userlist = WebLibrary::UserList();
		for ($i = 0; $i < count($userlist); $i += 1) {
			if ($userlist[$i]->GetUid() == $uid) continue;
			$selectstr .= '<option value="'.$userlist[$i]->GetUid().'">';
			$selectstr .= $userlist[$i]->GetName().'</option>';
		}
		return $selectstr;
	}
	
	public static function MakeUserList() {
		$liststr = '';
		$userlist = WebLibrary::UserList();
		for ($i = 0; $i < count($userlist); $i += 1) {
			$liststr .= '<tr>';
			$liststr .= '<td>'.$userlist[$i]->GetUid().'</td>';
			$liststr .= '<td>'.$userlist[$i]->GetId().'</td>';
			$liststr .= '<td>'.$userlist[$i]->GetName().'</td></tr>';
		}
		return $liststr;
	}
	
	public static function GetName($uid) {
		$userlist = WebLibrary::UserList();
		return WebLibrary::uidToName($userlist, $uid);
	}
	
	private static function uidToName($userlist, $uid) {
		foreach ($userlist as $user)
			if ($user->GetUid() == $uid) return $user->GetName();
	}

	private static function makeDebtPayList($list, $userlist) {
		$str = '';
		foreach ($list as $key => $value)
			$str .= WebLibrary::uidToName($userlist, $key).' '.$value.'; ';
		return $str;
	}

	private static function makeStatusList($list, $userlist) {
		$str = '';
		foreach ($list as $key => $value)
			if ($value == 'TRUE')
				$str .= WebLibrary::uidToName($userlist, $key).', ';
		if ($str == '') return '없음';
		return substr($str, 0, -2).'만 승인';
	}
	
	public static function MakeItemList($uid, $islimit, $isrequestonly) {
		$liststr = '';
		$userlist = WebLibrary::UserList();
		$itemlist = ($isrequestonly === true) ? WebLibrary::RequestList($uid) : WebLibrary::ItemList($uid);
		$limit = count($itemlist);
		if ($islimit && $limit > 30) $limit = 30;
		for ($i = 0; $i < $limit; $i += 1) {
			$statuslist = $itemlist[$i]->GetStatusList();
			$allagree = true;
			$meagree = ($statuslist[$uid] == 'TRUE');
			foreach ($statuslist as $key => $value)
				if ($allagree && $value != 'TRUE')
					$allagree = false;
			
			if ($isrequestonly)
				$liststr .= '<tr>';
			elseif ($allagree)
				$liststr .= '<tr class="success">';
			elseif ($meagree)
				$liststr .= '<tr class="warning">';
			else
				$liststr .= '<tr class="danger">';
			$liststr .= '<td>'.$itemlist[$i]->GetDate().'</td>';
			$liststr .= '<td>'.$itemlist[$i]->GetName().'</td>';
			$liststr .= '<td>'.WebLibrary::makeDebtPayList($itemlist[$i]->GetDebtList(), $userlist).'</td>';
			$liststr .= '<td>'.WebLibrary::makeDebtPayList($itemlist[$i]->GetPayList(), $userlist).'</td>';
			if ($meagree)
				$liststr .= '<td><a href="#" class="btn btn-xs btn-danger" disabled>완료</a></td>';
			else
				$liststr .= '<td><a href="?action=acceptitem&pid='.$itemlist[$i]->GetPid().'" class="btn btn-xs btn-success">승인</a></td>';
			if ($allagree)
				$liststr .= '<td>모두 승인</td></tr>';
			else
				$liststr .= '<td>'.WebLibrary::makeStatusList($statuslist, $userlist).'</td></tr>';
		}
		return $liststr;
	}

	public static function Login($id, $pw) {
		$result = Library::Login($id, $pw);
		if ($result === false) return false;
		
		return array($result[0], $result[2]);
	}
	
	public static function ChangePassword($uid, $pw) {
		return Library::ChangePassword($uid, $pw);
	}
	
	public static function Register($id, $name, $pw) {
		return Library::Register($id, $name, $pw);
	}
	
	public static function UserStatus($uid) {
		$result = Library::UserStatus($uid);
		$userlist = WebLibrary::UserList();
		$list = array();
		for ($i = 0; $i < count($result); $i++) 
			$list[WebLibrary::uidToName($userlist, $result[$i]['touid'])] = $result[$i]['money'];
		return $list;
	}

	public static function ItemList($uid) {
		return Library::ItemList($uid);
	}
	
	public static function GiveMoney($uid, $touid, $date, $money) {
		return Library::GiveMoney($uid, $touid, $date, $money);
	}
	
	public static function AddItem($name, $date, $debtlist, $paylist) {
		$newdebtlist = WebLibrary::ShiftListArr($debtlist);
		$newpaylist = WebLibrary::ShiftListArr($paylist);
		return Library::AddItem($name, $date, $newdebtlist, $newpaylist);
	}
	
	public static function AcceptItem($pid, $uid) {
		return Library::AcceptItem($pid, $uid);
	}
	
	public static function UserList() {
		return Library::UserList();
	}
	
	public static function RequestList($uid) {
		return Library::RequestList($uid);
	}
}
?>
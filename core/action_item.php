<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once ('class_user.php');
include_once ('class_item.php');
include_once ('class_dbengine.php');

class ItemAction {
	public static function MakeItem($name, $date, $debtlist, $paylist) {
		if (strlen($name) < 3 || strlen($date) < 10) return false;
		if (strlen($name) > 80 || strlen($date) > 10) return false;
		$debtsum = 0; $paysum = 0;
		foreach ($debtlist as $key => $value) $debtsum += $value;
		foreach ($paylist as $key => $value) $paysum += $value;
		if ($debtsum != $paysum) return false;
		
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("INSERT INTO item (name, date) VALUES ('".$name."', '".$date."')");
		if ($result === false) return false;

		$result = $dEngine->RunQuery("SELECT pid FROM item ORDER BY pid DESC LIMIT 1");
		if ($result === false) return false;
		
		$pid = $result[0]['pid'];
		$statuslist = array();
		foreach ($debtlist as $key => $value) {
			if ($value == null) continue;
			$result = $dEngine->RunQuery("INSERT INTO itemdebt (pid, uid, money) VALUES (".$pid.", ".$key.", ".$value.")");
			if ($result === false) return false;
			
			if (in_array($key, $statuslist) === false)
				$statuslist[] = $key;
		}
		
		foreach ($paylist as $key => $value) {
			if ($value == null) continue;
			$result = $dEngine->RunQuery("INSERT INTO itempay (pid, uid, money) VALUES (".$pid.", ".$key.", ".$value.")");
			if ($result === false) return false;
			
			if (in_array($key, $statuslist) === false)
				$statuslist[] = $key;
		}

		foreach ($statuslist as $person) {
			$result = $dEngine->RunQuery("INSERT INTO itemstatus (pid, uid, status) VALUES (".$pid.", ".$person.", 'FALSE')");
			if ($result === false) return false;
		}
		
		return true;
	}

	public static function GetItem($pid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM item WHERE pid = ".$pid);
		if ($result === false) return false;
		
		if (count($result) == 0) return false;
		$itemdata = $result[0];

		$debtlist = array();
		$result = $dEngine->RunQuery("SELECT uid, money FROM itemdebt WHERE pid = ".$pid);
		if ($result === false) return false;
		foreach ($result as $row)
			$debtlist[$row['uid']] = $row['money'];
		
		$paylist = array();
		$result = $dEngine->RunQuery("SELECT uid, money FROM itempay WHERE pid = ".$pid);
		if ($result === false) return false;
		foreach ($result as $row)
			$paylist[$row['uid']] = $row['money'];

		$statuslist = array();
		$result = $dEngine->RunQuery("SELECT uid, status FROM itemstatus WHERE pid = ".$pid);
		if ($result === false) return false;
		foreach ($result as $row)
			$statuslist[$row['uid']] = $row['status'];

		return new Item($itemdata['pid'], $itemdata['name'], $itemdata['date'], $debtlist, $paylist, $statuslist);
	}
	
	public static function GetItemList($uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT pid FROM item ORDER BY pid DESC");
		if ($result === false) return false;
		
		$itemlist = array();
		foreach ($result as $row) {
			$item = ItemAction::GetItem($row['pid']);
			if (array_key_exists($uid, $item->GetStatusList()) || $uid == 1)
				$itemlist[] = $item;
		}
		return $itemlist;
	}
	
	public static function GetAcceptItemList() {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT pid FROM item");
		if ($result === false) return false;
		
		$itemlist = array();
		foreach ($result as $row)
			if (ItemAction::IsAllAgreed($row['pid']))
				$itemlist[] = ItemAction::GetItem($row['pid']);
		return $itemlist;
	}
	
	public static function AcceptItem($pid, $uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("UPDATE itemstatus SET status = 'TRUE' WHERE pid = ".$pid." AND uid = ".$uid);
		if ($result === false) return false;

		return true;
	}
	
	public static function IsAllAgreed($pid) {
		$item = ItemAction::GetItem($pid);
		if ($item === false) return false;
		$statuslist = $item->GetStatusList();
		foreach ($statuslist as $key => $value)
			if ($value != 'TRUE') return false;
		return true;
	}
}

?>
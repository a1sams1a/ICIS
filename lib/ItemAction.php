<?php

if (!defined('__ICIS__'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once ('./../class/User.php');
include_once ('./../class/Item.php');
include_once ('DBEngine.php');

class ItemAction {
	public static function MakeItem($name, $date, $debtlist, $paylist) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("INSERT INTO ICIS_item (name, date) VALUES ('".$name."', '".$date."')");
		if ($result === false) return false;

		$result = $dEngine->RunQuery("SELECT pid FROM ICIS_item ORDER BY pid DESC LIMIT 1");
		if ($result === false) return false;
		
		$pid = $result[0]['pid'];
		$statuslist = array();
		foreach ($debtlist as $key => $value) {
			$result = $dEngine->RunQuery("INSERT INTO ICIS_itemdebt (pid, uid, money) VALUES (".$pid.", ".$key.", ".$value.")");
			if ($result === false) return false;
			
			if (array_key_exists($key, $statuslist) === false)
				$statuslist[] = $key;
		}
		
		foreach ($paylist as $key => $value) {
			$result = $dEngine->RunQuery("INSERT INTO ICIS_itempay (pid, uid, money) VALUES (".$pid.", ".$key.", ".$value.")");
			if ($result === false) return false;
			
			if (array_key_exists($key, $statuslist) === false)
				$statuslist[] = $key;
		}

		foreach ($statuslist as $person) {
			$result = $dEngine->RunQuery("INSERT INTO ICIS_itemstatus (pid, uid, status) VALUES (".$pid.", ".$person.", 'FALSE')");
			if ($result === false) return false;
		}
		
		return true;
	}

	public static function GetItem($pid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT * FROM ICIS_item WHERE pid = ".$pid);
		if ($result === false) return false;
		
		if (count($result) == 0) return new Error('202', 'SUCH_PID_NOT_EXIST');
		$itemdata = $result[0];

		$debtlist = array();
		$result = $dEngine->RunQuery("SELECT uid, money FROM ICIS_itemdebt WHERE pid = ".$pid);
		if ($result === false) return false;
		foreach ($result as $row)
			$debtlist[$row['uid']] = $row['money'];
		
		$paylist = array();
		$result = $dEngine->RunQuery("SELECT uid, money FROM ICIS_itempay WHERE pid = ".$pid);
		if ($result === false) return false;
		foreach ($result as $row)
			$paylist[$row['uid']] = $row['money'];

		$statuslist = array();
		$result = $dEngine->RunQuery("SELECT uid, status FROM ICIS_itemstatus WHERE pid = ".$pid);
		if ($result === false) return false;
		foreach ($result as $row)
			$statuslist[$row['uid']] = $row['status'];

		return new Item($itemdata['pid'], $itemdata['name'], $itemdata['date'], $debtlist, $paylist, $statuslist);
	}
	
	public static function GetItemList($uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT pid FROM ICIS_item");
		if ($result === false) return false;
		
		$itemlist = array();
		foreach ($result as $row) {
			$item = ItemAction::GetItem($row['pid']);
			if (array_key_exists($uid, $item->GetStatusList()))
				$itemlist[] = $item;
		}
		return $itemlist;
	}
	
	public static function AcceptItem($pid, $uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("UPDATE ICIS_itemstatus SET status = 'TRUE' WHERE pid = ".$pid." AND uid = ".$uid);
		if ($result === false) return false;

		return true;
	}
	
	public static function IsAllAgreed($pid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("SELECT uid, status FROM ICIS_itemstatus WHERE pid = ".$pid);
		if ($result === false) return false;
		
		$allagreed = true;
		foreach ($result as $row) {
			if ($row['status'] != 'TRUE') {
				$allagreed = false;
				break;
			}
		}
		return $allagreed;
	}
}

?>
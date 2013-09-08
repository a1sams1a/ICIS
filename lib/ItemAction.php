<?php
include_once ('./../class/User.php');
include_once ('./../class/Item.php');
include_once ('./../class/Error.php');
include_once ('DBEngine.php');

static class ItemAction {
	public static function MakeItem($name, $date, $debtlist, $paylist) {
		if (strlen($name) < 5)
			return new Error('201', '');
		
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery(); // TODO: Make Query for insert item
		if ($result === false) return new Error('101', 'DB select fail');
		
		$result = $dEngine->RunQuery(); // TODO: Make Query for get last item
		if ($result === false) return new Error('101', 'DB select fail');
		
		$pid = $result[0]['pid'];
		$statuslist = array();
		foreach ($debtlist as $key => $value) {
			$result = $dEngine->RunQuery(); // TODO: Make Query for insert itemdebt
			if ($result === false) return new Error('101', 'DB select fail');
			
			if (array_key_exists($key, $statuslist) === false)
				array_push($statuslist, $key);
		}
		
		foreach ($debtlist as $key => $value) {
			$result = $dEngine->RunQuery(); // TODO: Make Query for insert itempay
			if ($result === false) return new Error('101', 'DB select fail');
			
			if (array_key_exists($key, $statuslist) === false)
				array_push($statuslist, $key);
		}

		foreach ($statuslist as $person) {
			$result = $dEngine->RunQuery(); // TODO: Make Query for insert itemstatus
			if ($result === false) return new Error('101', 'DB select fail');
		}
		
		return true;
	}

	public static function GetItem($pid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery(); // TODO: Make Query for item
		if ($result === false) return new Error('101', 'DB select fail');
		
		if (count($result) == 0) return new Error('203', 'User id '.$uid.' does not exist');
		$itemdata = $result[0];
		
		$debtlist = array();
		$result = $dEngine->RunQuery(); // TODO: Make Query for debtlist
		if ($result === false) return new Error('101', 'DB select fail');
		foreach ($result as $row)
			array_push($row['uid'] => $row['money'], $debtlist);
		
		$paylist = array();
		$result = $dEngine->RunQuery(); // TODO: Make Query for paylist
		if ($result === false) return new Error('101', 'DB select fail');
		foreach ($result as $row)
			array_push($row['uid'] => $row['money'], $paylist);
		
		$statuslist = array();
		$result = $dEngine->RunQuery(); // TODO: Make Query for statuslist
		if ($result === false) return new Error('101', 'DB select fail');
		foreach ($result as $row)
			array_push($row['uid'] => $row['status'], $statuslist);
		
		return new Item($itemdata['pid'], $itemdata['name'], $itemdata['date'], $debtlist, $paylist, $statuslist);
	}
	
	public static function GetItemList($uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery(); // TODO: Make Query for get item list
		if ($result === false) return new Error('101', 'DB select fail');
		
		$itemlist = array();
		foreach ($result as $row) {
			$item = GetItem($row['pid']);
			if (array_key_exists($uid, $item->statuslist))
				array_push($item, $itemlist);
		}
		return $itemlist;
	}
	
	public static function AcceptItem($pid, $uid) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery(); // TODO: Make Query for acceptitem
		if ($result === false) return new Error('101', 'DB select fail');

		return true;
	}
}

?>
<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once ('class_user.php');
include_once ('class_item.php');
include_once ('class_dbengine.php');

class CalcAction {	
	private static function CompareMoney($a, $b) {
		if ($a['money'] == $b['money']) return 0;
		return ($a['money'] < $b['money'] ? -1 : 1);
	}
	
	private static function GetZeroArray($n) {
		$raw = array();
		for ($i = 1; $i <= $n; $i += 1) {
			$tmp = array();
			for ($j = 1; $j <= $n; $j += 1)
				$tmp[$j] = 0;
			$raw[$i] = $tmp;
		}
		return $raw;
	}
	
	private static function AddArray($a, $b, $n) {
		$result = CalcAction::GetZeroArray($n);
		for ($i = 1; $i <= $n; $i += 1)
			for ($j = 1; $j <= $n; $j += 1)
				$result[$i][$j] = $a[$i][$j] + $b[$i][$j];
		return $result;
	}
	
	private static function GetRawData($itemlist, $n) {
		$raw = CalcAction::GetZeroArray($n);
		for ($i = 0; $i < count($itemlist); $i += 1) {
			$net = array();
			$debtlist = $itemlist[$i]->GetDebtList();
			$paylist = $itemlist[$i]->GetPayList();
			for ($j = 1; $j <= $n; $j += 1) {
				if (isset($debtlist[$j])) {
					if (isset($paylist[$j]))
						$net[$j] = $debtlist[$j] - $paylist[$j];
					else
						$net[$j] = $debtlist[$j];
				}
				else {
					if (isset($paylist[$j]))
						$net[$j] = -$paylist[$j];
					else
						$net[$j] = 0;
				}
			}
			$result = CalcAction::CalcKMinChul($net, $n);
			$raw = CalcAction::AddArray($raw, $result, $n);
		}
		return $raw;
	}
	
	private static function CalcKMinChul($net, $n) {
		$ans = CalcAction::GetZeroArray($n);
		$rawlist = array();
		for ($i = 1; $i <= $n; $i += 1)
			$rawlist[] = array('id' => $i, 'money' => $net[$i]);
		
		usort($rawlist, array('CalcAction', 'CompareMoney'));
		$list = array();
		for ($i = 0; $i < $n; $i += 1)
			$list[$i + 1] = $rawlist[$i];
			
		$start = 1;
		$end = $n;
		while ($start < $end) {
			if ($list[$start]['money'] + $list[$end]['money'] >= 0) {
				$ans[$list[$end]['id']][$list[$start]['id']] = -$list[$start]['money'];
				$ans[$list[$start]['id']][$list[$end]['id']] = $list[$start]['money'];
				$list[$end]['money'] += $list[$start]['money'];
				$list[$start]['money'] = 0;
				$start += 1;
			}
			else {
				$ans[$list[$end]['id']][$list[$start]['id']] = $list[$end]['money'];
				$ans[$list[$start]['id']][$list[$end]['id']] = -$list[$end]['money'];
				$list[$start]['money'] += $list[$end]['money'];
				$list[$end]['money'] = 0;
				$end -= 1;
			}
		}
		return $ans;
	}
	
	private static function WriteData($ans, $n) {
		$dEngine = new DBEngine();
		$result = $dEngine->RunQuery("TRUNCATE userstatus");
		if ($result === false) return false;
		
		for ($i = 1; $i <= $n; $i += 1) {
			for ($j = 1; $j <= $n; $j += 1) {
				$result = $dEngine->RunQuery("INSERT INTO userstatus (uid, touid, money) VALUES (".$i.", ".$j.", ".$ans[$i][$j].")");
				if ($result === false) return false;
			}
		}
		return true;
	}
	
	public static function UpdateStatus($itemlist, $n) {
		$raw = CalcAction::GetRawData($itemlist, $n); 
		$net = array();
		
		for ($i = 1; $i <= $n; $i += 1) {
			$sum = 0;
			for ($j = 1; $j <= $n; $j += 1)
				$sum += $raw[$i][$j];
			$net[$i] = $sum;
		}
		$ans = CalcAction::CalcKMinChul($net, $n);
		return CalcAction::WriteData($ans, $n);
	}
}

?>
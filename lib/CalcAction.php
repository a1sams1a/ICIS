<?php

if (!defined('__ICIS__'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once ('./../class/User.php');
include_once ('./../class/Item.php');
include_once ('DBEngine.php');

class CalcAction {
	private $chart;
	
	private static function ReadArrayFile() {
		$chart = array();
		$fp = fopen('data/data.txt', 'r');
		if ($fp === false) return false;
		
		while(!feof($fp)){
			$oneline = trim(fgets($fp));
			$chart[] = explode(' ', $oneline);
		}
		fclose($fp);
		return true;
	}
	
	private static function WriteArrayFile() {
		$fp = fopen('data/data.txt', 'w');
		
		if ($fp === false) return false;
		foreach ($chart as $row)
			fwrite($fp, implode(' ', $row)."\n");
			
		fclose($fp);
		return true;
	}
		
	private static function CompareMoney($a, $b) {
		return ($a['money'] < $b['money'] ? -1 : 1);
	}
	
	private static function UpdateGraph($p, $q, $amount) {
		if ($p > $q) {
			$t = $p; $p = $q; $q = $t;
			$amount *= -1;
		}
		if (($chart[$p][$q] + $amount) * $chart[$p][$q] > 0 || $chart[$p][$q] * $amount == 0) {
			$chart[$p][$q] += $amount;
			return;
		}
		$chart[$p][$q] += $amount;
		
		if ($chart[$p][$q] > 0) {
		
		
		}
	}
	
	public static function UpdateStatus($item, $n) {
		$result = CalcAction::ReadArrayFile();
		if ($result === false) return false;
		
		$list = array();
		$statuslist = $item->GetStatusList();
		$debtlist = $item->GetDebtList();
		$paylist = $item->GetPayList();
		for ($i = 0; $i < $n; $i += 1) {
			$pay = (array_key_exists($key, $paylist) ? $paylist[$key] : 0);
			$debt = (array_key_exists($key, $debtlist) ? $debtlist[$key] : 0);
			$list[$i] = array('index' => $i, 'money' => $pay - $debt);
		}

		usort($list, 'CompareMoney');
		
		$payer = 0;
		$receiver = $n - 1;
		
		while ($payer < $receiver) {
			if ($list[$payer]['money'] + $list[$receiver]['money'] >= 0) {
				UpdateGraph($list[$payer]['index'], $list[$receiver]['index'], $list[$receiver]['money']);
				$list[$payer]['money'] += $list[$receiver]['money'];
				$list[$receiver]['money'] = 0;
				$receiver -= 1;
			}
			else {
				UpdateGraph($list[$payer]['index'], $list[$receiver]['index'], $list[$payer]['money']);
				$list[$receiver]['money'] += $list[$payer]['money'];
				$list[$payer]['money'] = 0;
				$payer += 1;
			}
		}
		
		$result = CalcAction::WriteArrayFile();
		if ($result === false) return false;
		return true;
	}
}

?>
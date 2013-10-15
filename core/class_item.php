<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

class Item {
	private $pid;
	private $name;
	private $pdate;
	private $debtList;
	private $payList;
	private $statusList;
	
	public function __construct($pid, $name, $pdate, $debtList, $payList, $statusList) {
		$this->pid = $pid;
		$this->name = $name;
		$this->pdate = $pdate;
		$this->debtList = $debtList;
		$this->payList = $payList;
		$this->statusList = $statusList;
	}
	
	public function GetPid() {
		return $this->pid;
	}
	
	public function GetName() {
		return $this->name;
	}
	
	public function GetDate() {
		return $this->pdate;
	}
	
	public function GetDebtList() {
		return $this->debtList;
	}
	
	public function GetPayList() {
		return $this->payList;
	}
	
	public function GetStatusList() {
		return $this->statusList;
	}
	
	public function ToString() {
		$debtstr = Item::listToStr($this->debtList);
		$paystr = Item::listToStr($this->payList);
		$statusstr = Item::listToStr($this->statusList);
		return implode('@', array('#ICIS#', 'ITEM', $this->pid, $this->name, $this->pdate, $debtstr, $paystr, $statusstr));
	}
	
	private static function listToStr($list) {
		$str = '';
		foreach ($list as $key => $value)
			$str .= $key.':'.$value.',';
		return substr($str, 0, -1);
	}
}

?>
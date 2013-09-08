<?php

if (!defined('__ICIS__'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

class User {
	private $uid;
	private $id;
	private $name;
	private $pw;
	
	public function __construct($uid, $id, $name, $pw) {
		$this->uid = $uid;
		$this->id = $id;
		$this->name = $name;
		$this->pw = $pw;
		$this->paylist = $paylist;
	}
	
	public function GetUid() {
		return $this->uid;
	}
	
	public function GetId() {
		return $this->id;
	}
	
	public function GetName() {
		return $this->name;
	}
	
	public function GetPw() {
		return $this->pw;
	}
	
	public function ToString() {
		return implode('@', array('#ICIS#', 'USER', $this->uid, $this->id, $this->name));
	}
} 

?>
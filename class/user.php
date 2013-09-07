<?php

class User {
	private $uid;
	private $name;
	private $pw;
	
	public function __construct($uid, $name, $pw) {
		$this->uid = $uid;
		$this->name = $name;
		$this->pw = $pw;
		$this->paylist = $paylist;
	}
	
	public function GetUid() {
		return $this->uid;
	}
	
	public function GetName() {
		return $this->name;
	}
	
	public function GetPw() {
		return $this->pw;
	}
	
	public function SetPw($pw) {
		$this->pw = $pw;
	}
	
	public function __toString() {
		return implode('@', array('#ICIS#', 'USER', $this->uid, $this->name));
	}
} 

?>
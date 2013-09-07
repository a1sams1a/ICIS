<?php

class user {
	private $uid;
	private $name;
	private $pw;
	
	public function __construct($uid, $name, $pw) {
		$this->uid = $uid;
		$this->name = $name;
		$this->pw = $pw;
		$this->paylist = $paylist;
	}
	
	public function getuid() {
		return $this->uid;
	}
	
	public function getname() {
		return $this->name;
	}
	
	public function getpw() {
		return $this->pw;
	}
	
	public function setpw($pw) {
		$this->pw = $pw;
	}
	
	public function __toString() {
		//TODO
	}
} 

?>
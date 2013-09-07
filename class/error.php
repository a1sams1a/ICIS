<?php

class Error {
	private $code;
	private $reason;
	
	public function __construct($code, $reason) {
		$this->code = $code;
		$this->reason = $reason;
	}
	
	public function GetCode() {
		return $this->code;
	}
	
	public function GetReason() {
		return $this->reason;
	}
	
	public function __toString() {
		return implode('@', array('#ICIS#', 'ERROR', $this->code, $this->reason));
	}
}

?>
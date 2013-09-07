<?php

class error {
	private $code;
	private $reason;
	
	public function __construct($code, $reason) {
		$this->code = $code;
		$this->reason = $reason;
	}
}

?>
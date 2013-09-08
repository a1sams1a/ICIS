<?php

if (!defined('__ICIS__'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once('Secure.php');

class DBEngine {
	public function RunQuery($query) {
		$mysqli = new mysqli('localhost', 'a1sams1a', Secure::GetDBPassword(), 'a1sams1a');
		if ($mysqli->connect_errno)
			return false;
		
		$success = false;
		$result = array();
		$type = 'unknown';
		
		if (strpos($query, 'SELECT') !== false)
			$type = 'return';
		elseif (strpos($query, 'INSERT') !== false || strpos($query, 'UPDATE') !== false)
			$type = 'no-return';
		
		if ($type == 'return') {
			if ($dresult = $mysqli->query($query)) {
				$success = true;
				while($row = $dresult->fetch_array(MYSQLI_ASSOC))
					$result[] = $row;
				$dresult->free();
			}
		}
		elseif ($type == 'no-return') {
			if ($mysqli->query($query) === true) {
				$success = true;
				$result = 'success';
			}
		}
		
		$mysqli->close();
		if ($success === false) return false;
		return $result;
	}
}

?>
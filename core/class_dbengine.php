<?php

if (!defined('ICIS'))
	die('#ICIS#@ERROR@111@NO_DIRECT_RUN');

include_once('class_secure.php');

class DBEngine {
	public function RunQuery($query) {
		$mysqli = new mysqli('localhost', 'usricis', Secure::GetDBPassword(), 'icis');
		if ($mysqli->connect_errno)
			return false;
		
		$success = false;
		$result = array();
		$type = 'unknown';
		
		if (strpos($query, 'SELECT') !== false)
			$type = 'return';
		elseif (strpos($query, 'INSERT') !== false || strpos($query, 'UPDATE') !== false || strpos($query, 'TRUNCATE') !== false)
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
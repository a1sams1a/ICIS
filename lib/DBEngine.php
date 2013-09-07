<?php

class DBEngine {
	public function RunQuery($query) {
		$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
		if ($mysqli->connect_errno)
			return false;
		
		$success = false;
		$result = array();
		$type = 'unknown';
		
		if (strpos($query, 'SELECT') !== false)
			$type = 'return';
		else if (strpos($query, 'INSERT') !== false || strpos($query, 'UPDATE') !== false)
			$type = 'no-return';
		
		if ($type == 'return') {
			if ($dresult = $mysqli->query($query)) {
				$success = true;
				while($row = $dresult->fetch_array(MYSQLI_ASSOC)){
					array_push($result, $row);
				$dresult->free();
			}
		}
		else if ($type == 'no-return') {
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
<?php

include_once('./../class/Error.php');

class DBEngine {
	public function RunQuery($query, $type) {
		$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
		if ($mysqli->connect_errno)
			return new Error('100', 'DB connection fail: '.$mysqli->connect_error);

		if ($result = $mysqli->query("SELECT Name FROM City LIMIT 10")) {
			printf("Select returned %d rows.\n", $result->num_rows);

			/* free result set */
			$result->close();
}

/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
if ($result = $mysqli->query("SELECT * FROM City", MYSQLI_USE_RESULT)) {

    /* Note, that we can't execute any functions which interact with the
       server until result set was closed. All calls will return an
       'out of sync' error */
    if (!$mysqli->query("SET @a:='this will not work'")) {
        printf("Error: %s\n", $mysqli->error);
    }
    $result->close();
}

$mysqli->close();
}
}

}
<?php
if (isset($_COOKIE['uid']) || isset($_COOKIE['key'])) {
	setcookie('uid', '', time() - 3600, '/icis');
	setcookie('key', '', time() - 3600, '/icis');
}

echo '<meta http-equiv="refresh" content="0;url=./">';
?>
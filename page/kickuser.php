<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');

if ($_COOKIE['uid'] != '1') {
	echo '<meta http-equiv="refresh" content="0;url=?action=error">';
	exit();
}

if (isset($_POST['kick'])) {
	$result = WebLibrary::KickUser();
	if ($result !== false)
		echo '<meta http-equiv="refresh" content="0;url=?action=success">';
	else
		echo '<meta http-equiv="refresh" content="0;url=?action=error">';
	exit();
}

?>

<div class="well">
	<h3 class="text-center">ICIS - 강제 로그아웃</h3>
	<form class="form-horizontal" role="form" action="?action=kickuser" method="post">
		<input type="hidden" class="form-control" name="kick" value="1">
		<button type="submit" class="btn btn-danger btn-lg">Kick</button>
	</form>
</div>
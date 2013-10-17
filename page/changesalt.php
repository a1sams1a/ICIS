<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');
	
if (isset($_POST['change'])) {
	$result = WebLibrary::ChangeSalt($_COOKIE['uid']);
	if ($result !== false)
		echo '<meta http-equiv="refresh" content="0;url=index.php">';
	else
		echo '<meta http-equiv="refresh" content="0;url=?action=error">';
	exit();
}

?>

<div class="well">
	<h3 class="text-center">ICIS - Salt 변경</h3>
	<form class="form-horizontal" role="form" action="?action=changesalt" method="post">
		<p class="text-danger">이 명령은 Salt를 즉시 변경시켜 즉시 로그아웃할 수 있습니다. 이는 단순히 쿠키를 삭제하는 상단 메뉴의 로그아웃보다 더 안전하게 로그아웃할 수 있습니다.</p>
		<input type="hidden" class="form-control" name="change" value="1">
		<button type="submit" class="btn btn-danger btn-lg">Salt 즉시 변경</button>
	</form>
</div>
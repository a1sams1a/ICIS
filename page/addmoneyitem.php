<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');
	
if (isset($_POST['money']) && isset($_POST['payto'])) {
	$result = WebLibrary::GiveMoney($_COOKIE['uid'], $_POST['payto'], date('Y-m-d'), $_POST['money']);
	if ($result === true)
		echo '<meta http-equiv="refresh" content="0;url=?action=success">';
	else
		echo '<meta http-equiv="refresh" content="0;url=?action=error">';
	exit();
}
?>

<div class="well">
	<h3 class="text-center">ICIS - 채무 이행</h3>
	<form class="form-horizontal" role="form" action="?action=addmoneyitem" method="post">
		<div class="form-group">
			<label for="inputMoney" class="col-sm-1 control-label">금액</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" pattern="[0-9]*" name="money">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPayTo" class="col-sm-1 control-label">대상</label>
			<div class="col-sm-10">
				<select class="form-control" name="payto">
					<?php echo WebLibrary::MakeUserSelect($_COOKIE['uid']); ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-1 col-sm-10">
				<button type="submit" class="btn btn-default">추가</button> <button type="reset" class="btn btn-danger">초기화</button>
			</div>
		</div>
	</form>
</div>
<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');
	
if (isset($_POST['name']) && isset($_POST['date']) && isset($_POST['debt']) && isset($_POST['pay'])) {
	$result = WebLibrary::AddItem($_POST['name'], $_POST['date'], $_POST['debt'], $_POST['pay']);
	if ($result === true)
		echo '<meta http-equiv="refresh" content="0;url=?action=success">';
	else
		echo '<meta http-equiv="refresh" content="0;url=?action=error">';
	exit();
}
?>

<div class="well">
	<h3 class="text-center">ICIS - 항목 추가</h3>
	<form class="form-horizontal" role="form" action="?action=additem" method="post">
		<div class="form-group">
			<label for="inputDate" class="col-sm-1 control-label">날짜</label>
			<div class="col-sm-10">
				<input type="date" class="form-control" name="date">
			</div>
		</div>
		<div class="form-group">
			<label for="inputName" class="col-sm-1 control-label">설명</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="name" maxlength="40">
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>이름</th>
						<th>먹은 돈</th>
						<th>지불한 돈</th>
					</tr>
				</thead>
				<tbody>
					<?php echo WebLibrary::MakeAddItemTable(); ?>
				</tbody>
			</table>
		</div>
		<div class="form-group">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-default">추가</button> <button type="reset" class="btn btn-danger">초기화</button>
			</div>
		</div>
	</form>
</div>
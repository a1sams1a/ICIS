<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');

$moneystatus = WebLibrary::UserStatus($_COOKIE['uid']);
$debtmoneystr = '';
$paymoneystr = '';
foreach ($moneystatus as $key => $value) {
	if ($value < 0)
		$paymoneystr .= $key.'에게 '.-$value.'원, ';
	elseif ($value > 0)
		$debtmoneystr .= $key.'에게 '.$value.'원, ';
}
if ($paymoneystr == '')
	$paymoneystr = '돈 뜯을 사람 없음';
else
	$paymoneystr = substr($paymoneystr, 0, -2).' 뜯어';

if ($debtmoneystr == '')
	$debtmoneystr = '돈 줄 사람 없음';
else
	$debtmoneystr = substr($debtmoneystr, 0, -2).' 줘';
?>

<div class="well">
	<h3 class="text-center">ICIS - <?php echo WebLibrary::GetName($_COOKIE['uid']); ?>님, 환영합니다.</h3>
	<div class="row">
		<div class="col-sm-6">
			<h4 class="text-danger text-center"><?php echo $debtmoneystr; ?></h4>
		</div>
		<div class="col-sm-6">
			<h4 class="text-info text-center"><?php echo $paymoneystr; ?></h4>
		</div>
	</div>
	<h4 class="text-center">현재 상황(최근 30개만 보여짐)</h4>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>날짜</th>
					<th>설명</th>
					<th>먹은 사람</th>
					<th>돈낸 사람</th>
					<th>승인</th>
					<th>상태</th>
				</tr>
			</thead>
			<tbody>
				<?php echo WebLibrary::MakeItemList($_COOKIE['uid'], true, false); ?>
			</tbody>
		</table>
	</div>
</div>
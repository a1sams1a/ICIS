<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');
?>

<div class="well">
	<h3 class="text-center">ICIS - 전체 목록</h3>
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
				<?php echo WebLibrary::MakeItemList($_COOKIE['uid'], false, false); ?>
			</tbody>
		</table>
	</div>
</div>
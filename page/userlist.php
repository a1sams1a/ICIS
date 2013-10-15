<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');
?>

<div class="well">
	<h3 class="text-center">ICIS - 전체 사용자 목록</h3>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>UID</th>
					<th>아이디</th>
					<th>이름</th>
				</tr>
			</thead>
			<tbody>
				<?php echo WebLibrary::MakeUserList(); ?>
			</tbody>
		</table>
	</div>
</div>

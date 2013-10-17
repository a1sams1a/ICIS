<?php
define('ICIS', '0.2');
include_once('core/library_common.php');
include_once('core/library_web.php');

if (false) {
	include('page/working.php');
	exit();
}

$banner = '';

if (isset($_COOKIE['uid']) && isset($_COOKIE['key'])) {
	if (Library::Validate($_COOKIE['uid'], $_COOKIE['key']) !== false) {
		echo '<meta http-equiv="refresh" content="0;url=./">';
		exit();
	}
	else
		$banner = '<div class="alert alert-danger">  
			<strong>로그아웃됨!</strong> Salt 변경 또는 관리자에 의해 강제 로그아웃되었습니다.
		</div>';
}

if (isset($_POST['id']) && isset($_POST['pw'])) {
	$result = WebLibrary::Login($_POST['id'], hash('sha512', $_POST['pw']));
	if ($result !== false) {
		setcookie('uid', $result[0], time() + 60 * 3600, '/icis');
		setcookie('key', $result[1], time() + 60 * 3600, '/icis');
		echo '<meta http-equiv="refresh" content="0;url=./">';
		exit();
	}
	else
		$banner = '<div class="alert alert-danger">  
			<strong>오류!</strong> 로그인 정보가 잘못되어 있습니다.
		</div>';
}
?>

<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="ICIS - Calculate your balance!">
		<meta name="author" content="Project ICIS Team">

		<title>Project ICIS Login</title>

		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/custom.css" rel="stylesheet" media="screen">
	</head>

	<body id="login-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2" id="login-form">
					<?php echo $banner; ?>
					<form class="form-horizontal well" id="login" action="" method="post">
						<legend>ICIS 로그인</legend>
						<br/>
						<div class="form-group">
							<label for="inputID" class="col-xs-2 control-label">ID</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputID" name="id" placeholder="ID" pattern=".{3,}" required="required"/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPW" class="col-xs-2 control-label">PW</label>
							<div class="col-xs-9">
								<input type="password" class="form-control" id="inputPW" name="pw" placeholder="Password" pattern=".{8,}" required="required"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-9 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">로그인</button>
								<a class="btn btn-warning" href="register.php">회원가입</a>
								<a class="btn btn-default" href="javascript:history.go(-1)">뒤로 가기</a>
							</div>
						</div>
						<p class="text-center"><span class="glyphicon glyphicon-ok-circle"></span> 로그인하려면 쿠키를 사용할 수 있어야 합니다.</p>
						<hr/>
						<footer>
							<p>Copyright © Project ICIS Team <?php echo date('Y'); ?>. Version 0.2.0 Alpha(2013-10-15)</p>
						</footer>
					</form>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>
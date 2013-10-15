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
			<strong>해킹 시도 확인!</strong> 쿠키에 잘못된 값이 포함되어 있습니다.
		</div>';
}

if (isset($_POST['id']) && isset($_POST['pw']) && isset($_POST['pw2']) && isset($_POST['name']) && isset($_POST['code'])) {
	if ($_POST['code'] != 'INV-CODE')
		$banner = '<div class="alert alert-danger">  
			<strong>오류!</strong> Verification Code가 다릅니다.
		</div>';
	elseif ($_POST['pw'] != $_POST['pw2'])
		$banner = '<div class="alert alert-danger">  
			<strong>오류!</strong> 비밀번호를 다시 입력하십시오.
		</div>';
	else {
		$result = WebLibrary::Register($_POST['id'], $_POST['name'], $_POST['pw']);
		if ($result !== false) {
			echo '<script type="text/javascript">alert("회원가입이 완료되었습니다. 로그인하십시오."); </script>';
			echo '<meta http-equiv="refresh" content="0;url=./login.php">';
			exit();
		}
		else
			$banner = '<div class="alert alert-danger">  
				<strong>오류!</strong> 금지 문자열이 포함되어 있거나 아이디가 중복됩니다.		
			</div>';
	}		
}
?>

<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="ICIS - Calculate your balance!">
		<meta name="author" content="Project ICIS Team">

		<title>Project ICIS Register</title>

		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/custom.css" rel="stylesheet" media="screen">
	</head>

	<body id="register-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2" id="register-form">
					<?php echo $banner; ?>
					<form class="form-horizontal well" id="register" action="" method="post">
						<legend>ICIS 회원가입</legend>
						<br/>
						<div class="form-group">
							<label for="inputID" class="col-xs-2 control-label">ID</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputID" name="id" placeholder="ID" pattern=".{4,15}" required="required" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputName" class="col-xs-2 control-label">Name</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputName" name="name" placeholder="Name" pattern=".{2,8}" required="required" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPW" class="col-xs-2 control-label">PW</label>
							<div class="col-xs-9">
								<input type="password" class="form-control" id="inputPW" name="pw" placeholder="Password" pattern=".{8,}" required="required"/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPW2" class="col-xs-2 control-label"></label>
							<div class="col-xs-9">
								<input type="password" class="form-control" id="inputPW2" name="pw2" placeholder="Password(Again)" pattern=".{8,}" required="required"/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPW" class="col-xs-2 control-label">VCode</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputVCode" name="code" placeholder="Verification Code" required="required"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-9 col-sm-offset-2">
								<button type="submit" class="btn btn-warning">회원가입</button>
								<a class="btn btn-default" href="javascript:history.go(-1)">뒤로 가기</a>
							</div>
						</div>
						<p class="text-center"><span class="glyphicon glyphicon-ok-circle"></span> 로그인하려면 쿠키를 사용할 수 있어야 합니다.</p>
						<hr/>
						<footer>
							<p>Copyright ⓒ Project ICIS Team <?php echo date('Y'); ?>. Version 0.2.0 Alpha(2013-10-15)</p>
						</footer>
					</form>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>
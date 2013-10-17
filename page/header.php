<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');
?>

<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="ICIS - Calculate your balance!">
		<meta name="author" content="Project ICIS Team">

		<title>Project ICIS</title>

		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/custom.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<header class="umm-header">
			<nav class="navbar navbar-default navbar-fixed-top umm-navbar" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">네비게이션 활성화</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="./">Project ICIS</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li>
								<a href="?action=main">Home</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Action<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="?action=additem">항목 추가</a>
										<a href="?action=addmoneyitem">채무 이행</a>
										<a href="?action=requestitemlist">승인 대기 목록</a>
										<a href="?action=itemlist">전체 항목 보기</a>
										<a href="?action=userlist">사용자 목록 보기</a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="?action=changepassword">비밀번호 변경</a>
										<a href="?action=changesalt">Salt 변경</a>
										<a href="?action=kickuser">강제 로그아웃</a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">About<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="?action=about">ICIS</a>
										<a href="?action=aboutteam">ICIS Team</a>
									</li>
								</ul>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="logout.php" data-toggle="tooltip" title="자격 증명을 해제합니다.">Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div class="container">
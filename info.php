<?php
define('ICIS', '0.2');

if (false) {
	include('page/working.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="ICIS - Calculate your balance!">
		<meta name="author" content="Project ICIS Team">

		<title>Project ICIS - Information</title>

		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/custom.css" rel="stylesheet" media="screen">
	</head>

	<body id="info-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1" id="info-form">
					<div class="well">
						<h1 class="text-center">ICIS에 오신 것을 환영합니다!</h1>
						<h3>간략한 소개</h3>
						<p>안녕하세요, Sam입니다 ㅎㅎ 이 프로젝트는 허원영님의 제안으로 처음 시작되었으며, ICIS는 정확히 다음과 같은 일을 합니다.</p>
						<blockquote>N명의 사람들이 같이 시켜먹었을 때, 서로의 채무 관계를 자동으로 계산한다!</blockquote>
						<p>보통 여러명이 무엇인가(특히 치킨)을 시키게 되면, 그 자리에서 즉시 돈을 계산하는 경우도 있지만, 한 사람이 돈을 내고 나중에 받는 경우가 많습니다. 이것이 누적될 경우, 각자의 채무관계는 복잡해지고 돈을 받거나 줘야 하는 일을 까먹게 됩니다. ICIS는 입력만 하면 자동으로 계산해줍니다!!!</p>
						<h3 class="text-danger">주의사항!!</h3>
						<p>현재 이 프로젝트는 Alpha 버전이므로 서비스가 불안정하거나, 일시적으로 중지될 수 있습니다. 또한 시스템 설계 및 알고리즘 상의 문제로 여러 문제가 발생할 수 있으니 반드시 다음의 사항을 따라 주시기 바랍니다.</p>
						<ol>
							<li class="text-danger">반드시 11학번 HP 학생들만 사용하세요. KSA에 있는 친구들 가입 방법 알려주고 가입 시키지 마세요.</li>
							<li class="text-danger">절대 IE로 접속하지 마세요. 권장 웹 브라우저는 Chrome 26이상입니다.</li>
							<li class="text-danger">절대 타 사이트에서 사용하는 비밀번호 넣지 마세요. 보안 취약합니다. 절대 절대 절대 금지!!!!</li>
							<li class="text-danger">가급적 2~3일 전 입력 데이터는 기억해 주세요. 아마 그럴 일은 없겠지만 백업이 안되었는데 데이터가 날라가면... ㅈㅅ</li>
							<li class="text-danger">장난하지 마세요. 삭제나 취소 기능 없습니다.</li>
							<li>한 사람이 중복계정 만들고 그러지 마세요. 가급적 실명이나 아니면 적어도 알아볼 수 있도록 계정 만드세요.(ex: 조삼빵)</li>
							<li>트롤하지 마세요. 숫자 입력란에 강제로 문자를 입력한다거나, 거짓 데이터를 마구마구 넣는다거나, 계정을 마구마구 만든다거나, 먹은 돈의 합과 낸 돈의 합이 다른 데이터를 넣는 행동은 하지 말아주세요.</li>
						</ol>
						<p>위에 명시된 사항들을 어겼을 경우, 보이는 즉시 해당 계정 삭제하고 물리적인 힘(...??)을 주거나 다른 재밌는거(...??????)를 해 드릴 수 있으니 제발 트롤링 하지 마세요.</p>
						<h3 class="text-info">문제가 발생했을 때! + 기타 사항</h3>
						<p>지체없이 Sam에게 연락주시기 바랍니다. 금액을 잘못 입력했거나 잘못된 데이터를 승인하는 등 실수가 발생했을 때 연락하면 가능한 빨리 처리하도록 하겠습니다.</p>
						<p>프로젝트에 참여하고 싶거나, 개선시키고 싶다거나 아이디어가 있다면 Project ICIS Team에게 말해 주세요. 언제나 환영합니다.</p>
						<hr/>
						<footer>
							<p>Copyright ⓒ Project ICIS Team <?php echo date('Y'); ?>. Version 0.2.0 Alpha(2013-10-15)</p>
						</footer>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>
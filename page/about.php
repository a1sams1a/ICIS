<?php
if (!defined('ICIS'))
	die('Must be executed by index.php');
?>

<div class="well">
	<h3>ICIS - Calculate your balance!</h3>
	<p>ICIS는 여러 사람이 같이 무엇인가를 구매했을 때 각자가 얼마씩을 서로에게 주고 받아야 하는지 계산하는 프로그램입니다.</p>
	<br/>
	<p>사용법은 매우 간단하며, 다음과 같습니다.</p>
	<ol>
		<li>"Action - 항목 추가"에 들어가서 날짜, 이름과 각각 얼마씩을 사용/지불했는지 작성한다!</li>
		<li>메인 페이지나 "Action - 승인 대기 목록"에 들어가 해당 항목을 승인한다!</li>
		<li>해당 항목에 관계된(항목을 사용하거나 지불한 사람) 모두가 승인하면, 자동으로 계산된다!</li>
		<li>메인 페이지를 보고, 서로에게 돈을 주고 받는다!</li>
		<li>"Action - 채무 이행"에 들어가서 누구에게 얼마를 줬는지 등록하고, 서로 해당 항목을 승인한다!</li>
		<li>위 과정을 계속 반복한다!</li>
	</ol>
	<br/>
	<p>Version History</p>
	<ol>
		<li>2013-10-15: Release 0.2.0(Alpha 2) - Fully support all functions.</li>
		<li>2013-10-13: Release 0.1.7(Alpha 1.7) - Code Re-factoring.</li>
		<li>2013-10-12: Release 0.1.5(Alpha 1.5) - GUI(Web) Added.</li>
		<li>2013-10-08: Release 0.1.0(Alpha 1) - API support except status function.</li>
		<li>2013-09-07: First Started</li>
	</ol>
	<p class="text-danger">경고! 이 프로그램은 법적 증거로 채택되는데 제약이 있을 수 있으며, <a href="?action=aboutteam">ICIS Team</a>은 어떠한 법적 분쟁에 대해서 책임, 증언 등을 명시적으로 법률이 정하는 최대한으로 부인합니다.</p>
</div>
<?php
  
	session_start();
  if(empty($_SESSION["user_id"])){
  	header("Location:../login/login.php");
  }
  
?>

<!DOCTYPE html>
<html>
 <head>	
  <meta charset="utf-8">
  <title>予定登録ページ</title>
   <link href="friend_plan.css" rel="stylesheet" type="text/css">
 </head>
<body>
  <div id="info">
				<ul id="menu">
					<li class="menu01"><a href="../mypage/mypage.php">トップページ</a></li>
					<li class="menu02"><a href="planplus.php">予定登録</a></li>
					<li class="menu03"><a href="plandelete.php">予定削除</a></li>
					<li class="menu04"><a href="../friend/friendplus.php">友達登録</a></li>
					<li class="menu05"><a href="../friend/friendlist.php">友達一覧</a></li>
					<li class="menu06"><a href="../mypage/eventlist.php">イベント一覧</a></li>
				</ul>
			</div>
  <div id="main_title">予定追加</div>
  <div id="main">
  <h2>予定の内容を入力してください</h2>
  <form action="plansuccess.php" method="get">
    日付 <br>
    <input type="text" name="date" placeholder="例 ２０１４年１月１日→20140101" size="30"><br><br>
    開始時刻<br>
    <input type="text" name="time_start" placeholder="例 午後１０時３０分→22.5" size="30"><br><br>
    終了時刻<br>
    <input type="text" name="time_end" placeholder="例 午後１１時３０分→23.5" size="30"><br><br>
    どこで<br>
    <input type="text" name="place" placeholder="場所名" size="30"><br><br>
    誰と<br>
    <input type="text" name="person" placeholder="一人の場合は「一人」" size="30"><br><br>
    内容<br>
    <textarea name="plan" rows="10" cols="40" placeholder="なるべく短く簡単に"></textarea><br><br>
    重要度<br>
    <input type="text" name="rank" placeholder="1(低)から5(高)" size="30"><br><br>
    <br>
    ※すべての項目を入力してください。<br>
    <input type="submit" value="登録">
  </form>
  </div>
</body>
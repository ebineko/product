<?php
  session_start();
  
  if(empty($_SESSION["user_id"])){
  	header("Location:../login/login.php");
  }
  $user_id=$_SESSION["user_id"];
  date_default_timezone_set("Asia/Tokyo");
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }
  if (isset($_GET["date"]) && isset($_GET["time_start"]) && isset($_GET["time_end"]) && isset($_GET["place"]) && isset($_GET["person"]) && isset($_GET["plan"]) && isset($_GET["rank"])) {
    
    if(isset($_GET['id'])) $id=$_GET['id'];
    $date = $_GET["date"];
    $time_start = $_GET["time_start"];
    $time_end = $_GET["time_end"];
    $place = $_GET["place"];
    $person = $_GET["person"];
    $plan = $_GET["plan"];
    $rank = $_GET["rank"];
    
    $pdo = new PDO("sqlite:../lib/friendiary.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $st=$pdo->prepare("INSERT INTO schedule(date, user_id, time_start, time_end, place, person, plan, rank) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $st->execute(array( $date, $user_id, $time_start, $time_end, $place, $person, $plan, $rank));
    $result = "登録しました。";
    $result_title="登録完了";
  }
  else {
    $result = "予定の内容がありません。";
    $result_title="登録失敗";
  }
?>
<!DOCTYPE html>
<html>
<head>	
  <meta charset="utf-8">
  <title>登録完了</title>
<link href="friend.css" rel="stylesheet" type="text/css">
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
   <div id="main_title">
     <?php echo $result_title; ?>
   </div>
   <div id="main">
  <div class="article">
    <h2><?php echo $result;?></h2><br/>
    　<a href="planplus.php">予定登録ページに戻る</a>
  </div>
   </div>
 </body>
</html>

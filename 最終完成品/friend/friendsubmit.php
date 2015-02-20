<?php
session_start();

if(empty($_SESSION["user_id"])){
  header("Location:../login/login.php");
  exit;
}

$user_id=$_SESSION["user_id"];

function h($str){return htmlspecialchars($str,ENT_QUOTES,"UTF-8");}
$pdo=new pdo("sqlite:../lib/friendiary.sqlite");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
$id=$_GET["id"];
$insert_s = $pdo->prepare("INSERT INTO $id(friend_id,accept) VALUES(?,?)");
$insert_s ->execute(array("$user_id",1)); 
$insert_a = $pdo->prepare("INSERT INTO $user_id(friend_id,accept) VALUES(?,?)");
$insert_a ->execute(array("$id",0));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>申請完了</title>
	<link href="friend.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="info">
        <ul id="menu">
      					<li class="menu01"><a href="../mypage/mypage.php">トップページ</a></li>
					<li class="menu02"><a href="../plus_delete/planplus.php">予定登録</a></li>
					<li class="menu03"><a href="../plus_delete/plandelete.php">予定削除</a></li>
					<li class="menu04"><a href="friendplus.php">友達登録</a></li>
					<li class="menu05"><a href="friendlist.php">友達一覧</a></li>
					<li calss="menu06"><a href="../mypage/eventlist.php">イベント一覧</a></li>
        </ul>
      </div>
	<div id="main_title">申請完了</div>
	<div id="main">
	<?php
		print $_GET["id"]."さんに友達申請しました<br>";
	?>
    <br><br><br>
    <center>	<a href="friendplus.php">戻る</a></center>
</div>
</body>
</html>
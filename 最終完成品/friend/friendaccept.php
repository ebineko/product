<?php
session_start();
if(empty($_SESSION["user_id"])){
  header("Location:../login/login.php");
  exit;
}
$user_id=$_SESSION["user_id"];
function h($str){return htmlspecialchars($str,ENT_QUOTES,"UTF-8");}
$pdo=new PDO("sqlite:../lib/friendiary.sqlite");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
$id=$_GET["id"];
$st_select=$pdo->query("SELECT * FROM $user_id WHERE friend_id = '$id'");
$st_update=$pdo->exec("UPDATE $user_id SET accept = 2 WHERE friend_id = '$id'");
$st_update2=$pdo->exec("UPDATE $id SET accept = 2 WHERE friend_id = '$user_id'");
$data=$st_select->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>認証完了</title>
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
	<div id="main_title">友達認証</div>
	<div id="main">
<?php
	foreach($data as $friend){
		print $friend["friend_id"]."さんを認証しました<br>";
	}
?>
    <br><br>
    <center><a href="friendplus.php">戻る</a></center>
</div>
</body>
</html>
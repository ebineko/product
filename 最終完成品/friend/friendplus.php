<?php

session_start();

if(empty($_SESSION["user_id"])){
  header("Location:../login/login.php");
  exit;
}

$user_id=$_SESSION["user_id"];

function h($str){return htmlspecialchars($str,ENT_QUOTES,"UTF-8");}
$pdo = new PDO("sqlite:../lib/friendiary.sqlite");
$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
$accept=$pdo->query("SELECT * FROM $user_id WHERE accept = 1");
$count=$pdo->query("SELECT COUNT(*) FROM $user_id WHERE accept = 1");
if(isset($_GET["id"])){
  $id = $_GET["id"];
  $exist=$pdo->query("SELECT *FROM user WHERE user_id = '$id'");
  $data_e=$exist->fetchAll(PDO::FETCH_ASSOC);
  $submit=$pdo->query("SELECT * FROM $user_id WHERE friend_id = '$id'");
  $data_s=$submit->fetchAll(PDO::FETCH_ASSOC);
  $name=$pdo->query("SELECT * FROM user WHERE user_id='$id'");
  $data_n=$name->fetchAll(PDO::FETCH_ASSOC);
}
$data_a=$accept->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>友達申請/承認</title>
  <link href="friend_2.css" rel="stylesheet" type="text/css">
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
 <div id="box1_title">
  id検索
</div>
<div id="box1">
  検索するidを入力してください<br>
  <form method="get" action="friendplus.php">
   <input type="text" name="id" placeholder="idを入力">
   <input type="submit" value="検索">
 </form>
 <br>
 <?php
 if(isset($_GET["id"])){
  if(empty($data_e)){
   print "指定されたユーザは存在しません。";
 }else {
  if(empty($data_s)){
    foreach($data_n as $name){
    print $name["name"];
    }
    ?>
    <br>
    <form method="get" action="friendsubmit.php">
      <?php
      print "<input type='hidden' name='id' value=".$_GET["id"].">";
      ?>
      <input type='submit' value='申請'>
    </form>
    <?php
  }else{
    foreach($data_s as $friend_submit){
    if($friend_submit["accept"]==0){
      print "指定されたユーザーは友達申請済みです";
    }else if($friend_submit["accept"]==1){
      print "指定されたユーザーから友達申請が届いています";
    }else if($friend_submit["accept"]==2){
      print "指定されたユーザーは友達認証済みです";
    }
  }
  }
 }
 }
?>
</div>

<div id="box2_title">
  承認待ち一覧
</div>
<div id="box2">
  <form method="get" action="friendsubmit.php">
    <?php
    if(empty($data_a)){
      print "申請はありません<br>"; 
    }else{
      print $count->fetchColumn()."件の友達申請が届いています<br>";
      foreach($data_a as $friend_accept){
        print "<a href='friendaccept.php?id=".h($friend_accept["friend_id"])."'>".h($friend_accept["friend_id"])."</a>";
        ?>
      <!--
      <input type="submit" name="yes" value="許可">
      <input type="submit" name="no" value="拒否">
      <input type="hidden" name="<?php  //print h($friend['id']) ?>">
    -->
    <br>
    <?php
  }
}
?>
</form>
</div>
</body>
</html>
<!doctype html>
<?php
session_start();
 $pdo =new PDO("sqlite:../lib/friendiary.sqlite");
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$id=$_GET["id2"];
$pass=$_GET["pass3"];
 $st=$pdo->query("SELECT * FROM user WHERE user_id = '$id' AND password = '$pass'");
 $data =$st->fetchAll(PDO::FETCH_ASSOC);
 if(empty($data)){
   $result_title="ログイン失敗";
 $result="ユーザーIDまたはパスワードが違います。";  
 }else{
   $result_title="ログイン成功";
   $result="ログイン完了しました";
   $_SESSION["user_id"]=$id;
 }
 ?>
<html>
 <head>
   <link href="friend.css" rel="stylesheet" type="text/css">
 <meta charset="UTF-8">
 <title>Friendiaryログイン完了ページ</title>
 </head>
 <body>
   <div id="main_title">
 <?php
if(empty($data)){
  print $result_title;
}else{
  print $result_title;
}
     ?> </div>
   <div id="main"> <?php
 print $result;
  if(empty($data)){
    print "<br> <a href='login.php'>ログインページへ</a>";
  }else{
  print "<br><a href='../mypage/mypage.php?'.$id.'>TOPページへ</a>";
   }
?> 
     </div>
</body>
</html>
 
 
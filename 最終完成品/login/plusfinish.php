<!doctype html>
<?php
 session_start();
 $id =$_GET['id'];
 $name =$_GET['name'];
 if($_GET["pass1"]==$_GET["pass2"]){
 $pass =$_GET['pass1'];
 $pdo =new PDO("sqlite:../lib/friendiary.sqlite");
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
   $st_false=$pdo->query("SELECT * FROM user WHERE user_id = '$id'");
   $false=$st_false->fetchAll(PDO::FETCH_ASSOC);
   if(empty($false)){
 $st =$pdo->prepare("INSERT INTO user(password,name,user_id) VALUES(?,?,?)");
 $st->execute(array($pass,$name,$id));
 $st_plus=$pdo->exec("CREATE TABLE '$id' (id integer PRIMARY KEY AUTOINCREMENT,friend_id text,friend_name text,accept integer);");
 $result="登録完了しました。";
   $result_title="登録完了";
   $_SESSION["user_id"]=$id;
     $flag=1;
   }else{
     $result="そのユーザーidはすでに使われています";
     $result_title="登録失敗";
     $flag=0;
   }
 }else{
 $result="パスワードが違います。";
   $result_title="登録失敗";
   $flag=0;
 }
?> 
<html>
 <head>
   <link href="friend.css" rel="stylesheet" type="text/css">
 <meta charset="UTF-8">
 <title>Friendiary登録完了ページ</title>
 </head>
 <body>
   <div id="main_title"><?php print $result_title; ?></div>
   <div id="main">
 <?php
 print $result;
 ?>
     <?php
if($flag==1){
  ?>
 <br><a href="../mypage/mypage.php?user_id='<?php print $id;?>'">TOPページへ</a>
     <?php
}else{
  ?>
     <br><a href="memberplus.php">戻る</a>
     <?php
}
?>
   </div>
 </body>
</html>
 
 
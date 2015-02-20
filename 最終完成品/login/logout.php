<?php
session_start();
$_SESSION=array();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ログアウト</title>
	<link href="friend.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main_title">
ログアウト
</div>
<div id="main">
  ログアウトしました。
  <br><br><br>
<center><a href="login.php">ログインページへ</a></center>
</div>
</body>
</html>
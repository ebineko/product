<!doctype html>
<html>
 <head>
 <meta charset="UTF-8">
 <title>Friendiary登録ページ</title>
 <link href="friend.css" rel="stylesheet" type="text/css">  
 </head>
 <body>
 <div id="main_title">Friendiary登録
 </div>  
 <form action="plusfinish.php" method="get">
 <div id="main">  
 ユーザーID：<br><input type="text" name="id" placeholder="IDを入力" value=""><br>
 ユーザー名：<br><input type="text" name="name" placeholder="名前を入力" value=""><br>
 パスワード：<br><input type="password" name="pass1" placeholder="パスワードを入力" value=""><br>
 パスワード：<br><input type="password" name="pass2" placeholder="パスワードを再入力" value=""><br><br>
 <input type=submit value="登録">
   <br><br>
   <a href="login.php">ログインページへ</a>
 </div>  
 </form>
 </body>
</html>
 
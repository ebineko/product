<?php
	session_start();
	if(empty($_SESSION["user_id"])){
  	header("Location:../login/login.php");
  	exit;
  }
?>
<html>
  <head>
    <meta charset='UTF-8'>
    <title>予定削除</title>
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
    <div id="main_title">予定削除</div>
    <div id="main">
    <table border=1 cellpadding=1 cellspacing=0>
		<tr bgcolor=black>
		<td width=50><br><font color=white>ID</font></td>
		<td width=80><br><font color=white>USER ID</font></td>
		<td width=80><br><b><font color=white>日付</font></b></td>
		<td width=80><br><b><font color=white>開始時刻</font></b></td>
		<td width=80><br><b><font color=white>終了時刻</font></b></td>
		<td width=80><br><b><font color=white>どこで</font></b></td>
		<td width=80><br><b><font color=white>誰と</font></b></td>
		<td width=100><br><b><font color=white>内容</font></b></td>
		<td width=80><br><b><font color=white>重要度</font></b></td>
		</tr>
    <?php
      
      
      $user_id=$_SESSION["user_id"];
      
      if(isset($_GET['id'])) $id=$_GET['id'];

      $db = new PDO("sqlite:../lib/friendiary.sqlite");

      if(isset($id))	{
	    $db->query("DELETE FROM schedule WHERE user_id='$user_id' AND id='$id'");
      }

      $result=$db->query("SELECT * FROM schedule where user_id='$user_id' order by date asc");
      mb_internal_encoding("UTF-8");
	  for($i = 0; $row=$result->fetch(); ++$i ){
		echo "<tr valign=center>";
		echo "<td >". $row['id']. "</td>";
		echo "<td >". $row['user_id']. "</td>";
		echo "<td >". $row['date']. "</td>";
		echo "<td >". $row['time_start']. "</td>";
		echo "<td >". $row['time_end']. "</td>";
		echo "<td >". $row['place']. "</td>";
		echo "<td >". $row['person']. "</td>";
		echo "<td >". $row['plan']. "</td>";
		echo "<td >". $row['rank']. "</td>";
		echo "</tr>";
	  }
    ?>
    
	</table>

	<h2>予定削除</h2>
	<form action=plandelete.php method=get>
	<table border=0 cellpadding=0 cellspacing=0>
	<tr><td>ID:</td><td><input type=text size=30 name=id placeholder="消したい予定のIDを半角数字で入力"></td> <td>   <input type=submit border=0 value="削除"></td></tr>
	</table>
	</form>
    </div>
  </body>
</html>
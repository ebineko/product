  <?php
  session_start();
if(empty($_SESSION["user_id"])){
  header("Location:../login/login.php");
  exit;
}
  $id = $_SESSION["user_id"];

  function h($str){return htmlspecialchars($str,ENT_QUOTES,"UTF-8");}
  $pdo=new pdo("sqlite:../lib/friendiary.sqlite");
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
  $st_f=$pdo->query("SELECT * FROM '$id' WHERE accept=2");
  if(isset($_GET["friend_database"]) || isset($_SESSION["friend_database"])){
    if(isset($_GET["friend_database"])){
      $_SESSION["friend_database"]=$_GET["friend_database"];
    }
    if(isset($_GET["day"])){
      $_SESSION["date"]=$_GET["year"]*10000+$_GET["mon"]*100+$_GET["day"];
      $_SESSION["year"]=$_GET["year"];
      $_SESSION["mon"]=$_GET["mon"];
      $_SESSION["day"]=$_GET["day"];
    }else if(isset($_GET["plus_mon"])||isset($_GET["minus_mon"])){
      
    }else{
     $_SESSION["date"]=20150101;
     $_SESSION["year"]=2015;
     $_SESSION["mon"]=1;
     $_SESSION["day"]=1;
   }
   $friend_database=$_SESSION["friend_database"];
   $st_s=$pdo->query("SELECT * FROM  schedule WHERE date =  ".$_SESSION["date"]." AND user_id = '$friend_database'");
   $data_s=$st_s->fetchAll(PDO::FETCH_ASSOC);
 }
 $data_f=$st_f->fetchAll(PDO::FETCH_ASSOC);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <title>友達一覧</title>
   <link href="friendlist.css" rel="stylesheet" type="text/css">
   <link href="timetable.packed.css" rel="stylesheet" type="text/css">
   <script type="text/javascript" src="timetable.packed.js"></script>
   <script src="../lib/jquery-2.1.1.min.js"></script>
 </head>
 <body onload="calender()">
   <div id="all_contents">
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
     <div id="calender_title">カレンダー</div>
     <div id="calender"></div>
   <div id="friend_list_title">友達一覧</div>
    <div id="friend_list">
    <?php
    foreach($data_f as $friend){
      print "<a href='friendlist.php?friend_database=".h($friend["friend_id"])."'>".h($friend["friend_id"])."</a><br>";
    }
    ?>
      </div>
   <br>
   <div id="friend_schedule_title">友達予定</div>
     <div id=friend_schedule>
   <div id="myschedule"></div>
   <?php
if(isset($friend_database)){
  print $_SESSION["year"]."年".$_SESSION["mon"]."月".$_SESSION["day"]."日".h($friend_database)."さんの予定";
}
    
   ?>
       
   <div id="yourschedule"></div>
  
  <?php
  if(isset($friend_database)){
   foreach($data_s as $schedule){
     ?>
     <script type="text/javascript">
       var timetable = new Timetable("yourschedule");
       timetable.addEvent("予定",<?php print h($schedule["time_start"]); ?>,<?php print h($schedule["time_end"]); ?> -  <?php print h($schedule["time_start"]); ?> );
     </script>
     <?php
   }
 }
 ?>
       </div>
     </div>
</body>
</html>

<script>
  function calender(){
  var year; //変数の宣言　年
  var mon; //月
  var dayArray=new Array("日","月","火","水","木","金","土"); //曜日の配列
  var code=""; //カレンダー作成のためのhtmlコードを代入していく変数
  	var nowDate=new Date(); //現在の日付を取得
  	year=nowDate.getFullYear(); //４桁の年を取得
   <?php
if(isset($_GET["plus_mon"])){
 $mon=$_GET["plus_mon"]+1; 
  $year=$_GET["plus_year"];
  if($mon==13){
    $year+=1;
    $mon=1;
  }
}else if(isset($_GET["minus_mon"])){
  $mon=$_GET["minus_mon"]-1;
  $year=$_GET["minus_year"];
  if($mon==0){
    $year-=1;
    $mon=12;
  }
}else{
  date_default_timezone_set("Asia/Tokyo");
  $year=date("Y");
   $mon=date("m");
}
   switch($mon){
    case 1:
    $maxDate=31;
    break;
    case 2:
    $maxDate=28;
    break;
    case 3:
    $maxDate=31;
    break;
    case 4:
    $maxDate=30;
    break;
    case 5:
    $maxDate=31;
    break;
    case 6:
    $maxDate=30;
    break;
    case 7:
    $maxDate=31;
    break;
    case 8:
    $maxDate=31;
    break;
    case 9:
    $maxDate=30;
    break;
    case 10:
    $maxDate=31;
    break;
    case 11:
    $maxDate=30;
    break;
    case 12:
    $maxDate=31;
    break;
  }
  ?>
  mon=<?php print $mon-1; ?>;
  year=<?php print $year; ?>;
  code+="<p><b><a href='friendlist.php?minus_mon=<?php print $mon; ?>&minus_year=<?php print $year; ?>'>◀</a>　"+year+"年"+(mon+1)+"月　<a href='friendlist.php?plus_mon=<?php print $mon; ?>&plus_year=<?php print $year; ?>'>▶</a></b></p>";
  code+="<table id=calender_table><tr>";
  	for(var i=0;i<dayArray.length;i++){ //曜日の見出し部分のhtml作成
  		code+="<td>"+dayArray[i]+"</td>";
  	}
  	code+="</tr><tr>";
  	var date=new Date(year,mon,1); //今月の１日の日付を取得
  	for(var i=0;i<date.getDay();i++){ //１日の曜日までの空欄部分を作成
  		code+="<td></td>";
  	}
  <?php	for($i=1;$i<=$maxDate;$i++){ //日にち（１～maxDate）部分の作成
    ?>
  		if(date.getDay()==0){ //日にちの曜日が日曜日になったら次の行へ
         <?php if($i!=1){ ?>
    code+="</tr><tr>";
      <?php } ?>
  		}
  		code+="<td><a href='friendlist.php?day=<?php print $i; ?>&mon=<?php print $mon; ?>&year=<?php print $year; ?>'>"+<?php print $i; ?>+"</a></td>"; //日にち部分作成 //変更点
  		date.setDate(date.getDate()+1); //変数dateの日付を１日進める
  <?php		if($i==$maxDate){  ?>//最終日以降までの空欄部分作成
   while(date.getDay()!=0){
    code+="<td></td>";
    date.setDate(date.getDate()+1);
  }
  <?php	} 
} ?>
code+="</tr></table>";
document.getElementById("calender").innerHTML=code;
  	//bodyタグ内に作成したhtmlを挿入
  }
</script>
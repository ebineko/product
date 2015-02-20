<!DOCTYPE html>
<html>
	<meta charset = "utf-8">

<?php
  session_start();


  if(empty($_SESSION["user_id"])){
    header("Location:../login/login.php");
    exit;
  }


  $db = new PDO("sqlite:../lib/friendiary.sqlite");
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
  $user_id=$_SESSION["user_id"];
  $st = $db->query("SELECT * FROM schedule WHERE user_id='$user_id'");
  $data = $st->fetchAll(PDO::FETCH_ASSOC);
  $count = $db->query("SELECT COUNT (*) FROM $user_id WHERE accept = 1");
  $st_name = $db->query("SELECT * FROM user WHERE user_id='$user_id'");
$user_name=$st_name->fetchAll(PDO::FETCH_ASSOC);
?>


<head>
	<title>TopPage</title>
  
	<link href = "lib/main.css" rel = "stylesheet" type="text/css">
	<link href="lib/fullcalendar.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="lib/moment.min.js"></script>
	<script src ="lib/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="lib/jquery-ui.custom.min.js"></script>
	<script type="text/javascript" src="lib/fullcalendar.min.js"></script>
	<script type="text/javascript" src="lib/ja.js"></script>

<script>
  
  
	$(function() {
    
     $('#calendar').fullCalendar({
         
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '2015-01-14',
			editable: true,
			eventLimit: true,


      
     			events: [
<?php foreach($data as $plan){ ?>
    				{
					title:'<?php print $plan["plan"]; ?>',
              <?php
              $string = strval($plan["date"]);
                              $array=str_split($string,2);
              ?>
					start:'<?php print $array[0].$array[1]."-".$array[2]."-".$array[3]; ?>'
				},
        <?php } ?>
			]
		
		});
            
          });
</script>
</head>

<body>  
  
  
  
	<div id="all_contents">
    
    <div id="logout">
      <a href="../login/logout.php">ログアウト</a>
      <p><?php 
foreach($user_name as $name){
print "ようこそ". $name["name"]."さん";
}
        ?></p>
    </div>
			
<div id="info">
				<ul id="menu">
					<li class="menu01"><a href="mypage.php">トップページ</a></li>
					<li class="menu02"><a href="../plus_delete/planplus.php">予定追加</a></li>
          <li class="menu03"><a href="../plus_delete/plandelete.php">予定削除</a></li>
					<li class="menu04"><a href="../friend/friendplus.php">友達登録</a></li>
					<li class="menu05"><a href="../friend/friendlist.php">友達一覧</a></li>
          <li class="menu06"><a href="eventlist.php">イベント一覧</a></li>
				</ul>
			</div>
    


			
			<div id="calendar"></div>
      
      <div id="friend_plus_title">友達申請一覧</div>
      <div id="friend_plus_contents">
        <?php
          print $count->fetchColumn()."件の友達申請が届いています";
        ?>
      </div>
    
    
			<div id="box_title_1">今月の予定一覧</div>
			<div id="box_contents_1">
        <?php
              foreach($data as $sample){
               $strings = strval($sample["date"]);
               $arrays = str_split($strings,2);
               if($arrays[2]==01){
                 print $arrays[2]."月".$arrays[3]."日 ".$sample["plan"]."<br>";
               }
             }
          ?>
			</div>

			<div id="box_title_2">重要な予定一覧</div>
			<div id="box_contents_2">
          <?php
              foreach($data as $sample_2){
               $strings = strval($sample_2["date"]);
               $arrays = str_split($strings,2);
               if($sample_2["rank"]>2){
                 print $arrays[2]."月".$arrays[3]."日 ".$sample_2["plan"]."<br>";
               }
             }
          ?>
			</div>
			
	</div>


</body>

</html>
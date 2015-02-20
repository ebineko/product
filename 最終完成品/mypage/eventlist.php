<!DOCTYPE html>
<html>
<head>
  
  <title>イベント一覧</title>
  
<meta charset='utf-8' />
  <?php
       session_start();
      

  $db = new PDO("sqlite:../lib/friendiary.sqlite");
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
  $user_id=$_SESSION["user_id"];
  $st = $db->query("SELECT * FROM schedule WHERE user_id='$user_id'");
  $data = $st->fetchAll(PDO::FETCH_ASSOC);
  $count = $db->query("SELECT COUNT (*) FROM $user_id WHERE accept = 1");


  ?>
  
<link href = "lib/main.css" rel = "stylesheet" type="text/css">
	<link href="lib/fullcalendar.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="lib/moment.min.js"></script>
	<script src ="lib/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="lib/jquery-ui.custom.min.js"></script>
	<script type="text/javascript" src="lib/fullcalendar.min.js"></script>
	<script type="text/javascript" src="lib/ja.js"></script>
  
<script>

	$(document).ready(function() {
	
		$('#eventcalendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '2015-01-14',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: {
				url: 'php/get-events.php',
				error: function() {
					$('#script-warning').show();
				}
			},
			loading: function(bool) {
				$('#loading').toggle(bool);
			}
		});
		
	});

</script>
</head>
<body>
  
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

	<div id='script-warning'>
		<code>php/get-events.php</code> must be running.
	</div>

	<div id='loading'>loading...</div>

	<div id='eventcalendar'></div>

</body>
</html>

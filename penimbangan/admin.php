<?php require_once('Connections/cnPenimbangan.php'); ?>
<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?message=not_logged_in");
	}
	$sql = "SELECT nama_user,posisi FROM data_user WHERE username = '" . $_SESSION['username'] . "'";
	$result = mysqli_query($cnPenimbangan, $sql);
	$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Swan</title>
	<script>
		function startTime() {
		  var today = new Date();
		  var h = today.getHours();
		  var m = today.getMinutes();
		  var s = today.getSeconds();
		  m = checkTime(m);
		  s = checkTime(s);
		  document.getElementById('txt').innerHTML =
		  h + ":" + m + ":" + s;
		  var t = setTimeout(startTime, 500);
		}
		function checkTime(i) {
		  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		  return i;
		}
	</script>
</head>
<body onload="startTime()">
	<header>
		<div class="title">PRODUKSI HARI INI</div>
		<div  class="date_time">
			<div class="box_time">
				<div id="txt" class="txt"></div>
				<div id="datetime" class="date"></div> 
			</div>
		</div>
		<div class="user_menu">
			<div class="user_logout_box">
				<a href="logout.php" class="user_logout">Logout</a>
			</div>
			<img src="image/avatar.png" class="img-admin">
			<div class="user_name">
				<div style="font-weight:bold;width: auto;text-transform: capitalize;"><?php echo $row['nama_user']; ?></div> 
				<div style="font-size: 10pt;width: auto;text-transform: capitalize;"><?php echo $row['posisi']; ?></div>
			</div> 
		</div>
	</header>

	<div class="container">
		<div class="iframe">
			<iframe src="http://localhost/penimbangan/pilihan.php" scrolling="auto" frameborder="0">asdasdsa</iframe>
		</div>
		<button> REPORT</button>
	</div>

	<footer>
		<img src="image/Untitled-1.png" class="logo-footer">
		<div class="pt_name"> 
			<div style="font-weight: bold;padding:0px 5px 0px;"> PT. PERDAMAIAN INDONESIA </div> 
			<div style="font-size: 10pt;padding:0px 5px 0px;">produsen karet gelang</div> 
	</footer>
<script>
	var dt = new Date();
	var months = new Array();
	 months[0] = "January";
	 months[1] = "February";
	 months[2] = "March";
	 months[3] = "April";
	 months[4] = "May";
	 months[5] = "June";
	 months[6] = "July";
	 months[7] = "August";
	 months[8] = "September";
	 months[9] = "October";
	 months[10] = "November";
	 months[11] = "December";
	var month = months[dt.getMonth()];
	document.getElementById("datetime").innerHTML = (("0"+dt.getDate()).slice(-2)) +" "+ month +" "+ (dt.getFullYear());
</script>
</body>
</html>
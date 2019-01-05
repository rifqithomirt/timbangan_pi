<?php require_once('Connections/cnPenimbangan.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css-screen/style.css">
</head>
<body>
<?php
if( !isset($_GET['idf']) ){
    header('location: pilihan.php');
}
	$id = $_GET['idf'];
	$timbanganAktif = $_GET['no_timbangan_aktif'];
	$sql = "SELECT * FROM status WHERE idf = '$id'";
	$result = mysqli_query($cnPenimbangan, $sql);
	$cetak = mysqli_fetch_assoc($result);
?>
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Proses sedang berjalan...</p>
    <p>Urutan : <?php echo $id?></p>
    <p>Timbangan : <?php echo $timbanganAktif ?></p>
    <br><br>
    
  </div>

</div>
</body>
</html>
<?php include('Connections/cnPenimbangan.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pilihan</title>
	<style type="text/css">
		.menu {
			float: left;
			background-color: #ff6347;
			color: #fff;
			height: 115px;
			width: auto;
			font-weight: bold;
			font-family: 'Open Sans', sans-serif;
			margin: 10px 10px 10px 10px;
		}
		.menu-img {
			width: 115px;
			height: 115px;
			top: 0;
		}
		.menu-title {
			float: right;
			font-size: 20pt;
			padding: 15px;
			margin-top: 25px;
		}
	</style>
</head>
<body>
	<?php 
		$sql = "SELECT idf, nama_produk FROM formula GROUP BY nama_produk";
		$query = mysqli_query($cnPenimbangan, $sql); 
	 while ($cetak = mysqli_fetch_array($query))
		echo '<a href="screen1.php?idf='.$cetak['idf'].'" target="_blank">
				<div class="menu"> <img src="image/logo.jpg" class="menu-img">
					<div class="menu-title">'.$cetak['nama_produk'].'</div>
				</div>
			</a>';
	?>
</body>
</html>

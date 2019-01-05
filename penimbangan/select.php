<?php require_once('Connections/cnpenimbangan.php') ;

 		$cetak = "SELECT f.no_urut AS 'no_urut_formula', s.no_urut as 'no_urut_status'
 		FROM  `formula` f JOIN `status` s ON f.nama_produk = s.nama_produk_aktif
		ORDER BY f.no_urut DESC LIMIT 1";

		$query = mysqli_query($cnPenimbangan, $cetak);
 		$rows = array();
		while($r = mysqli_fetch_assoc($query)) {
			$rows['rows'][] = $r;
		}
		print json_encode($rows);
?> 

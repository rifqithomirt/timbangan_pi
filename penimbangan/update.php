<?php require_once('Connections/cnpenimbangan.php') ;
 		$no_urut 		=   $_GET['no_urut'] * 1;
 		$nama_produk_aktif		=	$_GET['nama_produk_aktif'] ;
 		$cetak = "UPDATE `status` SET  no_urut= ".$no_urut." WHERE nama_produk_aktif = '".$nama_produk_aktif."'";
      	
 		if (mysqli_query($cnPenimbangan, $cetak)) {
 			print  "Data Berhasil Disimpan" ;
 		} else{
 			print "Gagal Disave" ;
 		}
?> 
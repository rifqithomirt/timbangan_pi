<?php require_once('Connections/cnpenimbangan.php') ;

 		$nama_produk 		= $_GET['nama_produk'] ;
 		$nama_material		= $_GET['nama_material'];
 		$netto				= $_GET['netto'] ;
 		$tara				= $_GET['tara'] ;
 		$no_timbangan		= $_GET['no_timbangan'] ;
 		$jam_timbang		= $_GET['jam_timbang'] ;

 		$cetak2 = "INSERT INTO hasil " .
					"VALUES ( '" .
							$nama_produk .	"' , '" .
							$nama_material . 	"' , '" .
							$netto .	"' , '" .
							$tara .	"' , '" .
							$no_timbangan .	"' , '" .
							$jam_timbang .	"' , '" .
							"" .
						"' )" ;
        

 		if (mysqli_query($cnPenimbangan, $cetak2)) {
 			print  "Data Berhasil Disimpan" ;
 		} else{
 			print "Gagal Disave" ;
 		}
?> 
<?php include('Connections/cnpenimbangan.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pilihan</title>
	<link rel="stylesheet" type="text/css" href="js/jquery-confirm.min.css">
	<style type="text/css">
	body{
		max-width: 100%;
		max-height: 100%;
	}
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
	 	/*
		echo '<a href="screen1.php?idf='.$cetak['idf'].'" target="_blank">
				<div class="menu"> <img src="image/logo.jpg" class="menu-img">
					<div class="menu-title">'.$cetak['nama_produk'].'</div>
				</div>
			</a>';
			*/
			echo '<div class="menu"> <img src="image/logo.jpg" class="menu-img">
					<button id="BtnNamaProduk" class="menu-title">'.$cetak['nama_produk'].'</button>
				  </div>';
	?>
</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-confirm.min.js"></script>
<script type="text/javascript">
	var funRequestGet = function( option, callback ){
		httpGet("api.php?tablename=" + option.tablename, callback);
	}
	var funInsertHasil = function(option, callback) {
		var buildQuerystring = Object.keys(option).map(( objName ) => { return objName + '=' + option[objName]; }).join('&');
		console.log(encodeURIComponent(buildQuerystring) );
		httpGet("insert.php?" + buildQuerystring, callback);
	};
	var funUpdateStatus = function(option, callback){
		var buildQuerystring = Object.keys(option).map((objName) => { return objName + '=' + option[objName]; }).join('&');
		httpGet("modeSetStatus.php?" + buildQuerystring, callback);
	}
	var funFinish = function(callback){
		httpGet("select.php", callback);
	}
	var httpGet = function(url, callback){
		console.log(url);
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
		    callback( this.responseText );	    
		  }
		};
		xmlhttp.open("GET", url, true);
		xmlhttp.send();
	}
</script>
<script type="text/javascript">
$('button#BtnNamaProduk').on('click',function(){
	var namaProdukPilihan = $(this).text();
	$.confirm({
	    title: 'Lanjutkan Proses!',
	    content: 'Apakah anda ingin menimbang '+ namaProdukPilihan +'?',
	    buttons: {
	        confirm: function () {
	        	$($('.jconfirm button')[2]).attr('disabled', 'disabled');
	          funUpdateStatus({no_urut: 1, nama_produk_aktif: namaProdukPilihan}, function(result){
	           	$.alert(result); 
	          });
	          return false;
	        },
	        cancel: function () {},
	        somethingElse: {
	            text: 'Finish',
	            btnClass: 'btn-blue',
	            keys: ['enter', 'shift'],
	            action: function(){
	                $.alert('Selesai Melakukan Penimbangan');
	            }
	        }
	    },
	    onContentReady: function () {
	    	$($('.jconfirm button')[2]).attr('disabled', 'disabled');
	        var jc = this;
	        this.$content.find('form').on('enter', function (e) {
	            e.preventDefault();
	            jc.$$formSubmit.trigger('click'); // reference the button and click it
	        });
	        $($('.jconfirm button')[0]).text('Start');
	        var funCheckFinish = function(){
	        	funFinish((result) => {
					result = JSON.parse(result);
					if (result.rows[0].no_urut_formula < result.rows[0].no_urut_status) {
						$($('.jconfirm button')[2]).removeAttr('disabled');
					}
						
				});
	        }
	        
	        var funCheckStart = function(){
	        	funFinish((result) => {
					result = JSON.parse(result);
					if (result.rows[0].no_urut_formula >= result.rows[0].no_urut_status) {
						$($('.jconfirm button')[0]).attr('disabled', 'disabled');
					}
						
				});
	        }
	        
	        setInterval(function(){
	        	funCheckStart();
	        	funCheckFinish();

	        }, 2500);
	    }
	}); 

});
</script>
</html>
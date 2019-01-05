<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css-screen/style.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-confirm.min.css">
	<title>Screen 3</title>
</head>
<body>
<div class="top">
	<img src="image/logo.jpg" class="logo">
	<div class="top-border">
		<div class="top-nameBrand"> IDLE </div>
	</div>
	<div class="top-material"> Material </div>
	<div class="top-materialName">idle</div>
</div>
<div class="middle-top">
	<div class="weight-target"> 
		<div class="weight-font-target">Berat Target</div>
		<div class="weight-num-target">0.00</div>
		<div class="unit-target">Kg</div>
	</div>
	
	<div class="weight-aktual"> 
		<div class="weight-font-aktual">Berat Aktual</div>
		<div class="weight-num-aktual"> Null </div>
		<div class="unit-aktual">Kg</div>
	</div>
</div>
<div class="middle-bottom">
	<div class="command">PERINTAH</div>
	<div class="command-content">Idle</div>
</div>
<div class="bottom">
	<button class="button"> Timbang Ulang</button>
	<button id="myBtn" class="button">Submit</button>
</div>

<script src="js/mqttws31.js"></script>
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
		httpGet("update.php?" + buildQuerystring, callback);
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
<script>
var weightData = {};
var currentState = 'idle';
var states = [
	'idle',
	'wadah',
	'tara',
	'material',
	'ambil'
];
var flagReadyToWeight = false;
var ID_DEVICE = 3;
var loopCheck = function(){
	if( flagReadyToWeight == false ) {
		funRequestGet({tablename: 'formula'}, function(result) {
			result = JSON.parse(result);
			objFormulaGroupedByNamaProduk  = {};
			result.rows.forEach(function( formula ){
				objFormulaGroupedByNamaProduk[ formula.nama_produk + "-" + formula.no_urut ] = formula;
			});
			funRequestGet({tablename:'status'}, function( status ){
				status = JSON.parse(status);
				console.log(status);
				currentUrutanTimbang = status.rows[0]['no_urut'];
				currentNamaProduk = status.rows[0]['nama_produk_aktif'];
				if( (currentNamaProduk + "-" + currentUrutanTimbang) in objFormulaGroupedByNamaProduk ) {
					
					if( objFormulaGroupedByNamaProduk[currentNamaProduk + "-" + currentUrutanTimbang]['no_timbangan'] == ID_DEVICE.toString() ) {
						var currentProductName = objFormulaGroupedByNamaProduk[currentNamaProduk + "-" + currentUrutanTimbang]['nama_produk'];
						var currentMaterialName = objFormulaGroupedByNamaProduk[currentNamaProduk + "-" + currentUrutanTimbang]['nama_material'];
						var currentNettoTarget = objFormulaGroupedByNamaProduk[currentNamaProduk + "-" + currentUrutanTimbang]['netto'];
						$('.top-nameBrand').text(currentNamaProduk);
						$('.top-materialName').text(currentMaterialName);
						$('.weight-num-target').text(currentNettoTarget);
						flagReadyToWeight = true;
						weightData['nama_produk'] = currentProductName;
						weightData['nama_material'] = currentMaterialName;
						currentState = 'zero';
					} else {
						location.reload();
						flagReadyToWeight = false;
					}			
				} else {
					location.reload();
					flagReadyToWeight = false;
				}
			});
		});
	}
};
setInterval(loopCheck, 2000);

main = function( ){
	var valueTimbangan = $('.weight-num-aktual').text() * 1;
	if( flagReadyToWeight ) {
		switch (currentState) {
			case 'idle':
				$('.command-content').text('Idle');
				currentState = 'zero';
				main();
				break;
			case 'zero':
				$('.command-content').text('Tekan tombol Zero');
				if( valueTimbangan == 0 ) {
					currentState = 'wadah';
				}
				break;
			case 'wadah':
				$('.command-content').text('Taruh Wadah');
				if( valueTimbangan > 0.1 ) {
					currentState = 'Tara';
				}
				break;
			case 'tara':
				$('.command-content').text('Tekan Tara jika timbangan Stabil');
				if( valueTimbangan > 0.1 ) {
					weightData['Tara'] = valueTimbangan;
				} else if( valueTimbangan == 0 &&  'tara' in weightData ) {
					currentState = 'material';
				}
				break;
			case 'material':
				$('.command-content').text('Isi Material');
				break;
		} 
	}
}

$('#myBtn').on('click', function(){
	var valueTimbangan = 50.02;//$('.weight-num-aktual').text() * 1;
	var targetTimbangan = $('.weight-num-target').text() * 1;
	var toleransi = 0.1; //Kg
	if( valueTimbangan <= (targetTimbangan + toleransi) && valueTimbangan >= (targetTimbangan - toleransi) ) {
		var data = {
			'nama_produk': weightData['nama_produk'],
			'nama_material': weightData['nama_material'],
			'netto': valueTimbangan,
			'tara': weightData['Tara'] || 0.25,
			'jam_timbang': new Date().toISOString(),
			'no_timbangan': ID_DEVICE
		};
		//localStorage.setItem('lastWeight', JSON.stringify(data));
		funInsertHasil(data, function( result ){
			alert(result);
			console.log(result=='Data Berhasil Disimpan', result);
			if (result=='Data Berhasil Disimpan ') {
				funUpdateStatus({no_urut:(currentUrutanTimbang * 1) + 1, nama_produk_aktif: currentNamaProduk}, function(result){
					alert(result); });
				flagReadyToWeight = false;
			}
		});
		
	} else {
		alert('Selisih dengan Target' );
	}
});
</script>
<script type="text/javascript">
	/*
	var client = new Paho.MQTT.Client("127.0.0.1", 15675,"/ws", "clientId");
	client.onConnectionLost = onConnectionLost;
	client.onMessageArrived = onMessageArrived;
	client.connect({onSuccess:onConnect});
	function onConnect() {
	  console.log("onConnect");
	  client.subscribe("timbangan");
	}

	function onConnectionLost(responseObject) {
	  if (responseObject.errorCode !== 0) {
	    console.log("onConnectionLost:"+responseObject.errorMessage);
	  }
	}
	function onMessageArrived(message) {
	  console.log("onMessageArrived:"+message.payloadString);
	  $('.weight-num-aktual').text(message.payloadString);
	  main();
	}*/
</script>
</body>
</html>

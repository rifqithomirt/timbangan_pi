<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css-screen/style.css">
	<title>Screen</title>
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
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Proses sedang berjalan...</p>
    <p>Urutan : 1</p>
    <p>Timbangan : 2</p>
  </div>

</div>
<div class="bottom">
	<button> Timbang Ulang</button>
	<button id="myBtn">Submit</button>
</div>
<script>
// Get the modal
var modal = document.getElementById('myModal');
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script src="js/mqttws31.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
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
	}
</script>
<script type="text/javascript">
	var funRequest = function( option, callback ){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
		    callback( JSON.parse(this.responseText) );	    
		  }
		};
		xmlhttp.open("GET", "api.php?tablename=" + option.tablename, true);
		xmlhttp.send();
	}
</script>
<script>
var currentState = 'idle';
var states = [
	'idle',
	'wadah',
	'tara',
	'material'
];
var flagReadyToWeight = false;
var ID_DEVICE = 1;
funRequest({tablename: 'formula'}, function( formula ){
	var formulaByProductName = {};
	formula.rows.forEach(function(e){
		formulaByProductName[e.nama_produk + '-' + e.no_urut]=e;
	});
	funRequest({tablename:'status'}, function( status ){
		var currentUrutanTimbang = status.rows[0]['No Urut'];
		var currentNamaProduk = status.rows[0]['Nama Produk Aktif'];
		if( (currentNamaProduk + "-" + currentUrutanTimbang) in formulaByProductName ) {
			if( formulaByProductName[currentNamaProduk + "-" + currentUrutanTimbang]['no_timbangan'] == ID_DEVICE.toString() ) {
				$('.top-nameBrand').text(formulaByProductName[currentNamaProduk + "-" + currentUrutanTimbang]['nama_produk']);
				$('.top-materialName').text(formulaByProductName[currentNamaProduk + "-" + currentUrutanTimbang]['nama_material']);
				$('.weight-num-target').text(formulaByProductName[currentNamaProduk + "-" + currentUrutanTimbang]['netto']);
				flagReadyToWeight = true;
			} else {
				flagReadyToWeight = false;
			}
		} else {
			flagReadyToWeight = false;
		}
	});
});

if( flagReadyToWeight ) {
	main = function( onState ){
		switch (onState) {
			case 'idle':
			case 'wadah':
			case 'tara':
			case 'material':
		} 
	}
}
</script>
</body>
</html>

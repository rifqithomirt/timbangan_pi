<?php require_once('Connections/cnPenimbangan.php') ?>
<?php 
	$tablename = $_GET['tablename'];
	$sql = "SELECT * FROM $tablename";
	
	$query = mysqli_query($cnPenimbangan, $sql);
	$rows = array();
	while($r = mysqli_fetch_assoc($query)) {
		$rows['rows'][] = $r;
	}
	print json_encode($rows);
?>
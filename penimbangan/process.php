<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'Connections/cnPenimbangan.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($cnPenimbangan,"SELECT * FROM data_user WHERE username = '$username'and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:admin.php");
}else{
	header("location:index.php?message=failed");
}
?>
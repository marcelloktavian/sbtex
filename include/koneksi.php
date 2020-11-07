<?php 

$ip = "localhost";
$user = "root";
$pass = "";
$db = "asiantex2020";

$koneksi = mysqli_connect($ip, $user, $pass, $db);

if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
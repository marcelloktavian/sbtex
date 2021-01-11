<?php 

$ip = "localhost";
$user = "root";
$pass = "";
$db = "asiantex2018";

$conn = mysqli_connect($ip, $user, $pass, $db);

if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

//define data
define('BASE_URL','http://localhost/sbtex/');

?>
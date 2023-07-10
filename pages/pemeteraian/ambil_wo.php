<?php
header('Access-Control-Allow-Origin: *');
require "../../include/koneksi.php";

$id = $_POST['wo'];

$sql = "SELECT * FROM tblwo WHERE id_wo = '".$id."'";
$result = $conn->query($sql);
$hasil = mysqli_query($conn,$sql);

$isi = array();

if ($result->num_rows > 0) {
	while ($d = mysqli_fetch_array($hasil)) {
		$data[] = array_push($isi, array('jum' => 1,'kode' => $d['kode']));
	}
}else{
	$data[] = array_push($isi, array('jum' => 0));
}

echo json_encode($isi);
?> 
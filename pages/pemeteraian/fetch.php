<?php
require "../../include/koneksi.php";

$idnya = '';
$id = $_POST['wo'];

$sql = "SELECT id_wo, seq, roll FROM tblwodet WHERE id_wo = '".$id."'";
$hasil = mysqli_query($conn,$sql);

$isi = array();

while ($d = mysqli_fetch_array($hasil)) {
	$data[] = array_push($isi, array('seq' => $d['seq'], 'roll' => $d['roll']));
}
echo json_encode($isi);

?> 
<?php
header('Access-Control-Allow-Origin: *');
require "../../include/koneksi.php";

$idnya = '';
$so = $_POST['so'];
$id = $_POST['wo'];

$sql = "SELECT id_wo, seq, qty,setting FROM tblwodet WHERE id_wo = '".$id."' AND id_so = '".$so."' ";
// var_dump($sql);die;
$hasil = mysqli_query($conn,$sql);

$isi = array();

while ($d = mysqli_fetch_array($hasil)) {
	$data[] = array_push($isi, array('seq' => $d['seq'], 'qty' => $d['qty'],'setting' => $d['setting']));
}
echo json_encode($isi);

?> 
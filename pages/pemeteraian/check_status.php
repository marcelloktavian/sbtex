<?php
header('Access-Control-Allow-Origin: *');
require "../../include/koneksi.php";

$id = $_POST['idwo'];

$sql = "SELECT status FROM tblwodet WHERE id_wo = '".$id."'";
$hasil = mysqli_query($conn,$sql);
$d = mysqli_fetch_array($hasil);
echo json_encode($d['status']);

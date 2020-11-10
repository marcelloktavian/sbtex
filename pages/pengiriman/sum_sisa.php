<?php
header('Access-Control-Allow-Origin: *');
error_reporting(0);
require "../../include/koneksi.php";
$idkgdet = $_POST["idkgdet"];
// hasilnya nanti gini = (dari / total) atau (1/8) contohnya
//total
$datatotal = mysqli_query($conn," SELECT COUNT(*) AS total FROM tblfrm_gudangkg WHERE id_wo=(SELECT id_wo FROM tblfrm_gudangkg WHERE id_kgdet='$idkgdet' LIMIT 1) ");
$fetchtotal = mysqli_fetch_assoc($datatotal);

if($idkgdet == ""){
	$total = 0;
}else if($idkgdet != ""){
	$total= $fetchtotal['total'];
}

echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Roll PERKP terakhir:".$total."</strong>";
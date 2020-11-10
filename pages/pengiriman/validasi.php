<?php
header('Access-Control-Allow-Origin: *');
include "../../include/koneksi.php";
$idkgdet = $_POST['barcode'];
// var_dump($idkgdet);
//validasi kalau ga ada digudang gausah dimasukin
$sql = "select 'a' from tblfrm_gudangkg where id_kgdet=".$idkgdet;
$val404 = mysqli_query($conn, $sql);

//for duplicate data
$sqlduplicate = "select 'a' from tblprakirim where id_kgdet=".$idkgdet;
$valDup = mysqli_query($conn, $sqlduplicate);
// var_dump($sql);

if($val4 = mysqli_num_rows($val404)==0){
     //jika tidak ada data
	echo '404';
}

if($valD = mysqli_num_rows($valDup)!=0){
    // jika data sudah pernah diposting / atau data berarti duplicate
	echo "202";
}
?>
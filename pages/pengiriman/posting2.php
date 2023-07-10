<?php
header('Access-Control-Allow-Origin: *');
include "../../include/koneksi.php";
$idkgdet = $_POST['barcode'];
$idgroup = $_POST['id_group'];
for ($i=0; $i < count($idkgdet); $i++) {
    $sqlInsert="INSERT INTO tblprakirim (id_kgdet,id_grey,id_cust,id_jw,id_so,id_wo,kg,list,id_p,id_mc,id_wh,id_jpo,setting,jasapo,qty,id_stokkg,id_grouplist)
    SELECT a.*,'$idgroup' from vwpostprakirim a WHERE id_kgdet =".$idkgdet[$i]." ";
    $valInsert=mysqli_query($conn,$sqlInsert);
}
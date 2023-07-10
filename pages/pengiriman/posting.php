<?php
header('Access-Control-Allow-Origin: *');
include "../../include/koneksi.php";
$idkgdet = $_POST['barcode'];
$idgroup = $_POST['id_group'];
for ($i=0; $i < count($idkgdet); $i++) {
    $sqlInsert="INSERT INTO tblprakirim (id_kgdet,id_grey,id_cust,id_jw,id_so,id_wo,kg,list,id_p,id_mc,id_wh,id_jpo,setting,jasapo,qty,id_stokkg,id_grouplist)
    SELECT id_kgdet,id_grey,id_cust,id_jw,id_so,id_wo,kg,Y,id_p,id_mc,id_wh,id_jpo,setting,jasapo,1,id_stokkg,'$idgroup' from vwpostprakirim a WHERE id_kgdet =".$idkgdet[$i]." GROUP BY a.id_kgdet";
    $valInsert=mysqli_query($conn,$sqlInsert);
}

// create query select tblprakirim wjere id_grouplist = $idgroup
$sqlSelect = "SELECT * FROM tblprakirim WHERE id_grouplist = '$idgroup'";
$valSelect = mysqli_query($conn, $sqlSelect);

// while valselect as row
while ($row = mysqli_fetch_assoc($valSelect)) {
    // if row['id_stokkg'] = 0 or null
    if ($row['id_stokkg'] == 0 || $row['id_stokkg'] == null) {
        // update with subquery
        $sqlUpdat6e = "UPDATE tblprakirim SET id_stokkg = (SELECT id_stokkg FROM tblstokkg WHERE id_kgdet = ".$row['id_kgdet'].") WHERE id_kgdet = ".$row['id_kgdet'];
        $valUpdate = mysqli_query($conn, $sqlUpdate);
    }
}
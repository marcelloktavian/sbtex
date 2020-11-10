<?php
header('Access-Control-Allow-Origin: *');
include "../../include/koneksi.php";
$idkgdet = $_POST['barcode'];
$idgroup = $_POST['id_group'];
$test='';
for ($i=0; $i < count($idkgdet); $i++) { 
    if ($i==0) {
     $test = $test.$idkgdet[$i];
 } else {
     $test = $test.','.$idkgdet[$i];
 }
 
}

    // $status = $_POST['status'];
    // var_dump($idkgdet);
    //looping agar idkgdet menjadi seperate/masing masing
    //asalnya datanya berbentuk array barcode:['123','456']
    // for ($count=0; $count<count($idkgdet); $count++){
        //dipisah dan dimasukan ke variable idkgdetsatuan
        //contohnya $idkgdet_satuan='123';
        // $idkgdet_satuan= $idkgdet[$count];
        //validasi tidak boleh kosong valuenya
        // if($idkgdet_satuan !== ""){
            //validasi jika data sudah ada didatabase maka tidak bisa disave lagi
            // $valSame = mysqli_query($conn,"select 'a' from tblprakirim where id_kgdet=$idkgdet_satuan ");
            // if(mysqli_num_rows($valSame)==0){
                //validasi kalau ga ada digudang gausah dimasukin
                // $val404 = mysqli_query($conn,"select 'a' from tblfrm_gudangkg where id_kgdet=$idkgdet_satuan ");
                // if(mysqli_num_rows($val404)>0){
                    //maka jalankan insert query sekarang
$sqlInsert="INSERT INTO tblprakirim (id_kgdet,id_grey,id_cust,id_jw,id_so,id_wo,kg,list,id_p,id_mc,id_wh,id_jpo,setting,jasapo,qty,id_stokkg,id_grouplist)
SELECT a.*,'$idgroup' from vwpostprakirim a WHERE id_kgdet IN ($test) ";
                    // var_dump($sqlInsert);die;
$valInsert=mysqli_query($conn,$sqlInsert);
                // }
            // }
        // }
    // }
?>
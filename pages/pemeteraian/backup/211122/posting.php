<?php
header('Access-Control-Allow-Origin: *');
include "../../include/koneksi.php";

$wo = $_POST['idwo'];
$kg = $_POST['kg'];
$seq = $_POST['seq'];
$setting = $_POST['setting'];
$other = explode(';',$_POST['other']);
$id_jw=$other[0];
$id_cust=$other[1];
$id_so=$other[2];
$id_jp=$other[3];
$id_grey=$other[4];
// var_dump($other);die;

// var_dump($wo,$kg,$seq);die;

$bulan = date('m');
$tahun = date('y');

$sql = mysqli_query($conn, "SELECT MAX(SUBSTR(id_kg,9,4)) AS kode FROM tblwokg WHERE SUBSTR(id_kg,4,2)=MONTH(NOW()) AND SUBSTR(id_kg,6,2)=SUBSTR(YEAR(NOW()),3,2) LIMIT 1") or die (mysql_error());
$hasil = mysqli_fetch_assoc($sql);

// var_dump($hasil['kode']);

if($hasil['kode'] !== null){
	//ambil kode terakhir
	$awal = $hasil['kode']+1;
	$hasil = str_pad($awal,4,'0',STR_PAD_RIGHT);
	
	$idkg = 'KG/'.$bulan.$tahun.'/'.$hasil;
}else{
	$idkg = 'KG/'.$bulan.$tahun.'/0001';
}

for ($i=0; $i < count($seq); $i++) { 
	$result=$conn->query("INSERT INTO tblwokg(id_kg, id_wo, kg, seq,setting,id_jw,id_so,id_cust,id_jp,id_grey) VALUES ('".$idkg."', '".$wo."', '".$kg[$i]."', '".$seq[$i]."','".$setting[$i]."','".$id_jw."','".$id_so."','".$id_cust."','".$id_jp."','".$id_grey."');");
	// var_dump($result);break;die;
}

// menggunakan array keys 
for ($j=0; $j < count($u_seq=array_keys(array_flip($seq))); $j++) {
	// var_dump('array ke-'.$j.' isi= '.$u_seq[$j]);
	$mst_kg = mysqli_query($conn,"UPDATE tblwodet set kg =(select sum(kg) from tblwokg where id_wo='$wo' and seq='$u_seq[$j]' group by id_wo) where id_wo='$wo' and seq='$u_seq[$j]'") or die (mysql_error());
}

// $mst_kg = mysqli_query($conn,"UPDATE tblwodet set kg =(select sum(kg) from tblwokg where id_wo='$wo' group by id_wo) where id_wo='$wo'") or die (mysql_error());
// var_dump($mst_kg);die;

mysqli_query($conn," UPDATE tblwo SET totalkg=(SELECT sum(kg) FROM tblwokg WHERE id_wo='$wo' GROUP BY id_wo) WHERE id_wo='$wo' ");

mysqli_query($conn," UPDATE tbldisplayproses SET start_time=NOW(),end_time=NOW() WHERE id_wo='$wo'  ");





?>
<?php
include "../../include/koneksi.php";

$wo = $_POST['idwo'];
$kg = $_POST['kg'];
$seq = $_POST['seq'];

$bulan = date('m');
$tahun = date('y');

$sql = mysqli_query($conn, "SELECT MAX(SUBSTR(id_kg,9,4)) AS kode FROM tblwokg WHERE SUBSTR(id_kg,4,2)=MONTH(NOW()) AND SUBSTR(id_kg,6,2)=SUBSTR(YEAR(NOW()),3,2) LIMIT 1") or die (mysql_error());
$hasil = mysqli_fetch_assoc($sql);

// var_dump($hasil['kode']);

if($hasil['kode'] !== null){
	//ambil kode terakhir
	$awal = $hasil['kode']+1;
	if (strlen($awal)==1) {
		$hasil = '000'.$awal;
	} else if (strlen($awal)==2) {
		$hasil = '00'.$awal;
	} else if (strlen($awal)==3) {
		$hasil = '0'.$awal;
	} else {
		$hasil = $awal;
	}
	
	$idkg = 'KG/'.$bulan.$tahun.'/'.$hasil;
}else{
	//jika null = buat kode baru
	$idkg = 'KG/'.$bulan.$tahun.'/0001';
}

// var_dump($idkg);

for ($i=0; $i < count($seq); $i++) { 
	$conn->query("INSERT INTO tblwokg(id_kg, id_wo, kg, seq) VALUES ('".$idkg."', '".$wo."', '".$kg[$i]."', '".$seq[$i]."');");
}

?>
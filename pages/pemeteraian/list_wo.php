<?php
header('Access-Control-Allow-Origin: *');
require "../../include/koneksi.php";

$sql = "SELECT a.*,b.kode AS no_kp,DATE_FORMAT(b.tgl_trans,'%d/%m/%Y') as tgl_trans,c.nama as warna,c.kode as kodewarna,d.namagrey as grey,e.namaperusahaan as customer,b.state_po,a.setting FROM tblwodet a LEFT JOIN tblwo b ON (a.id_wo = b.id_wo) left join tbljasawarna c on (a.`id_jw`=c.id_jw) left join tblgrey d on (a.`id_grey`=d.id_grey) left join tblpelanggan e on (a.`id_cust`=e.id_cust) WHERE a.kg =0 ";
$result = $conn->query($sql);
$hasil = mysqli_query($conn,$sql);

$isi = array();

	while ($d = mysqli_fetch_array($hasil)) {
		$data[] = array_push($isi, array('no_kp' => $d['no_kp'],'id_wo' => $d['id_wo'],'warna' => $d['warna'],'kodewarna' => $d['kodewarna'],'grey' => preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $d['grey']),'customer' => $d['customer'],'qty' => $d['qty'],'status' => $d['status'],'tgl_trans' => $d['tgl_trans'],'id_jw' => $d['id_jw'],'id_so' => $d['id_so'],'id_cust' => $d['id_cust'],'id_jpo' => $d['id_jpo'],'id_grey' => $d['id_grey'],'state_po' => $d['state_po'],'setting' => $d['setting']));
	}

echo json_encode($isi);
?> 
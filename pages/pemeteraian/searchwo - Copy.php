<?php
    header('Access-Control-Allow-Origin: *');
    require "../../include/koneksi.php";
    $kode = $_POST['kodewo'];

    $sql = "SELECT a.*,b.kode AS no_kp,DATE_FORMAT(b.tgl_trans,'%d/%m/%Y') AS tgl_trans,c.nama AS warna,c.kode AS kodewarna,d.namagrey AS grey,e.namaperusahaan AS customer,b.state_po,a.setting FROM tblwodet a LEFT JOIN tblwo b ON (a.id_wo = b.id_wo) LEFT JOIN tbljasawarna c ON (a.`id_jw`=c.id_jw) LEFT JOIN tblgrey d ON (a.`id_grey`=d.id_grey) LEFT JOIN tblpelanggan e ON (a.`id_cust`=e.id_cust) WHERE YEAR(tgl_trans)=YEAR(NOW()) AND  b.kode=$kode ";
    $result = $conn->query($sql);
    $hasil = mysqli_query($conn,$sql);

    $isi = array();

        while ($d = mysqli_fetch_array($hasil)) {
            $data[] = array_push($isi, array('no_kp' => $d['no_kp'],'id_wo' => $d['id_wo'],'warna' => $d['warna'],'kodewarna' => $d['kodewarna'],'grey' => $d['grey'],'customer' => $d['customer'],'qty' => $d['qty'],'status' => $d['status'],'tgl_trans' => $d['tgl_trans'],'id_jw' => $d['id_jw'],'id_so' => $d['id_so'],'id_cust' => $d['id_cust'],'id_jpo' => $d['id_jpo'],'id_grey' => $d['id_grey'],'state_po' => $d['state_po'],'setting' => $d['setting']));
        }

    echo json_encode($isi);

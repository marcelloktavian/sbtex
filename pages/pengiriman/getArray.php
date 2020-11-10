<?php
require "../../include/koneksi.php";
$data = array();
$varArray = mysqli_query($conn," SELECT COUNT(a.id_grouplist) AS dataPost,b.kode as kp,a.id_grouplist as groups FROM tblprakirim a left join tblwo b on (a.id_wo = b.id_wo) WHERE a.id_grouplist is not null and list='Y' GROUP BY a.id_grouplist,a.id_wo ");
$varSum = mysqli_query($conn," SELECT COUNT(a.id_grouplist) AS total FROM tblprakirim a WHERE a.id_grouplist IS NOT NULL AND LIST='Y' ");
$sum = mysqli_fetch_assoc($varSum);
$test['total']  = $sum['total'];
array_push($data,$test);
while($r = mysqli_fetch_object($varArray)){
    $output['count'] = $r->dataPost;
    $output['kp']=$r->kp;
    $output['groups'] = $r->groups;
    array_push($data,$output);
}
    // var_dump($data);
echo json_encode($data);
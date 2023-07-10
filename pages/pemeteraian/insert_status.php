<?php
header('Access-Control-Allow-Origin: *');
require "../../include/koneksi.php";
$wo = $_POST["idwo"];
$so = $_POST['so'];
// $test = "UPDATE tblwodet set status ='on' WHERE id_wo='$wo' AND id_so='$so'";
// var_dump($test);die;
mysqli_query($conn," UPDATE tblwodet set status ='on' WHERE id_wo='$wo' AND id_so='$so' ");
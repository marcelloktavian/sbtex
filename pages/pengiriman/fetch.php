<?php
header('Access-Control-Allow-Origin: *');
require "../../include/koneksi.php";
error_reporting(0);
if(isset($_POST['barcode'])){
    $idkgdet = $_POST["barcode"];
// var_dump($idkgdet);
}else{
    $idkgdet="";
}
for($count=0; $count<count($idkgdet); $count++){
    $idkgdet_satuan = $idkgdet[$count];
    
    $output = '';
    $query = "SELECT * FROM vwprakirim WHERE id_kgdet = $idkgdet_satuan";
    // var_dump($query);
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result))
    {
        $output = '
        <tr>
        <td>'.$row["id_kgdet"].'</td>
        <td>'.$row["so"].'</td>
        <td>'.$row["kp"].'</td>
        <td>'.$row["namaperusahaan"].'</td>
        <td>'.$row["kg"].'</td>
        </tr>
        ';
    }
}
echo $output;
?>


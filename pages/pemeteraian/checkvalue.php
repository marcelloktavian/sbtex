<?php
require "../../include/koneksi.php";
$idso = $_POST['idso'];
$sql = "SELECT * FROM tblsokg WHERE id_sokg=(SELECT id_kg FROM tblsodet WHERE id_SOdet= (SELECT id_detso FROM tblwodet WHERE id_so='".$idso."' LIMIT 1) LIMIT 1)";
// each row is added as a row in the table
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) {
    // give $row['kg'] 2 decimal places with .
    $row['kg'] = number_format($row['kg'], 2, '.', '');
    $data[] = $row['kg'];
}
echo json_encode($data);
?>
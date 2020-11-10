<?php
    require "../../include/koneksi.php";
    $data = $_POST['kodegroups'];
    foreach( $data as $d){
        $sql="UPDATE tblprakirim SET list='N' WHERE id_grouplist='$d'";
        mysqli_query($conn,$sql);
    }
<?php
session_start();
include '../database/connect.php';

$jabatan = $_POST['nama_jabatan'];


if(empty($jabatan)){

    header("Location:../pages/data_jabatan.php?error=alert");
}else{
    $sql = mysqli_query($mysqli, "INSERT INTO tb_jabatan(id_jabatan,nama_jabatan)VALUES(null,'$jabatan')");

    header("Location:../pages/data_jabatan.php?sukses=alert");       
}

?>
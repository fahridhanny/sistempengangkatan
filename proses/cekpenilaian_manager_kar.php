<?php

include '../database/connect.php';

$id_karyawan = $_POST['id_karyawan'];
$wawancara = $_POST['wawancara'];
$skill = $_POST['skill'];

if(!$id_karyawan || !$wawancara || !$skill){
    echo "<script>alert('Data harus diisi semua'); window.location.href = '../pages/data_penilaian.php';</script>";
}else{
    
        $sql = mysqli_query($mysqli, "INSERT INTO tb_penilaian(id_penilaian,id_karyawan,wawancara
        ,skill)VALUES(null,'$id_karyawan','$wawancara','$skill')");
        
        echo "<script>alert('Manager Berhasil Memberikan Nilai'); window.location.href = '../pages/data_kar.php';</script>";
                                               
}

?>
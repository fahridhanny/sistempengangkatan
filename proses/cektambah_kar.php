<?php
session_start();
include '../database/connect.php';

//foto
$targetDir= "../images/";
$targetFile=$targetDir . basename($_FILES["foto"]["name"]); 
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

$lokasi_foto = $_FILES["foto"]["tmp_name"];

$id_karyawan = 'KAR'.(rand(1,999999)+date("s"));
$id_jabatan = $_POST['id_jabatan'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$tmp_lahir = $_POST['tmp_lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$awal_kontrak = $_POST['awal_kontrak'];

$strtotime_awal_kontrak = strtotime($awal_kontrak);

$akhir_kontrak = date('Y-m-d', strtotime('+90 day', $strtotime_awal_kontrak));

// $masa_kontrak = strtotime($akhir_kontrak) - strtotime($awal_kontrak);


if(!$id_karyawan || !$id_jabatan || !$nama || !$jk || !$alamat || !$alamat || !$no_telp || !$tmp_lahir || !$tgl_lahir || !$awal_kontrak || !$akhir_kontrak || !$lokasi_foto){
    echo "<script>alert('Data harus diisi semua'); window.location.href = '../pages/data_kar.php';</script>";
}else{
    if(strlen($no_telp) > 12){
        echo "<script>alert('No telpon tidak boleh lebih dari 12 karakter'); window.location.href = '../pages/data_kar.php';</script>";
    }elseif(strlen($no_telp) < 12){
        echo "<script>alert('No telpon tidak boleh kurang dari 12 karakter'); window.location.href = '../pages/data_kar.php';</script>";
    }else{
    move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
    $foto = basename( $_FILES["foto"]["name"]);
    $sql = mysqli_query($mysqli, "INSERT INTO tb_karyawan(id_karyawan,id_jabatan,nama,jk,alamat,
                            no_telp,tmp_lahir,tgl_lahir,kontrak,awal_kontrak,akhir_kontrak,foto,ket,status)VALUES('$id_karyawan','$id_jabatan','$nama','$jk','$alamat',
                            '$no_telp','$tmp_lahir','$tgl_lahir','3 Bulan','$awal_kontrak','$akhir_kontrak','$foto','Masih Dalam Masa Kontrak','Belum Diajukan')");

    echo "<script>alert('Berhasil menambah data'); window.location.href = '../pages/data_kar.php';</script>";
    }
       
}

?>
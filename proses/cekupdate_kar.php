<?php
session_start();
include '../database/connect.php';


$id_karyawan = $_POST['id_karyawan'];
$id_jabatan = $_POST['id_jabatan'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$tmp_lahir = $_POST['tmp_lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$awal_kontrak = $_POST['awal_kontrak'];
$akhir_kontrak = $_POST['akhir_kontrak'];

$masa_kontrak = strtotime($akhir_kontrak) - strtotime($awal_kontrak);


if(!$id_karyawan || !$id_jabatan || !$nama || !$jk || !$alamat ||
   !$no_telp || !$tmp_lahir || !$tgl_lahir || !$awal_kontrak || !$akhir_kontrak){
    
    echo "<script>alert ('Data tidak boleh kosong'); window.location='../pages/data_kar.php'</script>";
}else{
    if($_FILES['foto']['name'] != null ){
        $targetDir= "../images/";
        $targetFile=$targetDir . basename($_FILES["foto"]["name"]); 
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
        $foto = basename( $_FILES["foto"]["name"]);
        $sql = "UPDATE tb_karyawan SET id_jabatan = '$id_jabatan',nama='$nama',jk = '$jk', alamat ='$alamat',no_telp = '$no_telp',tmp_lahir = '$tmp_lahir',tgl_lahir = '$tgl_lahir',awal_kontrak = '$awal_kontrak', akhir_kontrak = '$akhir_kontrak',foto = '$foto' WHERE id_karyawan = '$id_karyawan' ";
        $sql = mysqli_query($mysqli, $sql);
   
        // echo "hello";
        echo "<script>alert ('Data Berhasil di ubah!'); window.location='http://localhost/pengangkatan/pages/data_kar.php?id=$id_karyawan'</script>";
    }else{
        $sql = "UPDATE tb_karyawan SET id_jabatan = '$id_jabatan',nama='$nama',jk = '$jk', alamat ='$alamat',no_telp = '$no_telp',tmp_lahir = '$tmp_lahir',tgl_lahir = '$tgl_lahir',awal_kontrak = '$awal_kontrak', akhir_kontrak = '$akhir_kontrak' WHERE id_karyawan = '$id_karyawan' ";
        $sql = mysqli_query($mysqli, $sql);
   
        // echo "hello";
        echo "<script>alert ('Data Berhasil di ubah!'); window.location='http://localhost/pengangkatan/pages/data_kar.php?id=$id_karyawan'</script>";
    }
         
}

?>
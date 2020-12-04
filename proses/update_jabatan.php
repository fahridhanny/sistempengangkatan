<?php 
 
include '../database/connect.php';

$id_jabatan = $_POST['id_jabatan'];
$nama_jabatan = $_POST['nama_jabatan'];
 
mysqli_query($mysqli,"UPDATE tb_jabatan SET nama_jabatan='$nama_jabatan' WHERE id_jabatan='$id_jabatan'");

echo "<script>alert ('Data berhasil diubah!'); window.location='../pages/data_jabatan.php'</script>";
?>
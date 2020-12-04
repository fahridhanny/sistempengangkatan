<?php 
include '../database/connect.php';
$id = $_GET['id'];
mysqli_query($mysqli,"DELETE FROM tb_karyawan WHERE id_karyawan='$id'");
 
echo "<script>window.location='../pages/data_kar.php'</script>";
?>
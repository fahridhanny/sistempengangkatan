<?php 
include '../database/connect.php';
$id = $_GET['id'];
$result = mysqli_query($mysqli,"DELETE FROM tb_jabatan WHERE id_jabatan='$id'");
 
echo "<script> window.location='../pages/data_jabatan.php'</script>";
?>
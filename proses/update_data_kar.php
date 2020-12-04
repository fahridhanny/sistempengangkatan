<?php 
 
include '../database/connect.php';

$id_pegawai = $_POST['id_pegawai'];
$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$notelp = $_POST['notelp'];
$email = $_POST['email'];
$awal_kon = $_POST['awal_kon'];
$akhir_kon = $_POST['akhir_kon'];
$status = $_POST['status'];


mysqli_query($mysqli,"UPDATE tb_pegawai SET nama='$nama', jabatan='$jabatan', jk='$jk', alamat='$alamat' 
                , no_telp='$notelp', email='$email', awal_kontrak='$awal_kon', akhir_kontrak='$akhir_kon' 
                , status='$status' WHERE id_pegawai='$id_pegawai'");

echo "<script>alert ('Data berhasil diubah!'); window.location='../pages/data_kar.php'</script>";
?>
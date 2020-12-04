<?php
include "../database/connect.php";

$id_karyawan = $_POST['id_karyawan'];
$jabatan = $_POST['jabatan']; 
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$tmp_lahir = $_POST['tmp_lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$kontrak = $_POST['kontrak'];
$awal_kontrak = $_POST['awal_kontrak'];
$akhir_kontrak = $_POST['akhir_kontrak'];
$status = "";

if(isset($_POST['ajukan'])){
    if(!$id_karyawan || !$jabatan || !$jk || !$alamat || !$no_telp || !$tmp_lahir || !$tgl_lahir || !$kontrak || !$awal_kontrak || !$akhir_kontrak){
        $status ="Belum Diajukan";
        echo "<script>alert ('Gagal Mengajukan, Data Tidak Boleh Kosong'); window.location='../pages/data_kar.php'</script>";
    }else{
        $status ="Diajukan";
        echo "<script>alert ('$id_karyawan $status Ke Manager'); window.location='../pages/data_kar.php'</script>";
    }
}

$query = "UPDATE tb_karyawan set status = '$status' where id_karyawan = '$id_karyawan'";

$result = mysqli_query($mysqli,$query);
?>
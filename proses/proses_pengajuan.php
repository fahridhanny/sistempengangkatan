<?php 
include "../database/connect.php";
$id_karyawan = $_POST['id_karyawan'];
$nama_karyawan = $_POST['nama'];
$keterangan = $_POST['ket'];
$status = "";

// $jabatan = $_POST['jabatan']; 
// $jk = $_POST['jk'];
// $alamat = $_POST['alamat'];
// $no_telp = $_POST['no_telp'];
// $tmp_lahir = $_POST['tmp_lahir'];
// $tgl_lahir = $_POST['tgl_lahir'];
// $kontrak = $_POST['kontrak'];
// $awal_kontrak = $_POST['awal_kontrak'];
// $akhir_kontrak = $_POST['akhir_kontrak'];

// if(isset($_POST['ajukan'])){
//     if(!$id_karyawan || !$jabatan || !$jk || !$alamat || !$no_telp || !$tmp_lahir || !$tgl_lahir || !$kontrak || !$awal_kontrak || !$akhir_kontrak){
//         $status ="Belum Diajukan";
//         echo "<script>alert ('Gagal Mengajukan, Data Tidak Boleh Kosong'); window.location='../pages/data_kar.php'</script>";
//     }else{
//         $status ="Diajukan";
//         echo "<script>alert ('$id_karyawan $status Ke Manager'); window.location='../pages/data_kar.php'</script>";
//     }
// }

// if(isset($_POST['Submit'])){   
//     if(!($_POST['status'])){
//         $status ="Diajukan";
//         echo "<script>alert ('Gagal Merubah Keterangan'); window.location='../pages/data_kar.php'</script>";
//     }else{
//         $status = $_POST['status'];
//         echo "<script>alert ('Karyawan Kontrak Bernama $id_karyawan di $status'); window.location='../pages/data_kar.php'</script>";
//     }
// }


if(isset($_POST['submit'])){
    $status ="Diajukan";
    echo "<script>alert ('$nama_karyawan $status Ke Manager'); window.location='../pages/data_kar.php'</script>";
}else{
    if(!($_POST['status'])){
        $status ="Diajukan";
        echo "<script>alert ('Gagal Merubah Keterangan'); window.location='../pages/data_kar.php'</script>";
    }else{
        if($_POST['status'] == 'Proses Penilaian'){
            $status = $_POST['status'];
            echo "<script>alert ('Karyawan Kontrak Bernama $nama_karyawan di $status'); window.location='../pages/tambah_penilaian.php'</script>";
        }else{
            $status = $_POST['status'];
            echo "<script>alert ('Karyawan Kontrak Bernama $nama_karyawan di $status'); window.location='../pages/data_kar.php'</script>";
        }
    }
}

$query = "UPDATE tb_karyawan set status = '$status' where id_karyawan = '$id_karyawan'";

$result = mysqli_query($mysqli,$query);

// function update_status($status_kontrak){

//     include "../database/connect.php";
//     $id_karyawan = $_POST['id_karyawan'];
//     $nama_karyawan = $_POST['nama'];
//     $status = "";

//     if(isset($_POST['submit'])){
//         $status ="Diajukan";
//         echo "<script>alert ('$nama_karyawan $status Ke Manager'); window.location='../pages/data_kar.php'</script>";
//     }else{
//         if(!($_POST['status'])){
//             $status ="Diajukan";
//             echo "<script>alert ('Gagal Merubah Keterangan'); window.location='../pages/data_kar.php'</script>";
//         }else{
//             $status = $_POST['status'];
//             echo "<script>alert ('Karyawan Kontrak Bernama $nama_karyawan di $status'); window.location='../pages/data_kar.php'</script>";
//         }
//     }

//     if($status_kontrak == "Sudah Habis Masa Kontrak"){
//         $status = $status_kontrak;
//     }elseif($status_kontrak == "Masa Kontrak Mau Habis"){
//         $status = $status_kontrak;
//     }else{
//         $status = $status_kontrak;
//     }
    
//     $query = "UPDATE tb_karyawan set status = '$status' where id_karyawan = '$id_karyawan'";
    
//     $result = mysqli_query($mysqli,$query);
    
// }

?>
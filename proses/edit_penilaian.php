<?php

include '../database/connect.php';
$id_penilaian = $_POST['id_penilaian'];
$absensi = floatval($_POST['absensi']);
$wawancara = floatval($_POST['wawancara']);
$psikotes = floatval($_POST['psikotes']);
$skill = floatval($_POST['skill']);

$sqljumlah ="SELECT SUM(bobot) FROM tb_kriteria";
$queryjumlah= mysqli_query($mysqli,$sqljumlah);
$jumlah0=mysqli_fetch_array($queryjumlah);
$jumlah = $jumlah0[0];

// bobot
$sqlkriteria ="SELECT bobot FROM tb_kriteria";
$querykriteria = mysqli_query($mysqli, $sqlkriteria);
$bobot=[];
while ($bariskriteria= mysqli_fetch_array($querykriteria)) {
    $bobot[]=$bariskriteria['bobot'];
}

$minabsensi = 10;
$maxabsensi = 100;

$minwawancara = 10;
$maxwawancara = 100;

$minpsikotes = 10;
$maxpsikotes = 100;

$minskill = 10;
$maxskill = 100;

    $nilai_absensi = (($absensi - $minabsensi) / ($maxabsensi - $minabsensi) * 100);
    $nilai_wawancara = (($wawancara - $minwawancara) / ($maxwawancara - $minwawancara) * 100);
    $nilai_psikotes = (($psikotes - $minpsikotes) / ($maxpsikotes - $minpsikotes) * 100);
    $nilai_skill = (($skill - $minskill) / ($maxskill - $minskill) * 100);
    //hasil utility * kritetia normalisasi 
    $nabsensi = $nilai_absensi*($bobot[0]/$jumlah);
    $nwawancara = $nilai_wawancara*($bobot[1]/$jumlah);
    $npsikotes = $nilai_psikotes*($bobot[2]/$jumlah);
    $nskill = $nilai_skill*($bobot[3]/$jumlah);
    $nilaievaluasi = $nabsensi + $nwawancara + $npsikotes + $nskill;
    $nilai = round($nilaievaluasi,2);
    
if ($nilaievaluasi >= 70) {
    $hasil_rekomendasi = "Diangkat";
}else{
    $hasil_rekomendasi = "Tidak Diangkat";
}

if(!$absensi || !$wawancara || !$psikotes || !$skill){
    echo "<script>alert('Data tidak boleh kosong'); window.location.href = '../pages/data_penilaian.php';</script>";
}else{
    $update = mysqli_query($mysqli,"UPDATE tb_penilaian SET absensi = '$absensi', wawancara = '$wawancara',
           psikotes = '$psikotes', skill = '$skill', hasil = '$nilai', hasil_rekomendasi = '$hasil_rekomendasi'  WHERE id_penilaian = '$id_penilaian'");
    echo "<script>alert('Berhasil mengubah nilai'); window.location.href = '../pages/data_penilaian.php';</script>";                                          
}

?>
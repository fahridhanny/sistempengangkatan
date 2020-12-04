<?php
include '../database/connect.php';
session_start();
$jabatan = $_SESSION['jabatan'];

$laporan = $_POST['rekomendasi'];

$akhirkontrak = $_POST['akhirkontrak'];

if(!$laporan || !$akhirkontrak ){
    echo "<script>alert ('Silahkan pilih tanggal dan rekomendasi yang ingin dicetak'); window.location='../pages/data_penilaian.php'</script>";
}else{
    if($_SESSION['akses']=="hrd"){
        $query = "SELECT * FROM tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan where hasil_rekomendasi = '$laporan' AND tb_karyawan.akhir_kontrak = '$akhirkontrak' order by id_penilaian DESC";
    }else{
        $query = "SELECT * FROM tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan where tb_karyawan.id_jabatan = $jabatan AND hasil_rekomendasi = '$laporan' AND tb_karyawan.akhir_kontrak = '$akhirkontrak'";
    }
    $result = mysqli_query($mysqli,$query);
}


if (isset($_SESSION['status']) != 'login') {
    echo "<script>alert ('Anda Harus Login'); window.location='login.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pengangkatan Karyawan Kontrak</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style type="text/css">
   .normal { font-weight: normal; }
   .bold { font-weight: bold; }
   .bolder { font-weight: bolder; }
   .lighter { font-weight: lighter; }
   .number100 { font-weight: 100; }
   .number200 { font-weight: 200; }
   .number300 { font-weight: 300; }
   .number400 { font-weight: 400; }
   .number500 { font-weight: 500; }
   .number600 { font-weight: 600; }
   .number700 { font-weight: 700; }
   .number800 { font-weight: 800; }
   .number900 { font-weight: 900; }
    </style>

</head>

<body style="background-color: #fff;">

<center><img src="..\logo\Logo Primaloka2.png" alt=""></center>
    <center><h1>PT Primaloka Djawharha Prakarsa</h1></center>
    <br>
    <center><p class="number600">Office 8 Building Level 18-A Sudirman Central Business District, Jl. Jend. Sudirman No.Kav. 52–53,</p></center>
    <center><p class="number600"> RT.5/RW.3, Senayan, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12190</p></center>
    <center><p class="number600">Telp : (021) 29608121</p></center>
    <center><h5 class="page-header"></h5></center>
    <center><h3>Hasil Penilaian</h3></center>
    <hr class="style2">
    <center><p class="number600">Tanggal : <?php echo date('d-m-Y', strtotime($akhirkontrak));?>, Penilain Rekomendasi Dari : <?php echo $_SESSION['nama'];?></p></center>
    <br>
    <br>


    <div id="wrapper">

            <div class="container-fluid">
                <div class="row">
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                                
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Id Karyawan</th>
                                                <th>Nama</th>
                                                <th>Absensi</th>
                                                <th>Wawancara</th>
                                                <th>Psikotes</th>
                                                <th>Skill</th>
                                                <th>Hasil</th>
                                                <th>Rekomendasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $no = 1;

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
                                             //var_dump($bobot);die();
                                             //end bobot
                                             $minabsensi = 10;
                                             $maxabsensi = 100;

                                             $minwawancara = 10;
                                             $maxwawancara = 100;

                                             $minpsikotes = 10;
                                             $maxpsikotes = 100;

                                             $minskill = 10;
                                             $maxskill = 100;



                                             while($fetch = mysqli_fetch_array($result)){
                                                //mendapatkan nilai utility
                                                $nilai_absensi = (($fetch['absensi'] - $minabsensi) / ($maxabsensi - $minabsensi) * 100);
                                                $nilai_wawancara = (($fetch['wawancara'] - $minwawancara) / ($maxwawancara - $minwawancara) * 100);
                                                $nilai_psikotes = (($fetch['psikotes'] - $minpsikotes) / ($maxpsikotes - $minpsikotes) * 100);
                                                $nilai_skill = (($fetch['skill'] - $minskill) / ($maxskill - $minskill) * 100);
                                                //hasil utility * kritetia normalisasi 
                                                $nabsensi = $nilai_absensi*($bobot[0]/$jumlah);
                                                $nwawancara = $nilai_wawancara*($bobot[1]/$jumlah);
                                                $npsikotes = $nilai_psikotes*($bobot[2]/$jumlah);
                                                $nskill = $nilai_skill*($bobot[3]/$jumlah);
                                                $nilaievaluasi = $nabsensi + $nwawancara + $npsikotes + $nskill;

                                                if ($nilaievaluasi == 100) {
                                                    $hasil_review = "Sangat Baik";
                                                }else if ($nilaievaluasi >= 80) {
                                                    $hasil_review = "Baik";
                                                }else if ($nilaievaluasi >= 60) {
                                                    $hasil_review = "Cukup";
                                                }else if ($nilaievaluasi >= 40) {
                                                    $hasil_review = "Kurang";
                                                }else{
                                                    $hasil_review = "Sangat Kurang";
                                                }

                                                echo "<tr class='even gradeA'>";
                                                echo "<td>".$no++."</td>";
                                                echo "<td>".$fetch['id_karyawan']."</td>";
                                                echo "<td>".$fetch['nama']."</td>";
                                                echo "<td>".$fetch['absensi']."</td>";
                                                echo "<td>".$fetch['wawancara']."</td>";
                                                echo "<td>".$fetch['psikotes']."</td>";
                                                echo "<td>".$fetch['skill']."</td>";
                                                //echo "<td>".round($nilaievaluasi,2)."</td>";
                                                echo "<td>".$fetch['hasil']."</td>";
                                                echo "<td>".$fetch['hasil_rekomendasi']."</td>";
                                                 
                                             }


                                            ?>

                                        </tbody>
                                    </table>
        
                                <!-- /.table-responsive -->
                            
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../js/dataTables/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

    <script>
        window.addEventListener("load",window.print());
    </script>

</body>

</html>
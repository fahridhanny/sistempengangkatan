<?php
include '../database/connect.php';
session_start();

if (isset($_SESSION['status']) != 'login') {
    echo "<script>alert ('Anda Harus Login'); window.location='login.php'</script>";
}
if (isset($_SESSION['status']) == 'login'){
    $jabatan = $_SESSION['jabatan'];

    if($_SESSION['akses']=="hrd"){
        $query = "SELECT * FROM tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan order by id_penilaian DESC";
    }else{
        $query = "SELECT * FROM tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan where tb_karyawan.id_jabatan = $jabatan";
    }

    $result = mysqli_query($mysqli,$query);
    $result02 = mysqli_query($mysqli,$query);
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

</head>

<body style="background-color: #343a40;">

    <div id="wrapper">

        <!-- Navigation -->
        <?php include '../view/navigation.php'; ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hasil Penilaian</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-table fa-fw"></i>
                                Hasil Penilaian
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
      
                                <a href="tambah_penilaian.php" class="btn btn-primary">
                                <i class="fa fa-fw" aria-hidden="true" title="Copy to use pencil-square-o">&#xf044</i>Nilai</a>

                                <a class="btn btn-primary" onClick="Cetak" data-toggle='modal' data-target='#ModalDelete'>
                                    <i class="fa fa-fw" aria-hidden="true" title="Copy to use print">&#xf02f</i>Cetak Laporan</a>
                                <br>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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

                                                <?php if($_SESSION['akses']=="hrd"){ ?>
                                                <th>Aksi</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $no = 1;

                                            //  $sqljumlah ="SELECT SUM(bobot) FROM tb_kriteria";
                                            //  $queryjumlah= mysqli_query($mysqli,$sqljumlah);
                                            //  $jumlah0=mysqli_fetch_array($queryjumlah);
                                            //  $jumlah = $jumlah0[0];
                                             
                                            //  // bobot
                                            //  $sqlkriteria ="SELECT bobot FROM tb_kriteria";
                                            //  $querykriteria = mysqli_query($mysqli, $sqlkriteria);
                                            //  $bobot=[];
                                            //  while ($bariskriteria= mysqli_fetch_array($querykriteria)) {
                                            //      $bobot[]=$bariskriteria['bobot'];
                                            //  }

                                             $minabsensi = 10;
                                             $maxabsensi = 100;

                                             $minwawancara = 10;
                                             $maxwawancara = 100;

                                             $minpsikotes = 10;
                                             $maxpsikotes = 100;

                                             $minskill = 10;
                                             $maxskill = 100;


                                             while($fetch = mysqli_fetch_array($result)){
                                                if($fetch['status'] == 'Sudah Dinilai'){   
                                                //mendapatkan nilai utility
                                                // $nilai_absensi = (($fetch['absensi'] - $minabsensi) / ($maxabsensi - $minabsensi) * 100);
                                                // $nilai_wawancara = (($fetch['wawancara'] - $minwawancara) / ($maxwawancara - $minwawancara) * 100);
                                                // $nilai_psikotes = (($fetch['psikotes'] - $minpsikotes) / ($maxpsikotes - $minpsikotes) * 100);
                                                // $nilai_skill = (($fetch['skill'] - $minskill) / ($maxskill - $minskill) * 100);
                                                //hasil utility * kritetia normalisasi 
                                                // $nabsensi = $nilai_absensi*($bobot[0]/$jumlah);
                                                // $nwawancara = $nilai_wawancara*($bobot[1]/$jumlah);
                                                // $npsikotes = $nilai_psikotes*($bobot[2]/$jumlah);
                                                // $nskill = $nilai_skill*($bobot[3]/$jumlah);
                                                // $nilaievaluasi = $nabsensi + $nwawancara + $npsikotes + $nskill;    
                                                if ($fetch['hasil_rekomendasi'] == "Diangkat") {
                                                     $ket = "<td><span class='badge' style='background-color:#28a745; color:#fff;'>
                                                     Diangkat</span></td>";
                                                }else{
                                                     $ket = "<td><span class='badge' style='background-color:#ec0e0e; color:#fff;'>
                                                     Tidak Diangkat</span></td>";
                                                }
                                                
                                                // if ($nilaievaluasi == 100) {
                                                //     $hasil_review = "Sangat Baik";
                                                // }else if ($nilaievaluasi >= 80) {
                                                //     $hasil_review = "Baik";
                                                // }else if ($nilaievaluasi >= 60) {
                                                //     $hasil_review = "Cukup";
                                                // }else if ($nilaievaluasi >= 40) {
                                                //     $hasil_review = "Kurang";
                                                // }else{
                                                //     $hasil_review = "Sangat Kurang";
                                                // }

                                                 echo "<tr class='even gradeA'>";
                                                 echo "<td>".$no++."</td>";
                                                 echo "<td>".$fetch['id_karyawan']."</td>";
                                                 echo "<td>".$fetch['nama']."</td>";
                                                 echo "<td>".$fetch['absensi']."</td>";
                                                 echo "<td>".$fetch['wawancara']."</td>";
                                                 echo "<td>".$fetch['psikotes']."</td>";
                                                 echo "<td>".$fetch['skill']."</td>";
                                                 echo "<td>".$fetch['hasil']."</td>";
                                                 echo $ket;

                                                 if($_SESSION['akses']=="hrd"){
                                                 echo "<td style='text-align:center;'><a class='btn btn-primary' href='view_penilaian.php?id=$fetch[id_penilaian]'>
                                                 <i class='fa fa-fw' aria-hidden='true' title='Copy to use eye'>&#xf06e</i></a></td>";
                                                 }
                                                 echo "</tr>";
                                                }
                                             }
                        
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                                <?php if($_SESSION['akses']=="hrd"){ ?>
                                <a href="perhitungan.php" class="btn btn-success">Perhitungan SMART</a>
                                <?php } ?>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    <!-- Modal Cetak Laporan Nilai -->
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Cetak Laporan</h4>
                </button>
            </div>
            <div class="modal-body">
                <form action="../proses/cetak_laporan.php" method="post">
                
                    <label for="">Silahkan </label>
                    <select name="akhirkontrak">
                        <option value="">--- Pilih Tanggal ---</option>
                        <?php if(mysqli_num_rows($result02) > 0) { ?>
                            <?php while($rowtanggal = mysqli_fetch_array($result02)) { ?>
                                <option value='<?= $rowtanggal['akhir_kontrak'] ?>'><?php echo date('d-m-Y', strtotime($rowtanggal['akhir_kontrak'])); ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>

                    <select name="rekomendasi">
                        <option value="">--Pilih Rekomendasi--</option>
                        <option value="Diangkat">Diangkat</option>
                        <option value="Tidak Diangkat">Tidak Diangkat</option>
                    </select>
                    <input type="submit" class="btn btn-success" name="submit" value="Cetak">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

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

</body>

</html>
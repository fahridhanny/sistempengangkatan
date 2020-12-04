<?php
include '../database/connect.php';
include '../database/connect2.php';
session_start();
$jabatan = $_SESSION['jabatan'];
// $result = mysqli_query($mysqli, "SELECT * FROM tb_pengangkatan join tb_karyawan on tb_karyawan.id_karyawan=tb_pengangkatan.id_karyawan 
//                             join tb_penilaian on tb_penilaian.id_penilaian=tb_pengangkatan.id_pengangkatan 
//                             ORDER BY id_pengangkatan DESC");

if($_SESSION['akses']=="hrd"){
    $query = "SELECT * FROM tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan order by id_penilaian DESC";
  }else{
    $query = "SELECT * FROM tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan where tb_karyawan.id_jabatan = $jabatan";
  }
$result = mysqli_query($mysqli,$query);

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

</head>

<body>

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
                                Data Hasil Penilaian
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php if ($_SESSION['akses'] == "hrd") { ?>
                                    <a href="tambah_penilaian.php" class="btn btn-primary">
                                        <i class="fa fa-fw" aria-hidden="true" title="Copy to use pencil-square-o">&#xf044</i>Nilai</a>
                                <?php } ?>
                                <a href="../proses/cetak_laporan.php" class="btn btn-primary">
                                    <i class="fa fa-fw" aria-hidden="true" title="Copy to use print">&#xf02f</i>Cetak Laporan</a>
                                <br>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Id Absensi</th>
                                                <th>Kriteria</th>
                                                <th>Nilai</th>
                                                <th>Bobot</th>
                                                <th>Range</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $no = 1;

                                             // bobot
                                             $sqlkriteria ="SELECT * FROM kriteria_absensi";
                                             $querykriteria = mysqli_query($connect, $sqlkriteria);
                                             while ($bariskriteria= mysqli_fetch_array($querykriteria)) {
                                                 $baris[] = $bariskriteria['nilai'];
                                             }
                                             $min = min($baris);
                                             $max = max($baris);
                                             //var_dump($querykriteria);die();
                                             //end bobot


                                             $data ="SELECT * FROM kriteria_absensi";
                                             $data1 = mysqli_query($connect, $data);
                                             while($fetch = mysqli_fetch_array($data1)){

                                                $nilaievaluasi = $fetch['nilai'] * (($fetch['nilai'] - intval($min)) / (intval($max) - intval($min)));

                                                 echo "<tr class='even gradeA'>";
                                                 echo "<td>".$fetch['id_absensi']."</td>";
                                                 echo "<td>".$fetch['kriteria']."</td>";
                                                 echo "<td>".$fetch['nilai']."</td>";
                                                 echo "<td>".$fetch['bobot']."</td>";
                                                 echo "<td>".round($nilaievaluasi,2)."</td>";
                                                 //echo "<td>".$ket."</td>";
                                                 echo "</tr>";
                                                 
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
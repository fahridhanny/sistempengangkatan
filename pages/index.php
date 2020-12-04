<?php
  include '../database/connect.php' ;
  session_start();
    if(isset($_SESSION['status']) != 'login'){
        echo "<script>alert ('Anda Harus Login'); window.location='login.php'</script>";
    }
    $jabatan = $_SESSION['jabatan'];

    //salah di jumlah dashboard buat manager
    if($_SESSION['akses']=="hrd"){

        $query="SELECT * from tb_karyawan";
        $result = mysqli_query($mysqli,$query);
        $jumlah_kar= mysqli_num_rows($result);


        $query01="SELECT * from tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan where status = 'Sudah Dinilai'";
        $result01 = mysqli_query($mysqli,$query01);
        $jumlah_penilaian= mysqli_num_rows($result01);
    
    }else{

        $query = "SELECT * FROM tb_karyawan join tb_jabatan ON tb_jabatan.id_jabatan=tb_karyawan.id_jabatan where tb_karyawan.id_jabatan = $jabatan AND status != 'belum diajukan'";
        $result = mysqli_query($mysqli,$query);
        $jumlah_kar= mysqli_num_rows($result);

        $query01 = "SELECT * FROM tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan where tb_karyawan.id_jabatan = $jabatan AND status = 'Sudah Dinilai'";
        $result01 = mysqli_query($mysqli,$query01);
        $jumlah_penilaian= mysqli_num_rows($result01);

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

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body style="background-color: #343a40;">

        <div id="wrapper">

            <!-- Navigation -->
            <?php include '../view/navigation.php' ; ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Dashboard</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-tasks fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?= $jumlah_kar?></div>
                                            <?php if($_SESSION['akses']=="hrd"){ ?>
                                            <div>Data Karyawan kontrak</div>
                                            <?php } ?>
                                            <?php if($_SESSION['akses']!="hrd"){ ?>
                                            <div>Karyawan kontrak Diajukan</div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <a href="data_kar.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-tasks fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?= $jumlah_penilaian ?></div>
                                            <?php if($_SESSION['akses']=="hrd"){ ?>
                                            <div>Penilaian</div>
                                            <?php } ?>
                                            <?php if($_SESSION['akses']!="hrd"){ ?>
                                            <div>Hasil Penilaian</div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <a href="data_penilaian.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-tasks fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?= $jumlah_jabatan ?></div>
                                            <div>Jabatan</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="data_jabatan.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-support fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">13</div>
                                            <div>Support Tickets!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div> -->
                    </div>
                    <!-- /.row -->
                    
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

        <!-- Morris Charts JavaScript -->
        <script src="../js/raphael.min.js"></script>
        <script src="../js/morris.min.js"></script>
        <script src="../js/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

    </body>
</html>

<?php
  include '../database/connect.php' ;
  session_start();

    if(isset($_SESSION['status']) != 'login'){
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

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <link href="../css/kalendercss.css" rel="stylesheet">

        <link href="../css/kalender2css.css" rel="stylesheet">

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
                            <h1 class="page-header">Tambah Karyawan</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Basic Form Elements
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">

                                        <?php 
                                        include '../database/connect.php' ;
                                    	$id = $_GET['id'];
                                    	$query_mysql = mysqli_query($mysqli,"SELECT * FROM tb_jabatan WHERE id_jabatan='$id'");

                                    	while($data = mysqli_fetch_array($query_mysql)){
                                        ?>
                                            <form role="form" action="../proses/update_jabatan.php" method="POST">
                                            
                                                <?php 
                                                if(isset($_GET['error']) == 'alert'){
                                                    echo "<div class='alert alert-danger'>
                                                    Data Harus Diisi</div>";
                                                    unset($_GET['alert']);
                                                }
                                                else if(isset($_GET['sukses']) == 'alert'){
                                                    echo "<div class='alert alert-info'>
                                                    Berhasil Menambah Data</div>";
                                                    unset($_GET['alert']);
                                                 }
                                                ?>
                                                <input class="form-control" type="hidden" name="id_jabatan" value="<?php echo $data['id_jabatan'] ?>">

                                                <div class="form-group">
                                                    <label>Masukkan Jabatan</label>
                                                    <input class="form-control" type="text" name="nama_jabatan" value="<?php echo $data['nama_jabatan'] ?>">
                                                </div>
                                                
                                                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                                            </form>

                                            <?php } ?>

                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
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

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <script src="../js/jquerykalender.js"></script>
        <script src="../js/jquerykalender2.js"></script>

        

    </body>
</html>

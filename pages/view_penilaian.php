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
                            <h1 class="page-header">Penilaian Karyawan Kontrak</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                    
                    <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <i class="fa fa-table fa-fw"></i>
                                    Penilaian Karyawan Kontrak
                                </div>
                                <!-- /.panel-heading -->

                                <div class="panel-body">
                                    <div class="table">
                                        <?php 
                                            include '../database/connect.php' ;
                                    	    $id = $_GET['id'];
                                    	    $query_mysql = mysqli_query($mysqli,"SELECT * FROM tb_penilaian join tb_karyawan on tb_karyawan.id_karyawan=tb_penilaian.id_karyawan WHERE id_penilaian='$id'");

                                    	    while($data = mysqli_fetch_array($query_mysql)){
                                                
                                            ?>
                                        <table class="table">
                                            <!-- <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Username</th>
                                                </tr>
                                            </thead> -->
                                            <form action="../proses/edit_penilaian.php" method="post">
                                            <input type="hidden" name="id_penilaian" value="<?php echo $data['id_penilaian'] ?>">
                                            <tbody>
                                                <tr>
                                                    <td width="150">Id Karyawan</td>
                                                    <td width="50">:</td>
                                                    <td><?= $data['id_karyawan']; ?></td>
                                                    <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan']?>">
                                                </tr>
                                                <tr>
                                                    <td width="150">Nama Karyawan</td>
                                                    <td width="50">:</td>
                                                    <td><?= $data['nama'] ?></td>
                                                    <input type="hidden" name="nama" value="<?= $data['nama']?>">
                                                </tr>
                                                <tr>
                                                    <td width="150">Wawancara</td>
                                                    <td width="50">:</td>
                                                    <td><input class="form-control" type="number" name="wawancara" min="10" max="100" value="<?= $data['wawancara'] ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Skill</td>
                                                    <td width="50">:</td>
                                                    <td><input class="form-control" type="number" name="skill" min="10" max="100" value="<?= $data['skill'] ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Absensi</td>
                                                    <td width="50">:</td>
                                                    <td><input class="form-control" type="number" name="absensi" min="10" max="100" value="<?= $data['absensi'] ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Psikotes</td>
                                                    <td width="50">:</td>
                                                    <td><input class="form-control" type="number" name="psikotes" min="10" max="100" value="<?= $data['psikotes'] ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type='submit' class='btn btn-success' name='Submit'>Simpan</button>
                                        </form>
                                        <?php } ?>
                                    </div>

                                    <!-- /.table-responsive -->
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



    </body>
</html>

<?php
  include '../database/connect.php' ;
  include '../database/functions.php' ;
  session_start();
    
    if(isset($_SESSION['status']) != 'login'){
        echo "<script>alert ('Anda Harus Login'); window.location='login.php'</script>";
    }
    if (isset($_SESSION['status']) == 'login'){
        $idAdmin = $_SESSION['id_admin'];
    }
    $data = readData("SELECT * from tb_admin where id_admin = '$idAdmin'");
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
                            <h1 class="page-header">Profile</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                    
                    <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <i class="fa fa-table fa-fw"></i>
                                    Profile
                                </div>
                                <!-- /.panel-heading -->

                                <div class="panel-body">
                                    <div class="table">
                                        <table class="table">
                                            <!-- <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Username</th>
                                                </tr>
                                            </thead> -->
                                            <tbody>
                                                <?php foreach($data as $row){ ?>
                                                <tr>
                                                    <td width="150">Nama</td>
                                                    <td width="50">:</td>
                                                    <td><?= $row['nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Jenis Kelamin</td>
                                                    <td width="50">:</td>
                                                    <td><?= $row['jk'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">No Hp</td>
                                                    <td width="50">:</td>
                                                    <td><?= $row['no_hp'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Alamat</td>
                                                    <td width="50">:</td>
                                                    <td><?= $row['alamat'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Email</td>
                                                    <td width="50">:</td>
                                                    <td><?= $row['email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Username</td>
                                                    <td width="50">:</td>
                                                    <td><?= $row['username'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Password</td>
                                                    <td width="50">:</td>
                                                    <td>********</td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Akses</td>
                                                    <td width="50">:</td>
                                                    <td><?= $row['akses'] ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <form action="edit_profile.php" method="post">

                                        <button type="submit" class="btn btn-primary" name="submit">Edit Profile</button>
                                        </form>
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

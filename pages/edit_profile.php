<?php
  include '../database/connect.php' ;
  include '../database/functions.php' ;
  session_start();

  $idAdmin = $_SESSION['id_admin'];
  $result = mysqli_query($mysqli,"SELECT * FROM tb_jabatan");
    if(isset($_SESSION['status']) != 'login'){
        echo "<script>alert ('Anda Harus Login'); window.location='login.php'</script>";
    }
  $data = readData("SELECT * FROM tb_admin WHERE id_admin = '$idAdmin'");

    
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
                            <h1 class="page-header">Edit Profile</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <i class="fa fa-table fa-fw"></i>
                                    Edit Profile
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <form role="form" action="../proses/update_profile.php" method="POST">


                                                <?php foreach($data as $row){
                                                        $jk = $row['jk'];
                                                    ?>
                                                    <input type="hidden" name="id_admin" value="<?= $row['id_admin']; ?>">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input class="form-control" type="text" name="nama" value="<?= $row['nama']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="form-control" name="jk">
                                                        <option value="Laki - laki" <?php if($jk=="Laki - laki"){echo "selected";} ?> >Laki - laki</option>
                                                        <option value="Perempuan" <?php if($jk=="Perempuan"){echo "selected";} ?> >Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" type ="text" rows="3"  name="alamat"><?= $row['alamat'] ?> </textarea>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label>No Hp</label>
                                                    <input class="form-control" type="number" name="no_hp" value="<?= $row['no_hp']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" type="text" name="email" value="<?= $row['email'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control" type="text" name="username" value="<?= $row['username'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" name="password" value="<?= $row['password'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Akses</label>
                                                    <input class="form-control" type="text" disabled name="akses" value="<?= $row['akses'] ?>">
                                                </div>
                                                <br>
                                                <br>
                                                <button type="submit"  class="btn btn-success" name="submit">Simpan</button>
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

        <script>
        $(function(){
            index = <?= json_encode($indexJabatan);?>;
            console.log(index);
            $("#jabatan").prop('selectedIndex',index-1);

           
        });
        </script>
    </body>
</html>

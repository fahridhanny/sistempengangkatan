<?php
  include '../database/connect.php' ;
  session_start();
  $where;
  if($_SESSION['akses']=="manager_pemasaran"){
    $where = 2;
  }else if($_SESSION['akses']=="manager_keuangan"){
      $where = 1;
  }elseif($_SESSION['akses']=="manager_administrasi"){
      $where= 3;
  }
  
  if($_SESSION['akses']=="hrd"){
    $query = "SELECT * FROM tb_karyawan join tb_jabatan ON tb_jabatan.id_jabatan=tb_karyawan.id_jabatan order by id_karyawan DESC";
  }else{
    $query = "SELECT * FROM tb_karyawan join tb_jabatan ON tb_jabatan.id_jabatan=tb_karyawan.id_jabatan where tb_karyawan.id_jabatan =$where order by id_karyawan DESC";
  }


  
    $result = mysqli_query($mysqli,$query);
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
            <?php include '../view/navigation.php' ; ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Data Karyawan Kontrak</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    DataTables Advanced Tables
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID Karyawan</th>
                                                    <th>Jabatan</th>
                                                    <th>Nama</th>
                                                    <th>Awal Kontrak</th>
                                                    <th>Akhir Kontrak</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 1;
                                                while($fetch = mysqli_fetch_array($result)){
                                                    echo "<tr class='even gradeA'>";
                                                    echo "<td>".$no++."</td>";
                                                    echo "<td>".$fetch['id_karyawan']."</td>";
                                                    echo "<td>".$fetch['nama_jabatan']."</td>";
                                                    echo "<td>".$fetch['nama']."</td>";
                                                    echo "<td>".$fetch['awal_kontrak']."</td>";
                                                    echo "<td>".$fetch['akhir_kontrak']."</td>";
                                                    echo "<td><a class='btn btn-primary' href='tambah_penilaian.php'>Nilai</a></td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                                
                                            </tbody>
                                        </table>
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

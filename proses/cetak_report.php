<?php
  include '../database/connect.php' ;
  include '../database/functions.php' ;
  session_start();
  $where;
  $jabatan = $_SESSION['jabatan'];
//   $aksesUser = $_SESSION['akses'];
//   if($_SESSION['akses']=="manager_pemasaran"){
//     $where = 2;
//   }else if($_SESSION['akses']=="manager_keuangan"){
//       $where = 1;
//   }elseif($_SESSION['akses']=="manager_administrasi"){
//       $where= 3;    
//   }
  
  if($_SESSION['akses']=="hrd"){
    $query = "SELECT * FROM tb_karyawan join tb_jabatan ON tb_jabatan.id_jabatan=tb_karyawan.id_jabatan order by id_karyawan DESC";
  }else{
    $query = "SELECT * FROM tb_karyawan join tb_jabatan ON tb_jabatan.id_jabatan=tb_karyawan.id_jabatan where tb_karyawan.id_jabatan = $jabatan AND status != 'belum diajukan'";
  }
   // var_dump($query);die;
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
    <center><h3>Data Karyawan Kontrak</h3></center>
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
                                <!-- /.panel-heading -->
                        
                        <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Karyawan</th>
                                <th>Jabatan</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Kontrak</th>
                                <th>Awal Kontrak</th>
                                <th>Akhir Kontrak</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no = 1;
                            while($fetch = mysqli_fetch_array($result)){
                                $waktu_berjalan = date("d-m-Y");
                                $masa_kontrak = strtotime($fetch['akhir_kontrak']) - strtotime($waktu_berjalan); 

                                echo "<tr class='even gradeA'>";
                                echo "<td>".$no++."</td>";
                                echo "<td>".$fetch['id_karyawan']."</td>";
                                echo "<td>".$fetch['nama_jabatan']."</td>";
                                echo "<td>".$fetch['nama']."</td>";
                                echo "<td>".$fetch['jk']."</td>";
                                echo "<td>".$fetch['kontrak']."</td>";
                                echo "<td>".$fetch['awal_kontrak']."</td>";
                                
                                if($masa_kontrak/(24*60*60)<=1){
                                    echo "<td>".$fetch['akhir_kontrak']."</td>";
                                }
                                else if($masa_kontrak/(24*60*60)<15){
                                    echo "<td>".$fetch['akhir_kontrak']."</td>";
                                }
                                else{
                                echo "<td>".$fetch['akhir_kontrak']."</td>";
                                }
                                
                                echo "<td>".$fetch['ket']."</td>";

                                
                            }
                        ?>
                            
                        </tbody>
                    </table>
                </div>
                                    <!-- /.table-responsive -->
                                    
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    

                </div>
                <!-- /.container-fluid -->
            <!-- /#page-wrapper -->

        </div>


        
                <!-- /.table-responsive -->
            
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

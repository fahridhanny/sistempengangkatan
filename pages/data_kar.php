<?php
  include '../database/connect.php' ;
  include '../database/functions.php' ;
  session_start();
  $where;
  
//   $aksesUser = $_SESSION['akses'];
//   if($_SESSION['akses']=="manager_pemasaran"){
//     $where = 2;
//   }else if($_SESSION['akses']=="manager_keuangan"){
//       $where = 1;
//   }elseif($_SESSION['akses']=="manager_administrasi"){
//       $where= 3;    
//   }

   // var_dump($query);die;
    if(isset($_SESSION['status']) != 'login'){
        echo "<script>alert ('Anda Harus Login'); window.location='login.php'</script>";
    }
    if (isset($_SESSION['status']) == 'login'){
        $jabatan = $_SESSION['jabatan'];

        if($_SESSION['akses']=="hrd"){
            $query = "SELECT * FROM tb_karyawan join tb_jabatan ON tb_jabatan.id_jabatan=tb_karyawan.id_jabatan order by tb_karyawan.id_jabatan  DESC";
        }else{
            $query = "SELECT * FROM tb_karyawan join tb_jabatan ON tb_jabatan.id_jabatan=tb_karyawan.id_jabatan where tb_karyawan.id_jabatan = $jabatan AND status != 'Belum Diajukan'";
        }
        $result = mysqli_query($mysqli,$query);
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
                                <i class="fa fa-table fa-fw"></i>
                                    Data Karyawan Kontrak
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                
                                <?php if($_SESSION['akses']=="hrd"){?>
                                    <a href="tambah_kar.php" class="btn btn-primary">
                                    <i class="fa fa-fw" aria-hidden="true" title="Copy to use plus-square-o">&#xf196</i>Tambah Karyawan Kontrak</a>
                                <?php }?>
                                
                                <a href="../proses/cetak_report.php" class="btn btn-primary">
                                <i class="fa fa-fw" aria-hidden="true" title="Copy to use print">&#xf02f</i>Cetak Report</a>

                                <br>
                                </br>
                                
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                                                    <!-- <th>Selisih Kontrak</th> -->
                                                    <th style="text-align:center;">Status</th>

                                                    <?php if($_SESSION['akses'] == "hrd"){?>
                                                        <th colspan="3" style="text-align:center;">Aksi</th>
                                                    <?php } ?>

                                                    <?php if($_SESSION['akses'] != "hrd"){?>
                                                        <th style="text-align:center;">Aksi</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            <?php
                                                $no = 1;
                                                while($fetch = mysqli_fetch_array($result)){ 
                                                    $waktu_berjalan = date("d-m-Y");
                                                    $masa_kontrak = strtotime($fetch['akhir_kontrak']) - strtotime($waktu_berjalan); 
                                                    $id_karyawan = $fetch['id_karyawan'];

                                                    //$date_masakontrak = floor($masa_kontrak / (60*60*24)); ?>

                                                    <tr class='even gradeA'>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $fetch['id_karyawan'] ?></td>
                                                    <td><?= $fetch['nama_jabatan'] ?></td>
                                                    <td><?= $fetch['nama'] ?></td>
                                                    <td><?= $fetch['jk'] ?></td>
                                                    <td><?= $fetch['kontrak'] ?></td>

                                                    <!-- awal dan akhir kontrak -->
                                                    <?php if($masa_kontrak/(24*60*60)<=1){ ?>
                                                            <td><span class='badge' style='background-color:#ec0e0e; color:#fff;'>
                                                            <?= date('d-m-Y', strtotime($fetch['awal_kontrak'])); ?></span></td>
                                                            
                                                            <td><span class='badge' style='background-color:#ec0e0e; color:#fff;'>
                                                            <?= date('d-m-Y', strtotime($fetch['akhir_kontrak'])); ?></span></td>
                                                    <?php } 
                                                     else if($masa_kontrak/(24*60*60)<15){ ?>
                                                            <td><span class='badge' style='background-color:#ffc107; color:#fff;'>
                                                            <?= date('d-m-Y', strtotime($fetch['awal_kontrak'])); ?></span></td>

                                                            <td><span class='badge' style='background-color:#ffc107; color:#fff;'>
                                                            <?= date('d-m-Y', strtotime($fetch['akhir_kontrak'])); ?></span></td>
                                                    <?php } 
                                                     else{ ?>
                                                            <td><span class='badge' style='background-color:#808080; color:#fff;'>
                                                            <?= date('d-m-Y', strtotime($fetch['awal_kontrak'])); ?></span></td>

                                                            <td><span class='badge' style='background-color:#808080; color:#fff;'>
                                                            <?= date('d-m-Y', strtotime($fetch['akhir_kontrak'])); ?></span></td>
                                                    <?php } ?>

                                                    <!-- selisih -->
                                                    <!-- <?php if($date_masakontrak <= 1) { ?>
                                                        <td><?= "Kontrak Sudah Abis" ?></td>
                                                    <?php }else{ ?>
                                                        <td><?= $date_masakontrak." Hari" ?></td>
                                                    <?php } ?> -->
                                                    
                                                    <!-- status -->
                                                    <?php $status_kontrak = "" ?>
                                                    <?php if($masa_kontrak/(24*60*60)<=1){ ?>
                                                        <td><?= $status_kontrak = "Sudah Habis Masa Kontrak" ?></td>
                                                    <?php } 
                                                     else if($masa_kontrak/(24*60*60)<15){ ?>
                                                            <td><?= $status_kontrak = "Masa Kontrak Mau Habis"?></td>
                                                    <?php } 
                                                     else{ ?>
                                                            <td><?= $status_kontrak = "Masih Dalam Masa Kontrak" ?></td>
                                                    <?php } ?>
                                                    
                                                    <?php $query_status = "UPDATE tb_karyawan set ket = '$status_kontrak' where id_karyawan = '$id_karyawan'";
                                                          $result_status = mysqli_query($mysqli,$query_status); ?>
                                                    
                                                    <!-- <td><?= $fetch['status'] ?></td> -->
                                                    
                                                    <!-- action --> 
                                                    <?php if($_SESSION['akses'] != "hrd"){ ?>
                                                    <td><a class="btn btn-success" href='pengajuan.php?id=<?=$fetch['id_karyawan'];?> && statusket=<?=$status_kontrak;?>'>
                                                            <i class="fa fa-fw" aria-hidden="true" title="Copy to use pencil-square-o">&#xf044</i></a></td>
                                                    <?php } ?>
                                                    
                                                    <?php if($_SESSION['akses'] == "hrd"){ ?>
                                                    <td><a class='btn btn-info' href='edit_data_kar.php?id=<?= $fetch['id_karyawan']; ?>'>
                                                            <i class='fa fa-fw' aria-hidden='true' title='Copy to use pencil'>&#xf040</i></a></td>
                                                    <td><a class='btn btn-danger' onClick="deleteData('<?= $fetch['id_karyawan']; ?>')" data-toggle='modal' data-target='#ModalDelete'>
                                                            <i class='fa fa-fw' aria-hidden='true' title='Copy to use trash-o'>&#xf014</i></a></td>
                                                    <?php } ?>
                                                    </tr>
                                            <?php } ?>

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
        <!-- Modal Delete -->
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Hapus Data</h4>
                </button>
            </div>
            <div class="modal-body">
                Anda Yakin ingin menghapus data tersebut?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
               <a href="" id="idJbtn"> <button type="button" class="btn btn-primary">Ya</button></a>
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
        <script>
            function deleteData(id){
                document.getElementById("idJbtn").href = "../proses/delete_data_kar.php?id=" +id;
            }   
        </script>

    </body>
</html>

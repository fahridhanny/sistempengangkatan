<?php
  include '../database/connect.php' ;
  session_start();
    $result = mysqli_query($mysqli,"SELECT * FROM tb_jabatan ORDER BY id_jabatan DESC");
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
                            <h1 class="page-header">Jabatan</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>


                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form role="form" action="../proses/cekjabatan.php" method="POST">
                                            
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
                                                <div class="form-group">
                                                    <label>Masukkan Jabatan Baru</label>
                                                    <input class="form-control" type="text" name="nama_jabatan">
                                                </div>
                                                
                                                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->

                                <br>
                    

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <i class="fa fa-table fa-fw"></i>
                                    Data Jabatan
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jabatan</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 1;
                                                while($fetch = mysqli_fetch_array($result)){?>
                                                    <tr class='even gradeA'>
                                                        <td><?=$no++; ?></td>
                                                        <td><?= $fetch['nama_jabatan']; ?></td>
                                                        <td><a class='btn btn-info' href='edit_jabatan.php?id=<?= $fetch['id_jabatan']; ?>'>
                                                            <i class='fa fa-fw' aria-hidden='true' title='Copy to use pencil'>&#xf040</i></a>
                                                        </td>
                                                        <td><a class='btn btn-danger' onClick="deleteData('<?= $fetch['id_jabatan']; ?>')" data-toggle='modal' data-target='#ModalDelete' >
                                                            <i class='fa fa-fw' aria-hidden='true' title='Copy to use trash-o'>&#xf014</i>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <a href="" id="idJbtn"> <button type="button" class="btn btn-primary">Save changes</button></a>
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
                document.getElementById("idJbtn").href = "http://localhost/pengangkatan/proses/delete_jabatan.php?id=" +id;
            }   
        </script>

    </body>
</html>

<?php
  include '../database/connect.php' ;
  session_start();
  $result = mysqli_query($mysqli,"SELECT * FROM tb_jabatan WHERE nama_jabatan != 'hrd' ORDER BY id_jabatan DESC");
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
                            <h1 class="page-header">Tambah Karyawan Kontrak</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    + Tambah Karyawan Kontrak
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        
                                            <form role="form" action="../proses/cektambah_kar.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <select class="form-control" name="id_jabatan" id="jabatan" onchange="changeValue()">
                                                        <option>--- Pilih Jabatan ---</option>
                                                        <?php if(mysqli_num_rows($result) > 0) { ?>
                                                            <?php while($row = mysqli_fetch_array($result)) { ?>
                                                                <option value='<?= $row['id_jabatan']?>'><?php echo $row['nama_jabatan'] ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input class="form-control" type="text" name="nama">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="form-control" name="jk">
                                                        <option>--- Pilih Jenis Kelamin ---</option>
                                                        <option>Laki - laki</option>
                                                        <option>Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" rows="3" name="alamat"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>No Telp</label>
                                                    <input class="form-control" type="number" min="0" name="no_telp" placeholder="08xxx">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tempat lahir</label>
                                                    <input class="form-control" type="text" name="tmp_lahir">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal lahir</label>
                                                    <input class="form-control" type="date" id="tgl_lahir" name="tgl_lahir" min="1994-12-31" max="2002-12-31">
                                                </div>
                                                <div class="form-group">
                                                    <label>Awal Kontrak</label>
                                                    <input class="form-control" type="date" id="awal_kontrak" name="awal_kontrak">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>Akhir Kontrak</label>
                                                    <input class="form-control" type="date" id="akhir_kontrak" name="akhir_kontrak">
                                                </div> -->
                                                <div class="form-group">
                                                    <label>Foto</label>
                                                    <input type="file" name="foto">
                                                </div>

                                                <br>
                                                <br>

                                                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                                            </form>
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
        <script type="text/javascript">
            function changeValue(){
                $hasil = document.getElementById('jabatan').value;
                console.log($hasil);
            }
        </script>

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


        <!-- <script>
        $( function() {
        $( "#tgl_lahir" ).datepicker({
        dateFormat: "yy-mm-dd"
        });
        } );
        </script> -->

    </body>
</html>

<?php
  include '../database/connect.php' ;
  session_start();


  $result = mysqli_query($mysqli,"SELECT * FROM tb_jabatan WHERE nama_jabatan != 'hrd'");
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
                            <h1 class="page-header">Edit Karyawan Kontrak</h1>
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
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">

                                        <?php 
                                        include '../database/connect.php' ;
                                    	$id = $_GET['id'];
                                    	$query_mysql = mysqli_query($mysqli,"SELECT * FROM tb_karyawan WHERE id_karyawan='$id'");

                                    	while($data = mysqli_fetch_array($query_mysql)){
                                            $indexJabatan = $data['id_jabatan'];
                                            $jk = $data['jk'];
                                        ?>
                                            <form role="form" action="../proses/cekupdate_kar.php"enctype="multipart/form-data" method="POST">

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
                                                    <label>ID Karyawan</label>
                                                    <input class="form-control" type="text" id="disabledInput"  value="<?php echo $data['id_karyawan'] ?>" disabled>
                                                    <input type="hidden" name="id_karyawan" value="<?php echo $data['id_karyawan'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input class="form-control" type="text" name="nama" value="<?php echo $data['nama'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <select id="jabatan"class="form-control" name="id_jabatan">
                                                        <?php if(mysqli_num_rows($result) > 0) { ?>
                                                            <?php while($row = mysqli_fetch_array($result)) { ?>
                                                                <option value="<?= $row['id_jabatan'];?>" ><?php echo $row['nama_jabatan'] ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
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
                                                    <textarea class="form-control" type ="text" rows="3" name="alamat"><?php echo $data['alamat'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>No Telp</label>
                                                    <input class="form-control" type="text" name="no_telp" value="<?php echo $data['no_telp'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tempat lahir</label>
                                                    <input class="form-control" type="text" name="tmp_lahir" value="<?php echo $data['tmp_lahir'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal lahir</label>
                                                    <input class="form-control" type="date" name="tgl_lahir" value="<?php echo $data['tgl_lahir'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Awal Kontrak</label>
                                                    <input class="form-control" type="date" name="awal_kontrak" value="<?php echo $data['awal_kontrak'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Akhir Kontrak</label>
                                                    <input class="form-control" type="date" name="akhir_kontrak" value="<?php echo $data['akhir_kontrak'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Foto</label>
                                                    <br>
                                                    <img src="http://localhost/pengangkatan/images/<?= $data['foto'] ?>" width="150" alt="">   
                                                </div>
                                                <div class="form-group">
                                                    <input type="file" name="foto">
                                                </div>
                                                <br>
                                                <br>
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

        <!-- <script>
        $( function() {
        $( "#awal_kontrak" ).datepicker({
        dateFormat: "yy-mm-dd"
        });
        } );
        </script>

        <script>
        $( function() {
        $( "#akhir_kontrak" ).datepicker({
        dateFormat: "yy-mm-dd"
        });
        } );
        </script>

        <script>
        $( function() {
        $( "#tgl_lahir" ).datepicker({
        dateFormat: "yy-mm-dd"
        });
        } );
        </script> -->

        <script>
        $(function(){
            index = <?= json_encode($indexJabatan);?>;
            console.log(index);
            $("#jabatan").prop('selectedIndex',index-1);

           
        });
        </script>
    </body>
</html>

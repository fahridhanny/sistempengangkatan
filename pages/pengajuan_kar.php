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

        <title>Pengajuan Karyawan Kontrak</title>

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
                            <h1 class="page-header">Pengajuan Karyawan Kontrak</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    + Pengajuan Karyawan Kontrak
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <form role="form" action="../proses/prosespengajuan_kar.php" method="post">
                                                    <?php
                                                    include "../database/connect.php";
                                                    $query = "SELECT * from tb_karyawan join tb_jabatan ON tb_jabatan.id_jabatan=tb_karyawan.id_jabatan where ket = 'Masa Kontrak Mau Habis' AND status = 'Belum Diajukan'";
                                                    $result = mysqli_query($mysqli,$query);
                                                    $jsArray = "var prdName = new Array();\n";


                                                  ?>
                                                
                                                <div class="form-group">
                                                    <label>Nama Karyawan Kontrak</label>
                                                    <select class="form-control" name="id_karyawan" onchange="changeValue(this.value)">
                                                        <option value="">---Pilih Nama---</option>
                                                        <?php while($row= mysqli_fetch_assoc($result)){?>
                                                        <option value="<?= $row['id_karyawan']?>"><?= $row['nama']?></option>
                                                        <?php $jsArray .= "prdName['" . $row['id_karyawan'] . "'] = {alamat:'" . addslashes($row['alamat']) 
                                                                       . "',no_telp:'".addslashes($row['no_telp']). "',tmp_lahir:'".addslashes($row['tmp_lahir'])
                                                                       . "',tgl_lahir:'".addslashes($row['tgl_lahir']). "',jk:'".addslashes($row['jk'])
                                                                       . "',kontrak:'".addslashes($row['kontrak']). "',awal_kontrak:'".addslashes($row['awal_kontrak'])
                                                                       . "',akhir_kontrak:'".addslashes($row['akhir_kontrak']). "',jabatan:'".addslashes($row['nama_jabatan'])."'};\n"; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input class="form-control" type="text"  name="jabatan" id="pjabatan" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <input class="form-control" type="text"  name="jk" id="pjk" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input class="form-control" type="text"  name="alamat" id="palamat" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>No Telp</label>
                                                    <input class="form-control" type="number"  name="no_telp" id="pnotelp" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input class="form-control" type="text"  name="tmp_lahir" id="ptmplahir" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <input class="form-control" type="date"  name="tgl_lahir" id="ptgllahir" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kontrak</label>
                                                    <input class="form-control" type="text"  name="kontrak" id="pkontrak" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Awal Kontrak</label>
                                                    <input class="form-control" type="date"  name="awal_kontrak" id="pawalkontrak" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Akhir Kontrak</label>
                                                    <input class="form-control" type="date"  name="akhir_kontrak" id="pakhirkontrak" readonly>
                                                </div>
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-success" name="ajukan">Ajukan</button>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                        <!-- /.col-lg-s6 (nested) -->
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
        <script>
        <?php echo $jsArray; ?>
        function changeValue(id){
            document.getElementById('palamat').value = prdName[id].alamat;  
            document.getElementById('pnotelp').value = prdName[id].no_telp;
            document.getElementById('ptmplahir').value = prdName[id].tmp_lahir;
            document.getElementById('ptgllahir').value = prdName[id].tgl_lahir;
            document.getElementById('pjk').value = prdName[id].jk;
            document.getElementById('pkontrak').value = prdName[id].kontrak;
            document.getElementById('pawalkontrak').value = prdName[id].awal_kontrak;
            document.getElementById('pakhirkontrak').value = prdName[id].akhir_kontrak;
            document.getElementById('pjabatan').value = prdName[id].jabatan;
        }
        </script>

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

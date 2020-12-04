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
                        <?php if($_SESSION['akses'] == 'hrd'){ ?>
                            <h1 class="page-header">Pengajuan Karyawan Kontrak</h1>
                        <?php } ?>
                        <?php if($_SESSION['akses'] != 'hrd'){ ?>
                            <h1 class="page-header">Keputusan Karyawan Kontrak</h1>
                        <?php } ?>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">

                    <?php 
                        include '../database/connect.php' ;
                        $id = $_GET['id'];
                        
                        $ket_status = $_GET['statusket'];

                        $query_mysql = mysqli_query($mysqli,"SELECT * FROM tb_karyawan,tb_jabatan WHERE id_karyawan='$id' AND tb_karyawan.id_jabatan = tb_jabatan.id_jabatan");

                        while($data = mysqli_fetch_array($query_mysql)){
                    ?>

                    <?php if($_SESSION['akses'] == "hrd") {
                        if($ket_status == "Sudah Habis Masa Kontrak"){?>
                            <div class="alert alert-danger">
                                <label for="">Sudah Habis Masa Kontrak</label>
                            </div>
                        <?php } ?>
                        <?php if($ket_status == "Masa Kontrak Mau Habis"){ ?>
                            <div class="alert alert-success">
                                <label for="">Masa Kontrak Mau Habis</label>
                            </div>
                        <?php } ?>
                        <?php if($ket_status == "Masih Dalam Masa Kontrak"){?>
                            <div class="alert alert-info">
                                <label for="">Masih Dalam Masa Kontrak, Karyawan Kontrak Bisa Diajukan 2 minggu sebelum Masa Kontrak Abis</label>
                            </div>
                        <?php } 
                    } ?> 
                    
                    <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <i class="fa fa-table fa-fw"></i>
                                    Data Karyawan Kontrak
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td width="150">ID Karyawan</td>
                                                    <td width="50">:</td>
                                                    <td><?php echo $data['id_karyawan']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Jabatan</td>
                                                    <td width="50">:</td>
                                                    <td><?php  ?><?= $data['nama_jabatan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Nama</td>
                                                    <td width="50">:</td>
                                                    <td><?php echo $data['nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Jenis Kelamin</td>
                                                    <td width="50">:</td>
                                                    <td><?php echo $data['jk']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Alamat</td>
                                                    <td width="50">:</td>
                                                    <td><?php echo $data['alamat']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">No Telp</td>
                                                    <td width="50">:</td>
                                                    <td><?php echo $data['no_telp']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Tempat Lahir</td>
                                                    <td width="50">:</td>
                                                    <td><?php echo $data['tmp_lahir']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Tanggal Lahir</td>
                                                    <td width="50">:</td>
                                                    <td><?php echo $data['tgl_lahir']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Awal Kontrak</td>
                                                    <td width="50">:</td>
                                                    <td><?php echo $data['awal_kontrak']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Akhir Kontrak</td>
                                                    <td width="50">:</td>
                                                    <td><?php echo $data['akhir_kontrak']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <form action="../proses/proses_pengajuan.php" method="post">
                                        <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan']?>">
                                        <input type="hidden" name="nama" value="<?= $data['nama']?>">
                                        <input type="hidden" name="ket" value="<?= $data['ket']?>">
                                        
                                    <?php if($_SESSION['akses'] != "hrd") { 
                                            if($data['status'] !="Proses Penilaian"){
                                            if($data['status'] !="Selesai Kontrak"){
                                            if($data['status'] !="Perpanjang Kontrak"){ 
                                            if($data['status'] !="Sudah Dinilai"){ ?>

                                            <div class='form-group'>
                                            <label>Keterangan :</label>
                                            <select class='form-control' name='status'>
                                                    <option value=''>---Pilih Keterangan---</option>
                                                    <option value='Proses Penilaian'>Proses Penilaian</option>
                                                    <!-- <option value='Perpanjang Kontrak'>Perpanjang Kontrak</option> -->
                                                    <option value='Selesai Kontrak'>Pengajuan Ditolak</option>
                                            </select>
                                        </div>
                                        <br>
                                        <button type='submit' class='btn btn-success' name='Submit'>Simpan</button>
                                    <?php }}}}}?>
                                        
                                        <div class="row">
                                        <?php if($_SESSION['akses'] == "hrd") {
                                            if($ket_status == "Masa Kontrak Mau Habis" ){
                                            if($data['status'] !="Diajukan" ){
                                            if($data['status'] !="Proses Penilaian"){
                                            if($data['status'] !="Selesai Kontrak"){
                                            if($data['status'] !="Sudah Dinilai"){    
                                            ?>
                                            
                                           &nbsp; &nbsp; &nbsp; <button type="submit" class="btn btn-primary" name="submit">Ajukan</button>
                                       
                                        <?php }}}}}}?> 
                                       
                                      
                                        
                                        </div>
                                        
                                       
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
                    <?php  } ?>
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

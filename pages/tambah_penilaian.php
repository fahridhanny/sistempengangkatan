<?php
  include '../database/connect.php' ;
  session_start();
  $jabatan = $_SESSION['jabatan'];

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
                            <h1 class="page-header">Penilaian Karyawan Kontrak</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Penilaian Karyawan Kontrak
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">

                                        <?php
                                            include "../database/connect.php";
                                            if($_SESSION['akses']=="hrd"){
                                                $query = "SELECT * from tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan where status = 'Proses Penilaian'";
                                            }else{
                                                $query = "SELECT * from tb_karyawan join tb_jabatan ON tb_jabatan.id_jabatan=tb_karyawan.id_jabatan where tb_karyawan.id_jabatan = $jabatan AND status = 'Proses Penilaian'";
                                            }
                                            $result = mysqli_query($mysqli,$query);
                                            $jsArray = "var prdName = new Array();\n";    
                                        ?>
                                        
                                        <!-- Penilaian HRD -->
                                        <?php if($_SESSION['akses']=="hrd"){ ?>
                                            <form role="form" action="../proses/cekpenilaian_kar.php" method="POST">
                                                <div class="form-group">
                                                    <label>Nama Karyawan Kontrak</label>
                                                    <select class="form-control" name="id_karyawan" onchange="changeValue(this.value)">
                                                        <option value="">---Pilih Nama---</option>
                                                        <?php while($row= mysqli_fetch_assoc($result)){?>
                                                        <option value="<?= $row['id_karyawan']?>"><?= $row['nama']?></option>
                                                        <?php $jsArray .= "prdName['" . $row['id_karyawan'] . "'] = {wawancara:'" . addslashes($row['wawancara']) 
                                                                       . "',skill:'".addslashes($row['skill']). "',nama_penilai:'".addslashes($row['id_jabatan']). "'};\n"; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penilaian Dari</label>
                                                    <input class="form-control" type="text" name="nama_penilai" id="namaPenilai" readonly>
                                                    <br>
                                                    <!-- <input class="form-control" type="text"  id="gwawancara" readonly> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Nilai Wawancara</label>
                                                    <input class="form-control" type="number" name="wawancara" id="nwawancara" readonly>
                                                    <br>
                                                    <!-- <input class="form-control" type="text"  id="gwawancara" readonly> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Nilai Skill</label>
                                                    <input class="form-control" type="number" name="skill" id="nskill" readonly>
                                                    <br>
                                                    <!-- <input class="form-control" type="text"  id="gskill" readonly> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Nilai Absensi</label>
                                                    <input class="form-control" type="number" name="absensi" min="10" max="100" id="nabsensi">
                                                    <br>
                                                    <!-- <input class="form-control" type="text"  id="gabsensi" readonly> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Nilai Psikotes</label>
                                                    <input class="form-control" type="number" name="psikotes" min="10" max="100" id="npsikotes">
                                                    <br>
                                                    <!-- <input class="form-control" type="text"  id="gpsikotes" readonly> -->
                                                </div>
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                                            </form>
                                        <?php } ?>

                                        <!-- Penilaian Manager -->
                                        <?php if($_SESSION['akses']!="hrd"){ ?>
                                            <form role="form" action="../proses/cekpenilaian_manager_kar.php" method="POST">
                                                <div class="form-group">
                                                    <label>Nama Karyawan Kontrak</label>
                                                    <select class="form-control" name="id_karyawan">
                                                        <option value="">---Pilih Nama---</option>
                                                        <?php while($row= mysqli_fetch_assoc($result)){?>
                                                        <option value="<?= $row['id_karyawan']?>"><?= $row['nama']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nilai Wawancara</label>
                                                    <input class="form-control" type="number" name="wawancara" min="10" max="100" id="wawancara_manager">
                                                    <br>
                                                    <!-- <input class="form-control" type="text"  id="gwawancara" readonly> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Nilai Skill</label>
                                                    <input class="form-control" type="number" name="skill" min="10" max="100" id="skill_manager">
                                                    <br>
                                                    <!-- <input class="form-control" type="text"  id="gskill" readonly> -->
                                                </div>
                                                <br>
                                                <br>    
                                                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                                            </form>
                                        <?php } ?>
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
        <!-- <script>
        function GradeAbsen(){
            let absensi = document.getElementById('absensi').value;
            let hasil = parseInt(absensi);
            if(hasil >= 100){
                let grade = "Sangat Baik";
                document.getElementById('gabsensi').value = grade;
            }else if(hasil >= 80){
                let grade = "Baik";
                document.getElementById('gabsensi').value = grade;
            }else if(hasil >= 60){
                let grade = "Cukup";
                document.getElementById('gabsensi').value = grade;
            }else if(hasil >= 40){
                let grade = "Kurang";
                document.getElementById('gabsensi').value = grade;
            }else{
                let grade = "Sangat Kurang";
                document.getElementById('gabsensi').value = grade;
            }
        }
        </script>

        <script>
        function GradeWawancara(){
            let wawancara = document.getElementById('wawancara').value;
            let hasil = parseInt(wawancara);
            if(hasil >= 100){
                let grade = "Sangat Baik";
                document.getElementById('gwawancara').value = grade;
            }else if(hasil >= 80){
                let grade = "Baik";
                document.getElementById('gwawancara').value = grade;
            }else if(hasil >= 60){
                let grade = "Cukup";
                document.getElementById('gwawancara').value = grade;
            }else if(hasil >= 40){
                let grade = "Kurang";
                document.getElementById('gwawancara').value = grade;
            }else{
                let grade = "Sangat Kurang";
                document.getElementById('gwawancara').value = grade;
            }
        }
        </script>

        <script>
        function GradePsikotes(){
            let psikotes = document.getElementById('psikotes').value;
            let hasil = parseInt(psikotes);
            if(hasil >= 100){
                let grade = "Sangat Baik";
                document.getElementById('gpsikotes').value = grade;
            }else if(hasil >= 80){
                let grade = "Baik";
                document.getElementById('gpsikotes').value = grade;
            }else if(hasil >= 60){
                let grade = "Cukup";
                document.getElementById('gpsikotes').value = grade;
            }else if(hasil >= 40){
                let grade = "Kurang";
                document.getElementById('gpsikotes').value = grade;
            }else{
                let grade = "Sangat Kurang";
                document.getElementById('gpsikotes').value = grade;
            }
        }
        </script>

        <script>
        function GradeSkill(){
            let skill = document.getElementById('skill').value;
            let hasil = parseInt(skill);
            if(hasil >= 100){
                let grade = "Sangat Baik";
                document.getElementById('gskill').value = grade;
            }else if(hasil >= 80){
                let grade = "Baik";
                document.getElementById('gskill').value = grade;
            }else if(hasil >= 60){
                let grade = "Cukup";
                document.getElementById('gskill').value = grade;
            }else if(hasil >= 40){
                let grade = "Kurang";
                document.getElementById('gskill').value = grade;
            }else{
                let grade = "Sangat Kurang";
                document.getElementById('gskill').value = grade;
            }
        }
        </script> -->

        <script>
        <?php echo $jsArray; ?>
        function changeValue(id){
            document.getElementById('nwawancara').value = prdName[id].wawancara;  
            document.getElementById('nskill').value = prdName[id].skill;
            if(prdName[id].nama_penilai == 1){
                document.getElementById('namaPenilai').value = 'Siti Aminah';
            }else if(prdName[id].nama_penilai == 2){
                document.getElementById('namaPenilai').value = 'Muhamad Dafi';
            }else if(prdName[id].nama_penilai == 3){
                document.getElementById('namaPenilai').value = 'Imam Khufron';
            }   
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

        <script>
        $( function() {
        $( "#date" ).datepicker({
        dateFormat: "yy-mm-dd"
        });
        } );
        </script>

        <script>
        $( function() {
        $( "#date2" ).datepicker({
        dateFormat: "yy-mm-dd"
        });
        } );
        </script>

    </body>
</html>

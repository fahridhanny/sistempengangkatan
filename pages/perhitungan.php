<?php
  include '../database/connect.php' ;
  session_start();
    $result = mysqli_query($mysqli,"SELECT * FROM tb_kriteria");

    if($_SESSION['akses']=="hrd"){
        $query02 = "SELECT * FROM tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan order by id_penilaian DESC";
    }else{
        $query02 = "SELECT * FROM tb_penilaian join tb_karyawan ON tb_karyawan.id_karyawan=tb_penilaian.id_karyawan where tb_karyawan.id_jabatan = $jabatan";
    }
    $result02 = mysqli_query($mysqli,$query02);
    $result03 = mysqli_query($mysqli,$query02);
    $result04 = mysqli_query($mysqli,$query02);

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
                            <h1 class="page-header">Perhitungan SMART</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                    <br>
                    <br>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-4">
                            
                            <h4 style="text-decoration: underline;"><strong>Kriteria Yang Ditetapkan</strong></h4>
                            <br>    
                                <!-- /.panel-heading -->
                                
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kriteria</th>
                                                    <th>Bobot</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $result01 = mysqli_query($mysqli,"SELECT * FROM tb_kriteria");
                                                $no01 = 1;
                                                while($fetch01 = mysqli_fetch_array($result01)){?>
                                                    <tr class='even gradeA'>
                                                        <td><?=$no01++; ?></td>
                                                        <td><?= $fetch01['nama_kriteria']; ?></td>
                                                        <td><?= $fetch01['bobot']; ?></td>
                                                    </tr>
                                            <?php } ?>
                                                
                                            </tbody>
                                        </table>
                                    
                                    <!-- /.table-responsive -->
                                    
                                
                                <!-- /.panel-body -->
                            
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <br>
                    <br>

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-5">
                            
                                
                                <!-- /.panel-heading -->
                                <h4 style="text-decoration: underline;"><strong>Kriteria Yang Sudah Dinormalisasi</strong></h4>
                                <br>     

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kriteria</th>
                                                    <th>Bobot</th>
                                                    <th>Normalisasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sqljumlah ="SELECT SUM(bobot) FROM tb_kriteria";
                                                $queryjumlah= mysqli_query($mysqli,$sqljumlah);
                                                $jumlah0=mysqli_fetch_array($queryjumlah);
                                                $jumlah = $jumlah0[0];

                                                $no = 1;
                                                while($fetch = mysqli_fetch_array($result)){?>
                                                    <tr class='even gradeA'>
                                                        <td><?=$no++; ?></td>
                                                        <td><?= $fetch['nama_kriteria']; ?></td>
                                                        <td><?= $fetch['bobot']; ?></td>
                                                        <td><?=round($fetch['bobot']/$jumlah,2) ?></td>
                                                    </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="1">Total</td>
                                                <td></td>
                                                <td><?=$jumlah?></td>
                                                <td></td>
                                            </tr>
                                                
                                            </tbody>
                                        </table>
                                    
                                    <!-- /.table-responsive -->
                                    
                                
                                <!-- /.panel-body -->
                            
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    
                    <br>
                    <br>

                    <!-- /.row -->
                    <div class="row">
                                <div class="col-lg-7">
                            
                                
                                <!-- /.panel-heading -->
                                <h4 style="text-decoration: underline;"><strong>Sample Karyawan Kontrak</strong></h4>
                                <br>

                                        <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Absensi</th>
                                                <th>Wawancara</th>
                                                <th>Psikotes</th>
                                                <th>Skill</th>
                                                <!-- <th>Hasil Akhir</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $no03 = 1;

                                             while($fetch03 = mysqli_fetch_array($result03)){

                                                $nabsensi03 = $fetch03['absensi'];
                                                $nwawancara03 = $fetch03['wawancara'];
                                                $npsikotes03 = $fetch03['psikotes'];
                                                $nskill03 = $fetch03['skill'];
                                                //$nilaievaluasi02 = $nabsensi02 + $nwawancara02 + $npsikotes02 + $nskill02;
                                                //var_dump($nabsensi);
                                                //die();

                                                 echo "<tr class='even gradeA'>";
                                                 echo "<td>".$no03++."</td>";
                                                 echo "<td>".$fetch03['nama']."</td>";
                                                 echo "<td>".$nabsensi03."</td>";
                                                 echo "<td>".$nwawancara03."</td>";
                                                 echo "<td>".$npsikotes03."</td>";
                                                 echo "<td>".$nskill03."</td>";
                                                 //echo "<td>".round($nilaievaluasi02,2)."</td>";
                                                 //echo "<td>".$ket."</td>";
                                                 echo "</tr>";
                                                 
                                             }


                                            ?>

                                        </tbody>
                                        </table>
                                    
                                    <!-- /.table-responsive -->
                                    
                                
                                <!-- /.panel-body -->
                            
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <br>
                    <br>

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-8">
                            
                                
                                <!-- /.panel-heading -->
                                <h4 style="text-decoration: underline;"><strong>Hitung Nilai Utility Dari Setiap Kriteria</strong></h4>
                                <br>   

                                        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Absensi</th>
                                                <th>Wawancara</th>
                                                <th>Psikotes</th>
                                                <th>Skill</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $no04 = 1;
                                             //menjumlahkan bobot
                                             $sqljumlah04 ="SELECT SUM(bobot) FROM tb_kriteria";
                                             $queryjumlah04 = mysqli_query($mysqli,$sqljumlah04);
                                             $jumlah004=mysqli_fetch_array($queryjumlah04);
                                             $jumlah04 = $jumlah004[0];
                                             
                                             
                                             $sqlkriteria04 ="SELECT bobot FROM tb_kriteria";
                                             $querykriteria04 = mysqli_query($mysqli, $sqlkriteria04);
                                             $bobot04=[];
                                             while ($bariskriteria04= mysqli_fetch_array($querykriteria04)) {
                                                 $bobot04[]=$bariskriteria04['bobot'];
                                             }
                                             $minabsensi = 10;
                                             $maxabsensi = 100;

                                             $minwawancara = 10;
                                             $maxwawancara = 100;

                                             $minpsikotes = 10;
                                             $maxpsikotes = 100;

                                             $minskill = 10;
                                             $maxskill = 100;

                                             while($fetch04 = mysqli_fetch_array($result04)){

                                                //mendapatkan nilai utility
                                                $nilai_absensi = (($fetch04['absensi'] - $minabsensi) / ($maxabsensi - $minabsensi) * 100);
                                                $nilai_wawancara = (($fetch04['wawancara'] - $minwawancara) / ($maxwawancara - $minwawancara) * 100);
                                                $nilai_psikotes = (($fetch04['psikotes'] - $minpsikotes) / ($maxpsikotes - $minpsikotes) * 100);
                                                $nilai_skill = (($fetch04['skill'] - $minskill) / ($maxskill - $minskill) * 100);

                                                 echo "<tr class='even gradeA'>";
                                                 echo "<td>".$no04++."</td>";
                                                 echo "<td>".$fetch04['nama']."</td>";
                                                 echo "<td>".round($nilai_absensi,2)."</td>";
                                                 echo "<td>".round($nilai_wawancara,2)."</td>";
                                                 echo "<td>".round($nilai_psikotes,2)."</td>";
                                                 echo "<td>".round($nilai_skill,2)."</td>";
                                                 echo "</tr>";
                                                 
                                             }


                                            ?>

                                        </tbody>
                                        </table>
                                    
                                    <!-- /.table-responsive -->
                                    
                                
                                <!-- /.panel-body -->
                            
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <br>
                    <br>


                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-10">
                            
                                
                                <!-- /.panel-heading -->
                                <h4 style="text-decoration: underline;"><strong>Hitung Nilai Akhir</strong></h4>
                                <br> 

                                        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Absensi</th>
                                                <th>Wawancara</th>
                                                <th>Psikotes</th>
                                                <th>Skill</th>
                                                <th>Hasil Akhir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $no02 = 1;
                                             //menjumlahkan bobot
                                             $sqljumlah02 ="SELECT SUM(bobot) FROM tb_kriteria";
                                             $queryjumlah02 = mysqli_query($mysqli,$sqljumlah02);
                                             $jumlah002=mysqli_fetch_array($queryjumlah02);
                                             $jumlah02 = $jumlah002[0];
                                             
                                             
                                             $sqlkriteria02 ="SELECT bobot FROM tb_kriteria";
                                             $querykriteria02 = mysqli_query($mysqli, $sqlkriteria02);
                                             $bobot02=[];
                                             while ($bariskriteria02= mysqli_fetch_array($querykriteria02)) {
                                                 $bobot02[]=$bariskriteria02['bobot'];
                                             }

                                             $minabsensi02 = 10;
                                             $maxabsensi02 = 100;

                                             $minwawancara02 = 10;
                                             $maxwawancara02 = 100;

                                             $minpsikotes02 = 10;
                                             $maxpsikotes02 = 100;

                                             $minskill02 = 10;
                                             $maxskill02 = 100;

                                             while($fetch02 = mysqli_fetch_array($result02)){

                                                //mendapatkan nilai utility
                                                $nilai_absensi02 = (($fetch02['absensi'] - $minabsensi02) / ($maxabsensi02 - $minabsensi02) * 100);
                                                $nilai_wawancara02 = (($fetch02['wawancara'] - $minwawancara02) / ($maxwawancara02 - $minwawancara02) * 100);
                                                $nilai_psikotes02 = (($fetch02['psikotes'] - $minpsikotes02) / ($maxpsikotes02 - $minpsikotes02) * 100);
                                                $nilai_skill02 = (($fetch02['skill'] - $minskill02) / ($maxskill02 - $minskill02) * 100);

                                                $nabsensi02 = $nilai_absensi02*($bobot02[0]/$jumlah02);
                                                $nwawancara02 = $nilai_wawancara02*($bobot02[1]/$jumlah02);
                                                $npsikotes02 = $nilai_psikotes02*($bobot02[2]/$jumlah02);
                                                $nskill02 = $nilai_skill02*($bobot02[3]/$jumlah02);
                                                $nilaievaluasi02 = $nabsensi02 + $nwawancara02 + $npsikotes02 + $nskill02;
                                                //$nilaievaluasi03[] = floatval($nabsensi02 + $nwawancara02 + $npsikotes02 + $nskill02);
                                                
                                                //var_dump($nabsensi);
                                                //die();

                                                 echo "<tr class='even gradeA'>";
                                                 echo "<td>".$no02++."</td>";
                                                 echo "<td>".$fetch02['nama']."</td>";
                                                 echo "<td>".round($nabsensi02,2)."</td>";
                                                 echo "<td>".round($nwawancara02,2)."</td>";
                                                 echo "<td>".round($npsikotes02,2)."</td>";
                                                 echo "<td>".round($nskill02,2)."</td>";
                                                 echo "<td>".round($nilaievaluasi02,2)."</td>";
                                                 //echo "<td>".$ket."</td>";
                                                 echo "</tr>";

                                                // if ($nilaievaluasi02 >= 70) {
                                                //     $ket[] = "Diangkat";
                                                // }else{
                                                //     $ket[] = "Tidak Diangkat";
                                                // }

                                                // $nilai = $nilaievaluasi03;
                                                // $id[] = $fetch02['id_penilaian'];

                                                // for($i=0; $i < count($id);$i++){
                                                //     $sql1="UPDATE `tb_penilaian` SET `hasil`='".$nilai[$i]."', `hasil_rekomendasi`='".$ket[$i]."' WHERE `id_penilaian`='".$id[$i]."'";
                                                //     $result=mysqli_query($mysqli,$sql1);
                                                // }
                                             }
                                                
                                            ?>

                                        </tbody>
                                        </table>
                                    
                                    <!-- /.table-responsive -->
                                    
                                
                                <!-- /.panel-body -->
                            
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

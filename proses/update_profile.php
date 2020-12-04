<?php 
    include '../database/connect.php' ;
    include '../database/functions.php' ;

    if(isset($_POST['submit'])){
        if(updateProfil($_POST) > 0){
            echo "<script>alert ('Update Profil Berhasil'); window.location='http://localhost/pengangkatan/pages/profile.php'</script>";
        }else{
            echo "<script>alert ('Update Profil tidak behasil'); window.location='http://localhost/pengangkatan/pages/edit_profile.php'</script>";
        }
    }
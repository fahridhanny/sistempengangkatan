<?php 

    include "../database/connect.php";

    function readData($query){
        global $mysqli;
        $data = [];
        $resultData = mysqli_query($mysqli,$query);
        while($result = mysqli_fetch_array($resultData)){
            $data[] = $result;
        }
        return $data;
    }

    function updateProfil($data){
        global $mysqli;
        $id_admin = $data['id_admin'];
        $nama = $data['nama'];
        $jk = $data['jk'];
        $alamat = $data['alamat'];
        $no_hp = $data['no_hp'];
        $email = $data['email'];
        $username = $data['username'];
        $password = $data['password'];
        $md5Password = md5($password);

        $readData = readData("SELECT * from tb_admin WHERE id_admin = '$id_admin'");
        $cekPassword = $readData[0]['password'];

        if($id_admin != null && $nama !=null && $alamat !=null && $no_hp != null && $email != null && $username != null && $password!=null){
            if($password == $cekPassword){
                $sql = "UPDATE tb_admin SET nama = '$nama' , jk = '$jk', alamat = '$alamat',no_hp = '$no_hp', email = '$email', username = '$username' WHERE id_admin = '$id_admin'";
            }else{
                $sql = "UPDATE tb_admin SET nama = '$nama' , jk = '$jk', alamat = '$alamat',no_hp = '$no_hp', email = '$email', username = '$username',password= '$md5Password' WHERE id_admin = '$id_admin'";
            }
            mysqli_query($mysqli,$sql);
            return mysqli_affected_rows($mysqli);
        }else{
            return 0;
        }
    }
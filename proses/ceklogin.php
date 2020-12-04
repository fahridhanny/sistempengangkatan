<?php

include '../database/connect.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($mysqli, "SELECT * FROM tb_admin where username='$username' and password='$password'");
$fetch = mysqli_fetch_array($query);

if (!empty($username) && !empty($password)) {
	if($fetch !=null){

		if ($fetch['username'] == $username && $fetch['password'] == $password && $fetch['akses'] == 'hrd') {
			session_start();
			$_SESSION['akses'] = $fetch['akses'];
			$_SESSION['nama'] = $fetch['nama'];
			$_SESSION['id_admin'] = $fetch['id_admin'];
			$_SESSION['status'] = "login";
			$_SESSION['jabatan'] = $fetch['jabatan'];
			header('Location:../pages/index.php');
		} else if ($fetch['username'] == $username && $fetch['password'] == $password && $fetch['akses'] == 'manager_pemasaran') {
			session_start();
			$_SESSION['akses'] = $fetch['akses'];
			$_SESSION['nama'] = $fetch['nama'];
			$_SESSION['id_admin'] = $fetch['id_admin'];
			$_SESSION['status'] = "login";
			$_SESSION['jabatan'] = $fetch['jabatan'];
			header('Location:../pages/index.php');
		} else if ($fetch['username'] == $username && $fetch['password'] == $password && $fetch['akses'] == 'manager_keuangan') {
			session_start();
			$_SESSION['akses'] = $fetch['akses'];
			$_SESSION['nama'] = $fetch['nama'];
			$_SESSION['id_admin'] = $fetch['id_admin'];
			$_SESSION['status'] = "login";
			$_SESSION['jabatan'] = $fetch['jabatan'];
			header('Location:../pages/index.php');
		} else if ($fetch['username'] == $username && $fetch['password'] == $password && $fetch['akses'] == 'manager_administrasi') {
			session_start();
			$_SESSION['akses'] = $fetch['akses'];
			$_SESSION['nama'] = $fetch['nama'];
			$_SESSION['id_admin'] = $fetch['id_admin'];
			$_SESSION['status'] = "login";
			$_SESSION['jabatan'] = $fetch['jabatan'];
			header('Location:../pages/index.php');
		} else {
			echo "<script>alert ('username dan password yang dimasukkan salah'); window.location='../pages/login.php'</script>";
		}
	}else{
			echo "<script>alert ('username dan password yang dimasukkan salah'); window.location='../pages/login.php'</script>";
	}
} else {
		echo "<script>alert ('Username dan password Tidak Boleh Kosong'); window.location='../pages/login.php'</script>";
}

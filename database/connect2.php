<?php

$databaseHost = 'localhost';
$databaseName = 'metode_smart';
$databaseUsername = 'root';
$databasePassword = '';

$connect = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

global $connect;

    if( !$mysqli ){
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }
?>
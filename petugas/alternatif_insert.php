<?php

include '../connection.php';

//$id = $_POST['id'];

$nama_supplier   = $_POST['nama_supplier']; 
$alamat 		 = $_POST['alamat'];
$phone			 = $_POST['phone'];
$email 			 = $_POST['email'];

$insert = mysqli_query($connect, "INSERT INTO alternatif_supplier SET nama_supplier='$nama_supplier',alamat='$alamat',phone='$phone',email='$email'");

if($insert)
	header('location: alternatif.php');
else
	echo 'Input gagal';
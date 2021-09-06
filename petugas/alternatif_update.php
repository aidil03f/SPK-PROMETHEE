<?php

include '../connection.php';

$id_supplier     = $_POST['id_supplier'];
$nama_supplier	 = $_POST['nama_supplier']; 
$alamat	         = $_POST['alamat'];
$phone			 = $_POST['phone'];
$email 			 = $_POST['email'];


$update = mysqli_query($connect, "UPDATE alternatif_supplier SET nama_supplier='$nama_supplier',alamat='$alamat',phone='$phone',email='$email' WHERE id_supplier='$id_supplier'");

if($update)
	header('location: alternatif.php');
else
	echo 'Input gagal';
?>
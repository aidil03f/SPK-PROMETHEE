<?php

include '../connection.php';


$nama_kriteria   = $_POST['nama_kriteria']; 
$kaidah		   	 = $_POST['kaidah'];
$bobot 		     = $_POST['bobot'];
$tipe_preferensi = $_POST['tipe_preferensi'];
$parameter_p     = $_POST['p'];
$parameter_q     = $_POST['q'];

$insert = mysqli_query($connect, "INSERT INTO kriteria SET nama_kriteria='$nama_kriteria',kaidah='$kaidah',bobot='$bobot',tipe_preferensi='$tipe_preferensi',p='$parameter_p',q='$parameter_q'");

if($insert)
	header('location: kriteria.php');
else
	echo 'Input gagal';
<?php

include '../connection.php';

$id_kriteria     = $_POST['id_kriteria'];
$nama_kriteria   = $_POST['nama_kriteria']; 
$kaidah          = $_POST['kaidah'];
$bobot           = $_POST['bobot'];
$tipe_preferensi = $_POST['tipe_preferensi'];
$parameter_p     = $_POST['p'];
$parameter_q     = $_POST['q'];

$update = mysqli_query($connect, "UPDATE kriteria SET nama_kriteria='$nama_kriteria',kaidah='$kaidah',bobot='$bobot',tipe_preferensi='$tipe_preferensi',p='$parameter_p',q='$parameter_q' WHERE id_kriteria='$id_kriteria'");

if($update)
	header('location: kriteria.php');
else
	echo 'Input gagal';
?>
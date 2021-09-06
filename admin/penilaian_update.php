<?php

include '../connection.php';

$id_alternatif_kriteria = $_POST['id_alternatif_kriteria'];
$id_alternatif = $_POST['id_alternatif'];
$id_kriteria  = $_POST['id_kriteria'];
$nilai = $_POST['nilai'];

$update = mysqli_query($connect, "UPDATE alternatif_kriteria SET id_alternatif='$id_alternatif',id_kriteria='$id_kriteria',nilai='$nilai' WHERE id_alternatif_kriteria='$id_alternatif_kriteria'");
if($update)
	header('location: penilaian.php');
else
	echo 'Input gagal';
?>

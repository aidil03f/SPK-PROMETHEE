<?php

include '../connection.php';

$id_kriteria = $_GET['id_kriteria'];	

$delete = Mysqli_query($connect, "DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'");

if($delete)
	header('location: kriteria.php');
else
	echo 'gagal';
?>
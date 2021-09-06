<?php
include '../connection.php';

$id_nilai = $_GET['id_nilai'];

$delete= Mysqli_query($connect,"DELETE FROM nilai_seleksi WHERE id_nilai='$id_nilai'");
if($delete)
	header('location: penilaian.php');
else
	echo 'gagal';
?>
	

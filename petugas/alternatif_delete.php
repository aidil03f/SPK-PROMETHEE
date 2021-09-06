<?php

include '../connection.php';

$id_supplier = $_GET['id_supplier'];	

$delete = Mysqli_query($connect, "DELETE FROM alternatif_supplier WHERE id_supplier='$id_supplier'");

if($delete)
	header('location: alternatif.php');
else
	echo 'gagal';
?>
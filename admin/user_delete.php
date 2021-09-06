<?php

include '../connection.php';

$id_user = $_GET['id_user'];

$query   = mysqli_query($connect, "SELECT * FROM user WHERE id_user='$id_user'");
$data    = mysqli_fetch_array($query);


if(file_exists('./../foto/'.$data['photo']))
	unlink('./../foto/'.$data['photo']);

$query2 = "DELETE FROM user WHERE id_user='".$id_user."'";
$sql2   = mysqli_query($connect, $query2);

if($sql2){
	header('location:user.php');
}else{
	echo "<script> alert('Data User Gagal dihapus'); window.location = 'user.php';</script>";
}



?>
<?php

include '../connection.php';

//$id = $_POST['id'];
$nama_lengkap   = $_POST['nama_lengkap']; 
$username 		= $_POST['username'];
$password		= $_POST['password'];
$phone			= $_POST['phone'];
$email 			= $_POST['email'];
$akses_level 	= $_POST['akses_level'];
$photo			= $_POST['photo'];


$insert = mysqli_query($connect, "INSERT INTO user SET nama_lengkap='$nama_lengkap',username='$username',password='$password',phone='$phone',email='$email',akses_level='$akses_level',photo='$photo'");

if($insert)
	header('location: user.php');
else
	echo 'Input gagal';
<?php

include '../connection.php'; 

$id_user       = $_POST['id_user'];
$nama_lengkap  = $_POST['nama_lengkap']; 
$username      = $_POST['username'];
$password      = $_POST['password'];
$email         = $_POST['email'];
$phone 		   = $_POST['phone'];
$akses_level   = $_POST['akses_level'];
$nama_photo    = $_FILES['photo']['name'];
$source        = $_FILES['photo']['tmp_name'];
$folder		   = './../foto/';


// $update = mysqli_query($connect, "UPDATE user SET nama_lengkap='$nama_lengkap',username='$username',password='$password',phone='$phone',akses_level='$akses_level' WHERE id_user='$id_user'");

// if($update)
// 	header('location: user.php');
// else
// 	echo 'Input gagal';

if($nama_photo != '')
	move_uploaded_file($source, $folder.$nama_photo);
	$update = mysqli_query($connect, "UPDATE user SET nama_lengkap='$nama_lengkap',username='$username',password='$password',email='$email',phone='$phone',akses_level='$akses_level',photo='$nama_photo' WHERE id_user='$id_user'")


?>
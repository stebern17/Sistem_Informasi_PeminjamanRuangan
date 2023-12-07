<?php
if(!isset($_SESSION)){
 session_start();
}

if(!isset($_SESSION["role"])){
	echo "<script> alert('Silakan Login untuk mengakses halaman ini'); </script>";
	echo '<script> window.location="index.php"; </script>';
}
else
{
	if($_SESSION["role"]!='Admin' AND $_SESSION["role"]!='Kadiv' ){
		echo "<script> alert('Hanya admin yang dapat mengakses halaman ini'); </script>";
		echo '<script> window.location="index.php"; </script>';
	}
}
?>
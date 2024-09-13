<?php 
session_start();
$_SESSION['MaKhachHang']="";
$_SESSION['TenKhachHang']="";
session_destroy();
// setcookie('PHPSESSID','',-1,'/');

header("Location: /DoAnPHP/dangnhap.php");
exit();
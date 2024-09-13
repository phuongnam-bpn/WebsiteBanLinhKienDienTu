<?php

include("./include/Connect.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(empty($_POST['Name'])||empty($_POST['Email'])||empty($_POST['DiaChi'])||empty($_POST['Username'])||empty($_POST['Password'])||empty($_POST['ConfirmPassword'])){
    header("Location: /DoAnPHP/dangnhap.php?dangKy=0");
    exit();
}
$name=$_POST['Name'];
$email=$_POST['Email'];
$address=$_POST['DiaChi'];
$username=$_POST['Username'];
$password=$_POST['Password'];
$password_hashed = password_hash($password, PASSWORD_DEFAULT);
$confirm=$_POST['ConfirmPassword'];
$sql = "select * from `user` where SoDienThoai = '$username' or Email = '$email'";
$sta = $pdo->prepare($sql);
$sta->execute();
if ($sta->rowCount() > 0)
{
    header("location: /DoAnPHP/dangnhap.php?dangKy=3");
    exit;
}
if($password==$confirm){
    $sql="INSERT INTO `user`(`TenKhachHang`, `SoDienThoai`, `Email`, `MatKhau`, `DiaChiGiaoHang`, `QUYEN`, `DiemTichLuy`) VALUES ('$name','$username','$email','$password_hashed','$address',0,0)";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    if ($sta->rowCount() > 0) {
        // Chuẩn bị truy vấn SQL an toàn
        $sql = "SELECT MaKhachHang, TenKhachHang, QUYEN FROM `user` WHERE SoDienThoai = :username";
        $sta = $pdo->prepare($sql);
        $sta->bindParam(':username', $username);
        $sta->execute();
        if ($sta->rowCount() > 0) {
            // Trả về 1 dòng dữ liệu
            $account = $sta->fetch(PDO::FETCH_ASSOC);
            $_SESSION["MaKhachHang"] = $account["MaKhachHang"];
            $_SESSION["TenKhachHang"] = $account["TenKhachHang"];
            $_SESSION["QUYEN"] = 0;
            header("Location: /DoAnPHP/trangchu.php");
            exit();
        }
    }   
}
header("location: /DoAnPHP/dangnhap.php?dangKy=2");
exit();
<?php 

include("./include/Connect.php");
if(!empty($_POST['maSP'])&&!empty($_POST['soLuong'])){
    $maSP=$_POST['maSP'];
    $soLuong= $_POST['soLuong'];
    $maDonHang = $_POST['maDonHang'];
    $update="UPDATE chitietdonhang SET SoLuong=$soLuong WHERE MaDonHang='$maDonHang' and MaSP='$maSP'";
    $sta = $pdo->prepare($update);
    $sta->execute();
    if($sta->rowCount() > 0)
    {
        header("Location: /DoAnPHP/giohang.php");
        exit();
    }  
}
header("Location: /DoAnPHP/sanpham.php");
exit();
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("./include/Connect.php");

if (isset($_GET["mlsp"])) {
    $maSP = $_GET["mlsp"];

    // Xóa sản phẩm từ CSDL
    $sql = "DELETE FROM LoaiSanPham WHERE MaLoaiSP = ?";
    $sta = $pdo->prepare($sql);
    $kq = $sta->execute([$maSP]);

    if ($kq) {
        $_SESSION['checkXoaLoaiSanPham'] = "Xóa thành công";
    } else {
        $_SESSION['checkXoaLoaiSanPham'] = "Không thể xóa";
    }
}
// Chuyển hướng sau khi hoàn thành
header("Location: /DoAnPHP/quanliloaisanpham.php");
exit();
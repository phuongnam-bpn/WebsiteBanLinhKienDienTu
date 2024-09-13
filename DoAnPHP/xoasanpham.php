<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("./include/Connect.php");

if (isset($_GET["msp"])) {
    $maSP = $_GET["msp"];

    // Xóa sản phẩm từ CSDL
    $sql = "DELETE FROM sanpham WHERE MaSP = ?";
    $sta = $pdo->prepare($sql);
    $kq = $sta->execute([$maSP]);

    if ($kq) {
        $_SESSION['checkXoa'] = "Xóa thành công";
    } else {
        $_SESSION['checkXoa'] = "Không thể xóa";
    }
}
// Chuyển hướng sau khi hoàn thành
header("Location: /DoAnPHP/quanlisanpham.php");
exit();
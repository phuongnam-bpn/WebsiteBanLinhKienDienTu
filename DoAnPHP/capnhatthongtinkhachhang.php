<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("./include/Connect.php");

// Kiểm tra xem form có được submit hay không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Nhận dữ liệu từ form
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $user_id = $_SESSION['MaKhachHang'];
    // Cập nhật thông tin trong cơ sở dữ liệu
    $sql = "UPDATE `user` SET `TenKhachHang` = '$full_name', `Email` = '$email', `DiaChiGiaoHang` = '$address', `SoDienThoai` = '$phone' WHERE `MaKhachHang` = $user_id";
    $sta = $pdo->prepare($sql);
    // Thực thi truy vấn với các tham số
    $sta->execute();

    // Kiểm tra xem truy vấn có thành công không
    if ($sta->rowCount() > 0) {
        // Cập nhật thành công
        $_SESSION['message'] = "Thông tin đã được cập nhật thành công.";
    } else {
        // Cập nhật thất bại
        $_SESSION['message'] = "Có lỗi xảy ra khi cập nhật thông tin.";
    }

    // Chuyển hướng lại trang thông tin khách hàng
    header("Location: /DoAnPHP/thongtinkhachhang.php");
    exit;
}
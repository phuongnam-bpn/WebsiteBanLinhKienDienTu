<?php
// Khởi động session ngay từ đầu
session_start();

include("./include/Connect.php");
if (!empty($_SESSION["MaKhachHang"]))
    {
        $maKH = $_SESSION["MaKhachHang"];
        $sql = "SELECT * FROM `user` WHERE MaKhachHang = $maKH";
        $sta = $pdo->prepare($sql);
        $sta->execute();
        $account = $sta->fetch(PDO::FETCH_ASSOC);
        if ($account["QUYEN"] == 1) {
            $_SESSION["QUYEN"] = 1;
            // Chuyển đến trang admin
            header("Location: /DoAnPHP/trangchuadmin.php");
            exit();
        } else {
            $_SESSION["QUYEN"] = 0;
            header("Location: /DoAnPHP/trangchu.php");
            exit();
        }
    }
//Ngược lại chưa có biến session
$username = $_POST['Username'];
$password = $_POST['Password'];

// Chuẩn bị truy vấn SQL an toàn
$sql = "SELECT MaKhachHang, TenKhachHang,MatKhau, QUYEN FROM `user` WHERE SoDienThoai = :username";
$sta = $pdo->prepare($sql);
$sta->bindParam(':username', $username);
$sta->execute();

if ($sta->rowCount() > 0) {
    // Trả về 1 dòng dữ liệu
    $account = $sta->fetch(PDO::FETCH_ASSOC);
    if(password_verify($password,$account['MatKhau']))
    {
        session_start();
        $_SESSION["MaKhachHang"] = $account["MaKhachHang"];
        $_SESSION["TenKhachHang"] = $account["TenKhachHang"];
        $maKH = $_SESSION["MaKhachHang"];
        $tenKH = $_SESSION["TenKhachHang"];

        if ($account["QUYEN"] == 1) {
            $_SESSION["QUYEN"] = 1;
            // Chuyển đến trang admin
            header("Location: /DoAnPHP/trangchuadmin.php");
            exit();
        } else {
            $_SESSION["QUYEN"] = 0;
            header("Location: /DoAnPHP/trangchu.php");
            exit();
        }
    }
    else {
        header("Location: /DoAnPHP/dangnhap.php?error=error");
        exit();
    }
} else {
    header("Location: /DoAnPHP/dangnhap.php?error=error");
    exit();
}
?>
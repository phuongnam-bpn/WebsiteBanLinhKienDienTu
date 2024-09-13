<?php 

include("./include/Connect.php");

if (!empty($_POST['binhluan'])) {
    $binhluan = $_POST['binhluan'];
    $maDonHang = $_POST['MaDH'];
    $sosao = $_POST['rating'];

    // Cập nhật bảng DONHANG
    $update = "UPDATE DONHANG SET DanhGiaTuKhachHang = :binhluan, SoSaoDanhGia = :sosao WHERE MaDonHang = :maDonHang";
    $sta = $pdo->prepare($update);
    $sta->execute([':binhluan' => $binhluan, ':sosao' => $sosao, ':maDonHang' => $maDonHang]);

    // Cập nhật bảng SanPham
    $sql = "UPDATE SanPham
            JOIN ChiTietDonHang ON ChiTietDonHang.MaSP = SanPham.MaSP
            JOIN DonHang ON DonHang.MaDonHang = ChiTietDonHang.MaDonHang
            SET SanPham.SoSaoDanhGia = ROUND((SanPham.SoSaoDanhGia * SanPham.SoLuongDanhGia + :sosao) / (SanPham.SoLuongDanhGia + 1), 1),
                SanPham.SoLuongDanhGia = SanPham.SoLuongDanhGia + 1
            WHERE DonHang.MaDonHang = :maDonHang";
    $sta = $pdo->prepare($sql);
    $sta->execute([':sosao' => $sosao, ':maDonHang' => $maDonHang]);

    // Chuyển hướng sau khi hoàn thành
    header("Location: /DoAnPHP/giohang.php");
    exit();
}

header("Location: /DoAnPHP/lichsudonhang.php");
exit();

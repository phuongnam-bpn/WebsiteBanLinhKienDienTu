<?php
include("./include/Connect.php");
include("./PHPMail/functionSendMail.php");
session_start();
if (!empty($_SESSION['MaKhachHang'])) {

    $maKH = $_SESSION['MaKhachHang'];
    //
    $sql = "SELECT * FROM DONHANG WHERE MaKhachHang = $maKH ORDER BY MaDonHang DESC LIMIT 1";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    //
    $donhanghientai = $sta->fetch(PDO::FETCH_ASSOC);
    $maDonHang = $donhanghientai['MaDonHang'];
    $TongTien = $_SESSION['total'];
    $TienPhaiTra = $_SESSION['tienPhaiTra'];
    $TienGiamGia = $_SESSION['diemTL'];
    $dayNow = date("Y-m-d");
    //Lấy ngẫu nhiên ảnh của đơn hàng để làm ảnh đại diện
    $sql = "select * from SanPham,ChiTietDonHang where SanPham.MaSP = ChiTietDonHang.MaSP and MaDonHang = $maDonHang limit 1";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    $temp = $sta->fetch(PDO::FETCH_ASSOC);
    $hinh = $temp['Anh'];
    //---------------------------------------
    //Khi thanh toán thì chắc chắn đơn hàng này đã nằm trong giỏ nên không cần kiểm tra :
    $sql = "Update DONHANG SET TongTienPhaiTra = $TienPhaiTra, TienGiamGia = $TienGiamGia, TongTien = $TongTien,HinhAnhDaiDien = '$hinh',ThoiGianDatHang = '$dayNow', TrongGioHang = 0,TrangThai = 'Đang giao' where MaDonHang = $maDonHang";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    //Lấy ra khách hàng để trừ điểm tích lũy
    //
    $sql = "Update user set DiemTichLuy = DiemTichLuy - $TienGiamGia WHERE MaKhachHang = $maKH";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    $khachHang = $sta->fetch(PDO::FETCH_ASSOC);

    $sql = "Select * from user WHERE MaKhachHang = $maKH";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    $khachHang = $sta->fetch(PDO::FETCH_ASSOC);
    $emailKH = $khachHang['Email'];

    sendEmail("$emailKH", 'Mail xác nhận', "Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi.");

    header("Location: /DoAnPHP/thongbaoxacnhan.php");
    exit;
}

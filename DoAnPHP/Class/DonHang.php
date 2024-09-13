<?php

class DonHang
{
    public $MaDonHang, $MaKhachHang, $TongTien, $TrangThai, $ThoiGianDatHang,$TrongGioHang, $HinhAnhDaiDien, $DanhGiaTuKhachHang, $SoSaoDanhGia, $TienGiamGia, $TongTienPhaiTra;
    public function __construct($MaDonHang, $MaKhachHang, $TongTien, $TrangThai, $ThoiGianDatHang, $DiaChi, $TrongGioHang, $HinhAnhDaiDien, $DanhGiaTuKhachHang, $SoSaoDanhGia, $TienGiamGia, $TongTienPhaiTra)
    {
        $this->MaDonHang = $MaDonHang;
        $this->MaKhachHang = $MaKhachHang;
        $this->TongTien = $TongTien;
        $this->TrangThai = $TrangThai;
        $this->ThoiGianDatHang = $ThoiGianDatHang;
        $this->TrongGioHang = $TrongGioHang;
        $this->HinhAnhDaiDien = $HinhAnhDaiDien;
        $this->DanhGiaTuKhachHang = $DanhGiaTuKhachHang;
        $this->SoSaoDanhGia = $SoSaoDanhGia;
        $this->TienGiamGia = $TienGiamGia;
        $this->TongTienPhaiTra = $TongTienPhaiTra;
    }
    public static function getLastDonHang(PDO $pdo, int $maKH)
    {
        try {
            $sql = "SELECT * FROM DONHANG WHERE MaKhachHang = $maKH ORDER BY MaDonHang DESC LIMIT 1";
            $sta = $pdo->query($sql);
            return $sta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public static function getChiTietDonHang(PDO $pdo, int $MaDH)
    {
        try {
            $sql = "select SanPham.*,SoLuong,ThanhTien from SanPham, ChiTietDonHang where SanPham.MaSP = ChiTietDonHang.MaSP and ChiTietDonHang.MaDonHang = $MaDH";
            $sta = $pdo->query($sql);
            return $sta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

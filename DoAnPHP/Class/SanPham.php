<?php
class SanPham
{
    public $MaSP, $MaLoaiSP, $TenSP,  $MoTaSP,  $GiaSP, $KhuyenMai, $Anh, $SoSaoDanhGia, $SoLuongDanhGia, $SoLuongTon;
    public function __construct($MaSP, $MaLoaiSP, $TenSP,  $MoTaSP, $GiaSP, $KhuyenMai, $Anh, $SoSaoDanhGia, $SoLuongDanhGia, $SoLuongTon)
    {
        $this->MaSP = $MaSP;
        $this->MaLoaiSP = $MaLoaiSP;
        $this->TenSP = $TenSP;
        $this->MoTaSP = $MoTaSP;
        $this->GiaSP = $GiaSP;
        $this->KhuyenMai = $KhuyenMai;
        $this->Anh = $Anh;
        $this->SoSaoDanhGia = $SoSaoDanhGia;
        $this->SoLuongDanhGia = $SoLuongDanhGia;
        $this->SoLuongTon = $SoLuongTon;
    }
    public static function getSPById(PDO $pdo, int $id)
    {
        try {
            $sql = "SELECT * FROM `sanpham` WHERE `MaLoaiSP` = $id";
            $sta = $pdo->query($sql);
            return $sta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

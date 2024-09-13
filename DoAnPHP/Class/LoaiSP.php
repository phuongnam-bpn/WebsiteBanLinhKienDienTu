<?php
class LoaiSanPham
{
    public $MaLoai, $TenLoai, $Anh, $MoTa;
    public function __construct($MaLoai, $TenLoai, $Anh, $MoTa)
    {
        $this->MaLoai = $MaLoai;
        $this->TenLoai = $TenLoai;
        $this->Anh = $Anh;
        $this->MoTa = $MoTa;
    }
    public static function getAllLoaiSP(PDO $pdo)
    {
        try {
            $sql = "SELECT * FROM `loaisanpham`";
            $sta = $pdo->query($sql);
            return $sta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public static function getSPById(PDO $pdo, int $id)
    {
        try {
            $sql = "SELECT * FROM `loaisanpham` WHERE `MaLoaiSP` = $id";
            $sta = $pdo->query($sql);
            return $sta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

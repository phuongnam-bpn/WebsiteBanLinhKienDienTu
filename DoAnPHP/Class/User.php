<?php

class User
{
    public $MaKH, $TenKH, $SDT, $Email, $Pass, $DiaChi, $Quyen, $DiemTichLuy;
    public function __construct($MaKH, $TenKH, $SDT, $Email, $Pass, $DiaChi, $Quyen, $DiemTichLuy)
    {
        $this->MaKH = $MaKH;
        $this->TenKH = $TenKH;
        $this->SDT = $SDT;
        $this->Email = $Email;
        $this->Pass = $Pass;
        $this->DiaChi = $DiaChi;
        $this->Quyen = $Quyen;
        $this->DiemTichLuy = $DiemTichLuy;
    }
    public static function getAllUser(PDO $pdo)
    {
        try {
            $sql = "SELECT * FROM `user`";
            $sta = $pdo->query($sql);
            return $sta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public static function getUser(PDO $pdo, int $maKH)
    {
        try {
            $sql = "SELECT * FROM `user` where MaKhachHang = $maKH";
            $sta = $pdo->query($sql);
            return $sta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

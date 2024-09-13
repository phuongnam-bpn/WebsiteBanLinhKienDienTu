<?php 
include("./include/Connect.php");
if(!empty($_POST['MaSP'])){
    $MaSP=$_POST['MaSP'];
    $MaDH = $_POST['MaDH'];
    $delete="DELETE FROM `ChiTietDonHang` WHERE MaSP= $MaSP and MaDonHang = $MaDH";
    $sta = $pdo->prepare($delete);
    $sta = $sta->execute();
    //Sau khi xóa xong xem thử còn dòng nào không
    //Nếu không còn thì xóa luôn đon hàng
    $sql = "Select * from `ChiTietDonHang` where MaDonHang = $MaDH";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    if  ($sta->rowCount() == 0)
    {
        $sql = "DELETE FROM `DonHang` where MaDonHang = $MaDH";
        $sta = $pdo->prepare($sql);
        $sta = $sta->execute();
    }
    header("Location: /DoAnPHP/giohang.php");
    exit();
}
header("location: ../giohang.php?error");
exit();
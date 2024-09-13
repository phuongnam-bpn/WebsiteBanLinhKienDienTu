<?php 

include("./include/Connect.php");
session_start();
if(!empty($_SESSION['MaKhachHang'])){
    
    if(!empty($_GET['MaSP'])){
        $maSP=$_GET['MaSP'];
        $maKH=$_SESSION['MaKhachHang'];
        //Bốc trong database xem đơn hàng của mã khách hàng :
        $sql = "SELECT * FROM DONHANG WHERE MaKhachHang = $maKH ORDER BY MaDonHang DESC LIMIT 1";
        $sta = $pdo->prepare($sql);
        $sta->execute();
        //Nếu khách hàng đã có đơn hàng thì kiểm tra xem đơn hàng đó có set trạng thái giỏ không
        if($sta->rowCount() > 0)
        {         
            //ĐỔ dữ liệu ra đơn hàng   
            $donhanghientai = $sta->fetch(PDO::FETCH_ASSOC);
            //Nếu như đơn hàng này đã thanh toán rồi không còn trong giỏ nữa
            if($donhanghientai["TrongGioHang"] == 0)
            {
                //Tạo mới 1 đơn hàng
                $sql = "INSERT INTO `donhang`(`MaKhachHang`,`TrongGioHang`) VALUES ($maKH,1)";
                $sta = $pdo->prepare($sql);
                $sta->execute();
                //Sau khi tạo mới xong thì lấy đơn hàng vừa tạo
                $sql = "SELECT * FROM DONHANG WHERE MaKhachHang = $maKH ORDER BY MaDonHang DESC LIMIT 1";
                $sta = $pdo->prepare($sql);
                $sta->execute();
                $donhanghientai = $sta->fetch(PDO::FETCH_ASSOC);
            }
            //Ngược lại chưa thanh toán vẫn còn trong giỏ thì bỏ qua
        }
        //Ngược lại Nếu = 0  là khách hàng mới, chưa có đơn hàng nào
        else if($sta->rowCount() == 0)
        {
            //Tạo mới 1 đơn hàng
            $sql = "INSERT INTO `donhang`(`MaKhachHang`,`TrongGioHang`) VALUES ($maKH,1)";
            $sta = $pdo->prepare($sql);
            $sta->execute();
            //Sau khi tạo mới xong thì lấy đơn hàng vừa tạo
            $sql = "SELECT * FROM DONHANG WHERE MaKhachHang = $maKH ORDER BY MaDonHang DESC LIMIT 1";
            $sta = $pdo->prepare($sql);
            $sta->execute();
            $donhanghientai = $sta->fetch(PDO::FETCH_ASSOC);
        }
        //Sau câu lệnh if else trên thì đã lấy được mã đơn hàng trong giỏ chưa thanh toán :
        $maDonHang = $donhanghientai["MaDonHang"];
        //
        $sql="SELECT * FROM `chitietdonhang` WHERE MaDonHang='$maDonHang' and MaSP='$maSP'";
        $sta = $pdo->prepare($sql);
        $sta->execute();
        //Nếu như đã có sản phẩm này trong giỏ
        if($sta->rowCount() > 0){
            $chitiet = $sta->fetch(PDO::FETCH_ASSOC);
            $soLuongMoi = $chitiet['SoLuong']+1;
            $insert="UPDATE chitietdonhang SET SoLuong=$soLuongMoi WHERE MaDonHang='$maDonHang' and MaSP='$maSP'";
        }else{
            //Chưa có trong giỏ
            $insert="INSERT INTO `chitietdonhang`(`MaDonHang`, `MaSP`, `SoLuong`) VALUES ('$maDonHang','$maSP',1)";
        }
        $sta = $pdo->prepare($insert);
        $sta->execute();
        //Sau khi thêm xong 
        //Load giỏ hàng
        header("Location: /DoAnPHP/giohang.php");
        exit();
    }
}
header("Location: /DoAnPHP/dangnhap.php");
exit();
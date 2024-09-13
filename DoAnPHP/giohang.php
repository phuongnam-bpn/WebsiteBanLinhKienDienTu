<?php include("./include/Connect.php");?>
<!-- header -->
<?php include("./include/layout/header.php"); ?>
<?php 
    if(!empty($_SESSION['MaKhachHang'])){
        $maKH=$_SESSION['MaKhachHang'];
    }
    if(!empty($maKH)){
        //Nếu như đã đăng nhập lấy ra ChiTietDonHang của DonHang cuối cùng hiện lên :
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
                //Khách hàng chưa có đơn hàng
                //Xuất câu thông báo
                $thongBao = "Quý khách hiện chưa có sản phẩm nào. Vui lòng thêm vào giỏ hàng !!!";
            }
            //Ngược lại chưa thanh toán vẫn còn trong giỏ thì hiển thị giỏ hàng :
            else {
                $maDonHang = $donhanghientai["MaDonHang"];
                $sql = "select SanPham.*,SoLuong,ThanhTien from SanPham, ChiTietDonHang where SanPham.MaSP = ChiTietDonHang.MaSP and ChiTietDonHang.MaDonHang = $maDonHang";
                $sta = $pdo->prepare($sql);
                $sta->execute();
                $dulieugio = $sta->fetchAll(PDO::FETCH_ASSOC);
                $total=0;
            }
        }
        else {
            //Khách hàng là kh mới chưa có đơn hàng
            //Xuất câu thông báo
            $thongBao = "Quý khách hiện chưa có sản phẩm nào. Vui lòng thêm vào giỏ hàng !!!";
        }
    }
?>
<link href="./content/css/GioHang.css" rel="stylesheet" />
<div class="container">
<div class="row">
    <h2>Giỏ Hàng</h2>
        <?php if(!empty($dulieugio) && count($dulieugio) >0){?>

            <div class="col-lg-9 col-md-12 col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-danger">
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên SP</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn Giá</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Xoá</th>
                        </tr>
                    </thead>
                    <?php foreach($dulieugio as $each){?>
                        <tbody>
                            <tr>
                                <?php 
                                    $sl=$each['SoLuong'];
                                    $temp=$sl*$each['KhuyenMai'];
                                    $total+=$temp;
                                ?>
                                <td><img src="./include/Images/ImagesSP/<?php echo $each['Anh']?>" alt="Alternate Text" /></td>
                                <td><a href="./thongtinSP.php?MaSP=<?php echo $each['MaSP']?>"><?php echo $each['TenSP']?></a></td>
                                <td>
                                    <form action="./capnhatsoluong.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="maSP" value="<?php echo $each['MaSP']?>" />
                                        <input type="hidden" name="maDonHang" value="<?php echo $maDonHang; ?>" />
                                        <input type="number" class="num" name="soLuong" value="<?php echo $each['SoLuong']?>" min="1" />
                                        <button class="btn" class="update" type="submit"></button>
                                    </form>
                                </td>
                                <td><?php echo number_format($each['KhuyenMai'], 0, ".", ",")?> đ</td>
                                <td><?php echo number_format($temp, 0, ".", ",")?> đ</td>
                                <td>
                                    <form action="./xoaitemgiohang.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="MaSP" value="<?php echo $each['MaSP'] ?>">
                                        <input type="hidden" name="MaDH" value="<?php echo $maDonHang; ?>">
                                        <button class="btn" type="submit"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    <?php }?>

                </table>
            </div>
            <div class="col-lg-3 col-md-12 col-12">
                <div class="row">
                    <div class="col-6">Tổng tiền</div>
                    <div class="col-6"><?php echo number_format($total, 0, ".", ",")?> đ</div>
                </div>
                <div class="row action-product">
                    <div class="col-6">
                        <a href="./sanpham.php" class="btn action-1">TIẾP TỤC MUA</a>
                    </div>
                    <div class="col-6">
                        <form action="./trangthanhtoan.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="MaDH" value="<?php echo $maDonHang; ?>">
                            <button class="btn action-2" type="submit">THANH TOÁN</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php 
        } else {?>
        <div class="info-none-product">
            <img src="https://theme.hstatic.net/200000420363/1001121558/14/empty_cart.png?v=680" width="30%" />
            <h3>Không có sản phẩm nào trong giỏ hàng</h3>
            <a href="./sanpham.php" class="btn">Quay trở lại trang sản phẩm</a>
        </div>
    <?php }?>
</div>

<!-- Footer -->
<?php include("./include/layout/footer.php"); ?>
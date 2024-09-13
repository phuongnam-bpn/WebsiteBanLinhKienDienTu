<?php include("./include/Connect.php");?>
<!-- header -->
<?php include("./include/layout/header.php"); ?>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
<?php 
    if(!empty($_SESSION['MaKhachHang'])){
        $maKH=$_SESSION['MaKhachHang'];
    }
    if(!empty($maKH)){
        //Nếu như đã đăng nhập lấy ra DonHang từ URL :
        $maDH = $_GET['maDH'];
        //Bốc trong database xem đơn hàng của mã khách hàng :
        $sql = "SELECT * FROM DONHANG WHERE MaDonHang = $maDH";
        $sta = $pdo->prepare($sql);
        $sta->execute();
        $donhanghientai = $sta->fetch(PDO::FETCH_ASSOC);
        //Đơn hàng này chắc chắc có dữ liệu chitiet :
        $sql = "select SanPham.*,SoLuong,ThanhTien from SanPham, ChiTietDonHang where SanPham.MaSP = ChiTietDonHang.MaSP and ChiTietDonHang.MaDonHang = $maDH";
        $sta = $pdo->prepare($sql);
        $sta->execute();
        $dulieugio = $sta->fetchAll(PDO::FETCH_ASSOC);
        $total=0;
    }
?>
<link href="./content/css/GioHang.css" rel="stylesheet" />
<div class="container">
<div class="row">
    <h3 class="text-danger">Chi tiết đơn hàng</h3>
        <?php if(!empty($dulieugio) && count($dulieugio) >0){?>

            <div class="col-lg-12 col-md-12 col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-danger">
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên SP</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn Giá</th>
                            <th scope="col">Thành tiền</th>
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
                                        <input type="number" class="num" name="soLuong" value="<?php echo $each['SoLuong']?>" min="1" readonly/>
                                        <button class="btn" class="update" type="submit"></button>
                                    </form>
                                </td>
                                <td><?php echo number_format($each['KhuyenMai'], 0, ".", ",")?> đ</td>
                                <td><?php echo number_format($temp, 0, ".", ",")?> đ</td>
                            </tr>
                        </tbody>
                    <?php }?>

                </table>
                <div class="col-lg-3 col-md-12 col-12" style="margin-bottom: 120px;">
                <div class="row col-lg-3" style="position: absolute; right: 20px;">
                    <div class="col-5 text-dark">Tổng tiền :</div>
                    <div class="col-7 text-danger"><?php echo number_format($total, 0, ".", ",")?> đ</div>
                </div>
            </div>
            <?php
                if($donhanghientai["TrangThai"] == "Đã giao" && $donhanghientai["DanhGiaTuKhachHang"] == "")
                {
            ?>
                <h4 class="text-danger">Viết đánh giá cho Đơn hàng này</h4>
                    <form action="./vietdanhgia.php" method="POST">
                    <h5 class="text-dark">Số sao sản phẩm:</h>
                        <div class="rating">
                            <select name="rating" id="rating" required>
                                <option value="">Chọn số sao</option>
                                <option value="1">1 sao</option>
                                <option value="2">2 sao</option>
                                <option value="3">3 sao</option>
                                <option value="4">4 sao</option>
                                <option value="5">5 sao</option>
                            </select>
                        </div>
                        <hr>
                        <div class="mb-3 mt-3">
                        <label for="comment">Bình luận:</label>
                        <textarea class="form-control" rows="5" id="comment" name="binhluan"></textarea>
                        <input type="hidden" name="MaDH" value="<?php echo $donhanghientai['MaDonHang']; ?>">
                        </div>
                        <button type="submit" class="btn btn-danger">Gửi</button>
                    </form>
            <?php
                }
            ?>
            
            </div>
            
        <?php 
        } else {?>
        <div class="info-none-product">
            <img src="https://theme.hstatic.net/200000420363/1001121558/14/empty_cart.png?v=680" width="30%" />
            <h3>Load thất bại</h3>
            <a href="./sanpham.php" class="btn">Quay trở lại trang sản phẩm</a>
        </div>
    <?php }?>
</div>

<!-- Footer -->
<?php include("./include/layout/footer.php"); ?>
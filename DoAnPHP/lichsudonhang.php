<?php include("./include/Connect.php");?>
<!-- header -->
<?php include("./include/layout/header.php"); ?>
<?php
if(!empty($_SESSION['MaKhachHang'])){
    $maKH=$_SESSION['MaKhachHang'];
    $sql = "Select * from DonHang where MaKhachHang = $maKH and TrongGioHang = 0";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    if($sta->rowCount() > 0)
    {
        $danhsachdonhang = $sta->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        $empty = 1;
    }
}
else{
    $chuaDangNhap = 1;
} 
?>
<div class="container" width="70%">
    <h2>Lịch sử đơn hàng</h2>
    <?php
        if(!empty($empty))
        //Nếu chưa có đơn hàng nào
        {
    ?>  <p><center>Bạn chưa có đơn hàng nào. Hãy cùng mua sắm nào</center></p>
            <center><h4><a href="./sanpham.php">Trang sản phẩm</a></h4></center>
    <?php
        }
        else{
        //Khách hàng đã có đơn hàng
    ?>
        <table class="table table-bordered table-hover table-striped">
        <tr class="table-danger">
            <td>Ảnh đại diện</td>
            <td>Thời gian đặt hàng</td>
            <td>Tổng tiền</td>
            <td>Tiền giảm giá</td>
            <td>Tổng tiền phải trả</td>
            <td>Trạng thái giao hàng</td>
            <td> </td>
        </tr>
        <?php
            foreach($danhsachdonhang as $item)
            {
        ?>
            <tr>
                <td><img width="30%" src="./include/Images/ImagesSP/<?php echo $item["HinhAnhDaiDien"];?>" alt=""></td>
                <td><?php echo $item["ThoiGianDatHang"]; ?></td>
                <td><?php echo number_format($item["TongTien"]); ?></td>
                <td><?php echo number_format($item["TienGiamGia"]); ?></td>
                <td><?php echo number_format($item["TongTienPhaiTra"]); ?></td>
                <?php
                    if($item["TrangThai"] == "Đã giao")
                    {
                ?>
                    <td class="table-success"><?php echo $item["TrangThai"]; ?></td>
                <?php
                    }
                    else{
                ?>
                        <td class="table-warning"><?php echo $item["TrangThai"]; ?></td>
                <?php
                    }
                ?>
                
                <td><a style="color:burlywood !important" href="./xemdonhang.php?maDH=<?php echo $item["MaDonHang"]; ?>">Xem chi tiết</a></td>
            </tr>
        <?php
            }
        ?>
    </table>
    <?php
        }
    ?>
</div>
<?php include("./include/layout/footer.php"); ?>
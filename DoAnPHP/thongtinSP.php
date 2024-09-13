<?php
include("./include/Connect.php");

$masp = !empty($_GET["MaSP"]) ? $_GET["MaSP"] : null;

if ($masp) {
    $sql = "SELECT * FROM `sanpham` WHERE `MaSP` = $masp";
    $sta = $pdo->prepare($sql);
    $sta->execute();

    if ($sta->rowCount() > 0) {
        $sanpham = $sta->fetch(PDO::FETCH_ASSOC);
    }
    $sql2 = "SELECT donhang.MaKhachHang, donhang.DanhGiaTuKhachHang, chitietdonhang.MaSP, user.TenKhachHang FROM donhang JOIN chitietdonhang ON donhang.MaDonHang = chitietdonhang.MaDonHang JOIN user ON donhang.MaKhachHang = user.MaKhachHang WHERE chitietdonhang.MaSP = $masp";
    $sta2 = $pdo->prepare($sql2);
    $sta2->execute();
    if ($sta2->rowCount() > 0) {
        $binhluan = $sta2->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
<link href="./include/style/homeIndex.css" rel="stylesheet" />
<title>Tin học ngôi sao</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="./include/style/responesive.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link href="./include/style/layout.css" rel="stylesheet" />
<style>
    .material-symbols-outlined {
        color: #f3e24e;
    }
</style>
<div class="container">
<?php include("./include/layout/header.php"); ?>  
    <div class="row">
        <div class="col-lg-5 mt-5">
            <h4><?php echo $sanpham["TenSP"] ?></h4>
        </div>
        <div class="d-flex col-lg-7 align-items-center">
            <h3 class="mb-0 me-2">Đánh giá: </h3>
            <h3 class="mb-0 me-2"><?php echo $sanpham["SoSaoDanhGia"]; ?></h3>
            <a href="#">
                <span class="material-symbols-outlined">
                    star_rate
                </span>
            </a>
        </div>
        <hr>
        <?php ?>
        <div class="col-lg-5 col-md-4 col-1">
            <img src="./include/Images/ImagesSP/<?php echo $sanpham["Anh"] ?>" alt="">
        </div>
        <div class="col-lg-7 col-md-8 col-1">
            <div class="d-flex" style=" align-items: center;">
                <strong class="mx-1">Giá bán:</strong>
                <h3 style="font-weight: bold; text-decoration: line-through;">
                    <?php echo number_format($sanpham['GiaSP'], 0, ".", ","); ?> đ
                </h3>
            </div>
            <div class="d-flex">
                <strong class="mx-1">Mô tả sản phẩm:</strong>
                <?php echo $sanpham["MoTaSP"]; ?>
            </div>
            <div class="d-flex" style="align-items: center; color: #c11717;">
                <strong class="mx-1">Khuyến mãi:</strong>
                <h2>
                    <?php echo number_format($sanpham['KhuyenMai'], 0, ".", ","); ?>đ
                </h2>
            </div>
            <div style="color: #c11717; font-weight: bold; margin-top: 1em;">
                KM MÁY BỘ STAR <span style="color: #007bff;">TẠI ĐÂY</span> ĐẾN 31/12/2024
            </div>
            <div style="font-weight: bold; margin-top: 0.5em;">
                MUA 1 TẶNG 5
            </div>
            <ul style="list-style-type: none; padding-left: 0; margin-top: 0.5em;">
                <li style="margin-bottom: 0.5em;">🎁 Chuột Gaming Redragon S101-M Led-White <a href="#" style="color: #007bff;">Tại đây</a></li>
                <li style="margin-bottom: 0.5em;">🎁 Bàn phím Gaming giả cơ Redragon S101-K-White <a href="#" style="color: #007bff;">Tại đây</a></li>
                <li style="margin-bottom: 0.5em;">🎁 Lót chuột Star Gaming cao cấp (CHỌN 1 TRONG 3 MÀU XANH | ĐỎ | XÁM )
                    <a href="#" style="color: #007bff;">Tại đây</a>
                </li>
                <li style="margin-bottom: 0.5em;">🎁 Tai Nghe VSP Gaming K8 LED <a href="#" style="color: #007bff;">Tại
                        đây</a></li>
                <li style="margin-bottom: 0.5em;">🎁 Mũ lưỡi trai Hp Victus</li>
            </ul>
            <ul style="list-style-type: none; padding-left: 0; margin-top: 0.5em;">
                <li style="margin-bottom: 0.5em;">✔️ Giá sản phẩm có thể thay đổi theo từng thời điểm. Không thay đổi
                    linh kiện để được áp dụng khuyến mãi</li>
                <li style="margin-bottom: 0.5em;">✔️ không áp dụng chung Khuyến mãi khác <a href="#" style="color: #007bff;">Tại đây</a></li>
                <li style="margin-bottom: 0.5em;">✔️ Xem thêm Gear <a href="#" style="color: #007bff;">Tại đây</a></li>
                <li style="margin-bottom: 0.5em;">💰 Trả góp <a href="#" style="color: #007bff;">Tại đây</a></li>
            </ul>
            <a class="btn btn-danger" style="width: 100%; padding: 2%;" href="">MUA NGAY</a>
            <div class="row d-flex my-2">
                <div class="col-6">
                    <a class="btn btn-primary" style="width: 100%; padding: 3%;" href="./themvaogio.php?MaSP=<?php echo $masp; ?>">THÊM VÀO GIỎ HÀNG</a>
                </div>
                <div class="col-6">
                    <a class="btn btn-primary" style="width: 100%; padding: 3%;" href="">TRẢ GÓP</a>

                </div>
            </div>
        </div>
        <hr>
        <div>
            <h4>ĐÁNH GIÁ CỦA KHÁCH HÀNG</h4>
            <?php
            if (empty($binhluan)) {
                echo "<p>Chưa có lượt đánh giá</p>";
            } else {
                foreach ($binhluan as $bl) {
                    if($bl["DanhGiaTuKhachHang"] != "")
                    {
            ?>
                    <div class="card mt-1">
                        <div class="card-body">
                            <h5 class="card-title text-danger" style="font-weight: bold;">
                                <?php echo htmlspecialchars($bl["TenKhachHang"]); ?></h5>
                            <p class="card-text">
                                <i class="fas fa-comments"></i>
                                <?php echo htmlspecialchars($bl["DanhGiaTuKhachHang"]); ?>
                            </p>
                        </div>
                    </div>
            <?php
                    }
                }
            }
            ?>


        </div>
        <?php ?>
    </div>
</div>
</div>
<?php
include("./include/layout/footer.php");
?>
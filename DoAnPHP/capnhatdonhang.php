

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sản phẩm</title>
 <!--Bootstrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <link href="./include/style/homeIndex.css" rel="stylesheet" />
    <style>
            
                .center-content {
                    margin: auto;
                   
                }
            
    </style>

</head>

<?php
include("./include/Connect.php");

if (!isset($_GET['mdh']) || !is_numeric($_GET['mdh'])) {
    die("Mã sản phẩm không hợp lệ.");
}

$tb = "";
$mdh = (int)$_GET['mdh'];
$sql = "SELECT * FROM donhang WHERE MaDonHang = :mdh";
$sta = $pdo->prepare($sql);
$sta->execute(['mdh' => $mdh]);
if ($sta->rowCount() > 0) {
    $donhang = $sta->fetchAll(PDO::FETCH_BOTH);
}
foreach ($donhang as $dh) {
    $maKH = $dh['MaKhachHang'];
    $tongTien = $dh['TongTien'];
    $trangThai = $dh['TrangThai'];
    $thoiGiaDH = $dh['ThoiGianDatHang'];
    $trongGH = $dh['TrongGioHang'];
    $hinh = $dh['HinhAnhDaiDien'];
    $danhGiaTuKH = $dh['DanhGiaTuKhachHang'];
    $soSaoDG = $dh['SoSaoDanhGia'];
    $tienGiamGia = $dh['TienGiamGia'];
    $tongTienPhaiTra = $dh['TongTienPhaiTra'];
}

if (isset($_POST["btnUpdate"])) {
    $tongTien = $_POST["txtTongTien"];
    $trangThai = $_POST["txtTrangThai"];
    $thoiGianDH = $_POST["txtThoiGianDatHang"];
    $trongGH = $_POST["txtTrongGH"];
    $hinh = $_FILES["image"]["error"] == 0 ? $_FILES["image"]["name"] : $hinh;
    $danhGiaTuKH = $_POST["txtDanhGia"];
    $soSaoDG = $_POST["txtSoSaoDG"];
    $tienGiamGia = $_POST["txtTienGiamGia"];
    $tongTienPhaiTra = $_POST["txtTongTienPhaiTra"];
        $sql = "UPDATE donhang SET TongTien = :tongTien, TrangThai = :trangThai, ThoiGianDatHang = :thoiGianDH, TrongGioHang = :trongGH, HinhAnhDaiDien = :hinh, DanhGiaTuKhachHang = :danhGiaTuKH, SoSaoDanhGia = :soSaoDG, TienGiamGia = :tienGiamGia, TongTienPhaiTra = :tongTienPhaiTra WHERE MaDonHang = :mdh";
        $sta = $pdo->prepare($sql);
        $params = [
            'tongTien' => $tongTien,
            'trangThai' => $trangThai,
            'thoiGianDH' => $thoiGianDH,
            'trongGH' => $trongGH,
            'hinh' => $hinh,
            'danhGiaTuKH' => $danhGiaTuKH,
            'soSaoDG' => $soSaoDG,
            'tienGiamGia' => $tienGiamGia,
            'tongTienPhaiTra' => $tongTienPhaiTra,
            'mdh' => $mdh
        ];
        $kq = $sta->execute($params);

        if ($kq) {
            $tb = "Cập nhật thành công";
            if ($_FILES["image"]["error"] == 0) {
                move_uploaded_file($_FILES["image"]["tmp_name"], "./include/Images/ImagesSP/$hinh");
            }
        } else {
            $tb = "Không thể cập nhật";
        }
}
$sql1 = "SELECT MaKhachHang FROM user";
$sta1 = $pdo->prepare($sql1);
$sta1->execute();
$khachhang = $sta1->fetchAll(PDO::FETCH_OBJ);
?>
<body>
<?php include("./include/layout/header.php"); ?>
<div class="container">
   
    <div id="Content" class="row">

        <div class="col-8 center-content">
            <br>
            <br>
            <h2 align="center">CẬP NHẬT ĐƠN HÀNG</h2>
            <form method="post" action="./capnhatdonhang.php?mdh=<?php echo $mdh;?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtTongTien">Tổng tiền</label>
                <input type="number" class="form-control" name="txtTongTien" id="txtTongTien" value="<?php echo $tongTien; ?>" required>
                </div>
                <div class="form-group">
                    <label for="txtTrangThai">Trạng thái</label>
                    <input type="text" class="form-control" name="txtTrangThai" id="txtTrangThai" value="<?php echo $trangThai; ?>" required>
                </div>
                <div class="form-group">
                    <label for="txtThoiGianDatHang">Thời gian đặt hàng</label>
                    <input type="date" class="form-control" name="txtThoiGianDatHang" id="txtThoiGianDatHang" value="<?php echo $thoiGiaDH; ?>" required>
                </div>
                <div class="form-group">
                    <label for="txtTrongGH">Trống giỏ hàng</label>
                    <input type="number" class="form-control" name="txtTrongGH" id="txtTrongGH" value="<?php echo $trongGH; ?>">
                </div>
                <div class="form-group">
                    <label for="image">Hình ảnh đại diện</label>
                    <input type="file" class="form-control" name="image" id="image">
                    <input type="hidden" name="existing_image" value="<?php echo $hinh; ?>">
                </div>
                <div class="form-group">
                    <label for="txtSoSaoDG">Đánh giá từ khách hàng</label>
                    <input type="text"  class="form-control" name="txtDanhGia" id="txtSoSaoDG" value="<?php echo $danhGiaTuKH; ?>">
                </div>
                <div class="form-group">
                    <label for="txtSoSaoDG">Số sao đánh giá</label>
                    <input type="number" step="0.1" class="form-control" name="txtSoSaoDG" id="txtSoSaoDG" value="<?php echo $soSaoDG; ?>">
                </div>
                <div class="form-group">
                    <label for="txtTienGiamGia">Tiền giảm giá</label>
                    <input type="number" class="form-control" name="txtTienGiamGia" id="txtTienGiamGia" value="<?php echo $tienGiamGia; ?>">
                </div>
                <div class="form-group">
                    <label for="txtTongTienPhaiTra">Tổng tiền phải trả</label>
                    <input type="number" class="form-control" name="txtTongTienPhaiTra" id="txtTongTienPhaiTra" value="<?php echo $tongTienPhaiTra; ?>">
                </div>
                <div class="form-group text-danger">
                    <?php if (isset($tb)) echo $tb; ?>
                </div>
                <button type="submit" class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' name="btnUpdate">Cập nhật</button>
                <button class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' name="btnSubmit"><a class="text-light "href="LayoutAdminOrder.php"> Show Orders</a></button>
            </form>
        </div>
        
</div>
<?php include("./include/layout/footer.php"); ?>
</body>
</html>
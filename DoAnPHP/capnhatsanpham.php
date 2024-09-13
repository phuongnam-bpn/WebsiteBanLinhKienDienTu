

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

if (!isset($_GET['msp']) || !is_numeric($_GET['msp'])) {
    die("Mã sản phẩm không hợp lệ.");
}

$tb = "";
$msp = (int)$_GET['msp'];
$sql = "SELECT * FROM sanpham WHERE MaSP = :msp";
$sta = $pdo->prepare($sql);
$sta->execute(['msp' => $msp]);
if ($sta->rowCount() > 0) {
    $san_pham = $sta->fetchAll(PDO::FETCH_BOTH);
}
foreach ($san_pham as $sp) {
    $maLoaiSP = $sp['MaLoaiSP'];
    $tenSP = $sp['TenSP'];
    $moTa = $sp['MoTaSP'];
    $gia = $sp['GiaSP'];
    $khuyenMai = $sp['KhuyenMai'];
    $hinh = $sp['Anh'];
    $soSaoDG = $sp['SoSaoDanhGia'];
    $soLuongDG = $sp['SoLuongDanhGia'];
    $soLuongTon = $sp['SoLuongTon'];
}

if (isset($_POST["btnUpdate"])) {
    $maLoaiSP = $_POST["txtMaLoaiSP"];
    $tenSP = $_POST["txtTenSP"];
    $moTa = $_POST["txtMoTaSP"];
    $gia = $_POST["txtGia"];
    $khuyenMai = $_POST["txtGiaKM"];
    $hinh = $_FILES["image"]["error"] == 0 ? $_FILES["image"]["name"] : $hinh;
    $soSaoDG = $_POST["txtSoSaoDG"];
    $soLuongDG = $_POST["txtSoLuongDG"];
    $soLuongTon = $_POST["txtSoLuongTon"];

    $sql = "SELECT * FROM sanpham WHERE TenSP = :tenSP AND MaSP != :msp";
    $sta = $pdo->prepare($sql);
    $sta->execute(['tenSP' => $tenSP, 'msp' => $msp]);

    if ($sta->rowCount() > 0) {
        $tb = "Tên này đã tồn tại trong CSDL";
    } else {
        $sql = "UPDATE sanpham SET MaLoaiSP = :maLoaiSP, TenSP = :tenSP, MoTaSP = :moTa, GiaSP = :gia, KhuyenMai = :khuyenMai, Anh = :hinh, SoSaoDanhGia = :soSaoDG, SoLuongDanhGia = :soLuongDG, SoLuongTon = :soLuongTon WHERE MaSP = :msp";
        $sta = $pdo->prepare($sql);
        $params = [
            'maLoaiSP' => $maLoaiSP,
            'tenSP' => $tenSP,
            'moTa' => $moTa,
            'gia' => $gia,
            'khuyenMai' => $khuyenMai,
            'hinh' => $hinh,
            'soSaoDG' => $soSaoDG,
            'soLuongDG' => $soLuongDG,
            'soLuongTon' => $soLuongTon,
            'msp' => $msp
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
}
?>
<body>
<?php include("./include/layout/header.php"); ?>
<div class="container">
   
    <div id="Content" class="row">

        <div class="col-8 center-content">
            <br>
            <br>
            <h2 align="center">CẬP NHẬT SẢN PHẨM</h2>
            <form method="post" action="./capnhatsanpham.php?msp=<?php echo $msp; ?>"  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtMaLoaiSP">Mã loại sản phẩm</label>
                    <input type="text" class="form-control" name="txtMaLoaiSP" id="txtMaLoaiSP" value="<?php echo $maLoaiSP; ?>">
                </div>
                <div class="form-group">
                    <label for="txtTenSP">Tên sản phẩm</label>
                <input type="text" class="form-control" name="txtTenSP" id="txtTenSP" value="<?php echo $tenSP; ?>">
                </div>
                <div class="form-group">
                    <label for="txtMoTaSP">Mô tả sản phẩm</label>
                    <input type="text" class="form-control" name="txtMoTaSP" id="txtMoTaSP" value="<?php echo $moTa; ?>">
                </div>
                <div class="form-group">
                    <label for="txtGia">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="txtGia" id="txtGia" value="<?php echo $gia; ?>">
                </div>
                <div class="form-group">
                    <label for="txtGiaKM">Khuyến mãi</label>
                    <input type="number" class="form-control" name="txtGiaKM" id="txtGiaKM" value="<?php echo $khuyenMai; ?>">
                </div>
                <div class="form-group">
                    <label for="image">Ảnh</label>
                    <input type="file" class="form-control" name="image" id="image">
                    <input type="hidden" name="existing_image" value="<?php echo $hinh; ?>">
                </
                </div>
                <div class="form-group">
                    <label for="txtSoSaoDG">Số sao đánh giá</label>
                    <input type="number" step="0.1" class="form-control" name="txtSoSaoDG" id="txtSoSaoDG" value="<?php echo $soSaoDG; ?>">
                </div>
                <div class="form-group">
                    <label for="txtSoLuongDG">Số lượng đánh giá</label>
                    <input type="number" class="form-control" name="txtSoLuongDG" id="txtSoLuongDG" value="<?php echo $soLuongDG; ?>">
                </div>
                <div class="form-group">
                    <label for="txtSoLuongTon">Số lượng tồn</label>
                    <input type="number" class="form-control" name="txtSoLuongTon" id="txtSoLuongTon" value="<?php echo $soLuongTon; ?>">
                </div>
                <div class="form-group text-danger">
                    <?php if (isset($tb)) echo $tb; ?>
                </div>
                <button type="submit" class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' name="btnUpdate">Cập nhật</button>
                <button class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' name="btnSubmit"><a class="text-light"href="./quanlisanpham.php"> Show Products</a></button>
            </form>
        </div>
        
</div>
<?php include("./include/layout/footer.php"); ?>
</body>
</html>
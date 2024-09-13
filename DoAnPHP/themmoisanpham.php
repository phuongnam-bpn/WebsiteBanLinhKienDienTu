

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Khách Hàng</title>
 <!--Bootstrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <link href="./include/style/homeIndex.css" rel="stylesheet" />
    <script src="js/Validate.js"></script>
    <style>
            
                .center-content {
                    margin: auto;
                   
                }
            
    </style>

</head>

<?php
    include("./include/Connect.php");

    if (isset($_POST["btnSubmit"])) {

        $maLoaiSP = $_POST["txtMaLoaiSP"];
        $tenSP = $_POST["txtTenSP"];
        $moTa = $_POST["txtMoTaSP"];
        $gia = $_POST["txtGia"];
        $khuyenMai = $_POST["txtGiaKM"];
        $hinh = $_FILES["image"]["error"] == 0 ? $_FILES["image"]["name"] : "";
        $soSaoDG = $_POST["txtSoSaoDG"];
        $soLuongDG = $_POST["txtSoLuongDG"];
        $soLuongTon = $_POST["txtSoLuongTon"];

        // Chỉ định các cột trong câu lệnh INSERT ngoại trừ MaSP
        $sql = "INSERT INTO sanpham (MaLoaiSP, TenSP, MoTaSP, GiaSP, KhuyenMai, Anh, SoSaoDanhGia, SoLuongDanhGia, SoLuongTon) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $param = array($maLoaiSP, $tenSP, $moTa, $gia, $khuyenMai, $hinh, $soSaoDG, $soLuongDG, $soLuongTon);
        $sta = $pdo->prepare($sql);
        $kq = $sta->execute($param);

        if ($kq) {
            $tb = "Thêm thành công";
            if ($hinh != "") {
                move_uploaded_file($_FILES["image"]["tmp_name"], "./include/Images/ImagesSP/$hinh");
            }
        } else {
            $tb = "Không thể thêm";
        }
    }


    $sql1 = "SELECT MaLoaiSP, TenLoaiSP FROM loaisanpham";
    $sta1 = $pdo->prepare($sql1);
    $sta1->execute();
    $loai_san_pham = $sta1->fetchAll(PDO::FETCH_OBJ);
?>
<body>
<?php include("./include/layout/header.php"); ?>
<div class="container">
   
    <div id="Content" class="row">
    <div class="col-8 center-content">
            <br>
            <br>
            <h2 align="center">TRANG THÊM MỚI SẢN PHẨM</h2>
            <form method="post" action="./themmoisanpham.php" enctype="multipart/form-data" onsubmit="return kiemTra();">
                <div class="form-group">
                    <label for="idMaLoai">Mã loại sản phẩm</label>
                    <select class="form-control" name="txtMaLoaiSP" id="idMaLoai" required>
                        <option value="">Chọn mã loại sản phẩm</option>
                        <?php foreach ($loai_san_pham as $loai) : ?>
                            <option value="<?php echo $loai->MaLoaiSP; ?>"><?php echo $loai->TenLoaiSP; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="txtTenSP" id="idName" required />
                </div>
                <div class="form-group">
                    <label>Mô tả sản phẩm</label>
                    <input type="text" class="form-control" placeholder="Nhập mô tả sản phẩm" name="txtMoTaSP" id="idMoTa" required />
                </div>
                <div class="form-group">
                    <label>Giá sản phẩm</label>
                    <input type="number" class="form-control" placeholder="Nhập giá sản phẩm" name="txtGia" />
                </div>
                <div class="form-group">
                    <label>Khuyến mãi</label>
                    <input type="number" class="form-control" placeholder="Nhập giá khuyến mãi" name="txtGiaKM" />
                </div>
                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" class="form-control" name="image" />
                </div>
                <div class="form-group">
                    <label>Số sao đánh giá</label>
                    <input type="text" class="form-control" placeholder="Nhập số sao đánh giá" name="txtSoSaoDG" />
                </div>
                <div class="form-group">
                    <label>Số lượng đánh giá</label>
                    <input type="text" class="form-control" placeholder="Nhập số lượng đánh giá" name="txtSoLuongDG" />
                </div>
                <div class="form-group">
                    <label>Số lượng tồn</label>
                    <input type="number" class="form-control" placeholder="Nhập số lượng tồn" name="txtSoLuongTon" step="0.01" />
                </div>
                <div class="form-group">
                    <button type="submit" class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' name="btnSubmit">Create</button>
                    <button class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' name="btnSubmit"><a class="text-light"href="./quanlisanpham.php"> Show Products</a></button>
                </div>
                 <div class="form-group text-danger">
                    <?php if (isset($tb)) echo $tb; ?>
                  
                </div>
              
            </form>
        </div>

            
        </div>
  
</div>
<?php include("./include/layout/footer.php"); ?>
</body>
</html>
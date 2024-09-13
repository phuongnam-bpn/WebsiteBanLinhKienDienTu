

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

</head>

<?php
	$pdo = new PDO("mysql:host=localhost;dbname=doanphp","root","");
    $pdo->query("set names utf8");
	//Xây dựng câu lệnh SQL ( loia mon an lay a loai ten loai mo ta)
  	$sql = "select * from sanpham";
	$sta = $pdo->prepare($sql);
	$sta->execute();
	$san_pham = $sta->fetchAll(PDO::FETCH_OBJ);


 

	?>
<body>
<?php include("./include/layout/header.php"); ?>
<div class="container">
    
    <div id="Content" class="row">
            <div class="col-12">
                <br />
                <h2 align="center">TRANG QUẢN LÝ SẢN PHẨM</h2>
                <br />
                <hr>
                <a href="./themmoisanpham.php" class="btn btn-danger">ADD NEW</a>
                <hr>
                <div class="container">
                    <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 18px; text-align: left;">
                        <tr style="background-color: #f2f2f2; color: #333; margin-right: 5px; padding-bottom: 10px;">
                            <th>Mã sản phẩm</th>
                            <th>Mã loại sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Mô tả sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Khuyến mãi </th>
                            <th>Ảnh</th>
                            <th>Số sao đánh giá</th>
                            <th>Số lượng đánh giá</th>
                            <th>Số lượng tồn</th>
                        </tr>
                        <?php foreach ($san_pham as $sp) : ?>
                            <tr style="border-bottom: 1px solid #cdcdcd; margin-right: 5px;">
                                <td style="padding-bottom: 5px;"><?php echo $sp->MaSP; ?></td>
                                <td><?php echo $sp->MaLoaiSP ?></td>
                                <td><?php echo $sp->TenSP ?></td>
                                <td><?php echo $sp->MoTaSP ?></td>
                                <td><?php echo $sp->GiaSP ?></td>
                               
                                <td><?php echo $sp->KhuyenMai ?></td>
                                <td><img src="./include/Images/ImagesSP/<?php echo $sp->Anh?>" alt="" style="width: 80px; height: 80px;">
                                </td>
                                <td><?php echo $sp->SoSaoDanhGia ?></td>
                                <td><?php echo $sp->SoLuongDanhGia ?></td>
                                <td><?php echo $sp->SoLuongTon ?></td>
                                <td>
                                    <a href='./capnhatsanpham.php?msp=<?php echo $sp->MaSP; ?>' class='btn btn-light' style='font-size:10px; text-align: left; border: 2px solid #333;'>UPDATE</a>
                                    <a href='./xoasanpham.php?msp=<?php echo $sp->MaSP; ?>' class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;'>DELETE</a>

                                </td>
                                
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
                            <?php if(isset($_SESSION['checkXoa']))
                            {
                                ?>
                                <span class="text-danger"> <?php echo $_SESSION['checkXoa']; ?></span>
                                <?php
                            } ?>
</div>
<?php include("./include/layout/footer.php"); ?>
</body>
</html>


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
  	$sql = "select * from donhang";
	$sta = $pdo->prepare($sql);
	$sta->execute();
	$donhang = $sta->fetchAll(PDO::FETCH_OBJ);


 

	?>
<body>
<?php include("./include/layout/header.php"); ?>
<div class="container">
    <div id="Content" class="row">
            <div class="col-12">
                <br />
                <h2 align="center">TRANG QUẢN LÝ ĐƠN HÀNG</h2>
                <br />
                <div class="container">
                    <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 18px; text-align: left;">
                        <tr style="background-color: #f2f2f2; color: #333; margin-right: 5px; padding-bottom: 10px;">
                            <th>Mã đơn hàng</th>
                            <th>Mã khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Trống giỏ hàng</th>
                            <th>Hình ảnh đại diện</th>
                            <th>Đánh giá từ khách hàng</th>
                            <th>Số sao đánh giá</th>
                            <th>Tiền giảm giá</th>
                            <th>Tổng tiền phải trả</th>
                        </tr>
                        <?php foreach ($donhang as $dh) : ?>
                            <tr style="border-bottom: 1px solid #cdcdcd; margin-right: 5px;">
                                <td style="padding-bottom: 5px;"><?php echo $dh->MaDonHang; ?></td>
                                <td><?php echo $dh->MaKhachHang ?></td>
                                <td><?php echo $dh->TongTien ?></td>
                                <td><?php echo $dh->TrangThai ?></td>
                                <td><?php echo $dh->ThoiGianDatHang ?></td>
                               
                                <td><?php echo $dh->TrongGioHang ?></td>
                                <td><img src="./include/Images/ImagesSP/<?php echo $dh->HinhAnhDaiDien?>" alt="" style="width: 80px; height: 80px;">
                                </td>
                                <td><?php echo $dh->DanhGiaTuKhachHang ?></td>
                                <td><?php echo $dh->SoSaoDanhGia ?></td>
                                <td><?php echo $dh->TienGiamGia ?></td>
                                <td><?php echo $dh->TongTienPhaiTra ?></td>
                                <td>
                                    <a href='./capnhatdonhang.php?mdh=<?php echo $dh->MaDonHang;?>' class='btn btn-light' style='font-size:14px; text-align: left; border: 2px solid #333;'>UPDATE</a>
                                </td>
                                
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
  
</div>
<?php include("./include/layout/footer.php"); ?>
</body>
</html>
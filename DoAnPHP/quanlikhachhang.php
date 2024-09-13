

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Usertitle>
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
  	$sql = "select * from user";
	$sta = $pdo->prepare($sql);
	$sta->execute();
	$user = $sta->fetchAll(PDO::FETCH_OBJ);


 

	?>
<body>
<?php include("./include/layout/header.php"); ?>
<div class="container">
    <div id="Content" class="row">
            <div class="col-12">
                <br />
                <h2 align="center">TRANG QUẢN LÝ KHÁCH HÀNG</h2>
                <br />
                <div class="container">
                    <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 18px; text-align: left;">
                        <tr style="background-color: #f2f2f2; color: #333; margin-right: 5px; padding-bottom: 10px;">
                            <th>Mã khách hàng</th>
                           
                            <th>Tên khách hàng </th>
                        
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Mật khẩu</th>
                            <th>Địa chỉ giao hàng</th>
                            <th>Quyền</th>
                            <th>Điển tích lũy</th>
                        </tr>
                        <?php foreach ($user as $u) : ?>
                            <tr style="border-bottom: 1px solid #cdcdcd; margin-right: 5px;">
                                <td style="padding-bottom: 5px;"><?php echo $u->MaKhachHang; ?></td>
                                <td><?php echo $u->TenKhachHang ?></td>
                                
                                <td><?php echo $u->SoDienThoai ?></td>
                                <td><?php echo $u->Email ?></td>
                                <td><?php echo $u->MatKhau ?></td>
                                <td><?php echo $u->DiaChiGiaoHang ?></td>
                                <td><?php echo $u->QUYEN ?></td>
                                <td><?php echo $u->DiemTichLuy ?></td>
                                <td>
                                    <a href='./capnhatkhachhang.php?mkh=<?php echo $u->MaKhachHang; ?>' class='btn btn-light' style='font-size:10px; text-align: left; border: 2px solid #333;'>UPDATE</a>
                                    <a href='./xoakhachhang.php?mkh=<?php echo $u->MaKhachHang; ?>' class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;'>DELETE</a>

                                </td>
                                
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
                            <?php if(isset($_SESSION['checkXoaKhachHang']))
                            {
                                ?>
                                <span class="text-danger"> <?php echo $_SESSION['checkXoa']; ?></span>
                                <?php
                            } ?>
</div>
<?php include("./include/layout/footer.php"); ?>
</body>
</html>
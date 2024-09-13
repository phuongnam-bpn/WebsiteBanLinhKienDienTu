<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Khách hàng</title>
 <!--Bootstrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <link href="./include/style/homeIndex.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
            
                .center-content {
                    margin: auto;
                   
                }
            
    </style>
</head>

<?php
include("./include/Connect.php");

if (!isset($_GET['mkh']) || !is_numeric($_GET['mkh'])) {
    die("Mã khách hàng không hợp lệ.");
}

$tb = "";
$mkh = (int)$_GET['mkh'];
$sql = "SELECT * FROM user WHERE MaKhachHang = :mkh";
$sta = $pdo->prepare($sql);
$sta->execute(['mkh' => $mkh]);
if ($sta->rowCount() > 0) {
    $user = $sta->fetchAll(PDO::FETCH_BOTH);
}
foreach ($user as $u) {
    $tenKH = $u['TenKhachHang'];
    $sDT = $u['SoDienThoai'];
    $email = $u['Email'];
    $matKhau = $u['MatKhau'];
    $diaChiGH = $u['DiaChiGiaoHang'];
    $quyen = $u['QUYEN'];
    $diemTichLuy = $u['DiemTichLuy'];
}

if (isset($_POST["btnUpdate"])) {
    $tenKH = $_POST["txtTenKH"];
    $sDT = $_POST["txtSDT"];
    $matKhau = $_POST["txtMatKhau"];
    $diaChiGH = $_POST["txtDiaChiGH"];
    $email = $_POST["txtEmail"];
    $quyen = $_POST["txtQuyen"];
    $password_hashed = password_hash($matKhau, PASSWORD_DEFAULT);
    $diemTichLuy = $_POST["txtDiemTichLuy"];

    $sql = "SELECT * FROM user WHERE TenKhachHang = :tenKH AND MaKhachHang != :mkh";
    $sta = $pdo->prepare($sql);
    $sta->execute(['tenKH' => $tenKH, 'mkh' => $mkh]);

    if ($sta->rowCount() > 0) {
        $tb = "Tên này đã tồn tại trong CSDL";
    } else {
        $sql = "UPDATE user SET TenKhachHang = :tenKH, SoDienThoai = :sDT, Email = :email, MatKhau = :matKhau, DiaChiGiaoHang = :diaChiGH, QUYEN = :quyen, DiemTichLuy = :diemTichLuy  WHERE MaKhachHang = :mkh";
        $sta = $pdo->prepare($sql);
        $params = [
            'tenKH' => $tenKH,
            'sDT' => $sDT,
            'email' => $email,
            'matKhau' => $password_hashed,
            'diaChiGH' => $diaChiGH,
            'quyen' => $quyen,
            'diemTichLuy' => $diemTichLuy,
            'mkh' => $mkh
        ];
        $kq = $sta->execute($params);

        if ($kq) {
            $tb = "Cập nhật thành công";
        } else {
            $tb = "Cập nhật thất bại";
        }
    }
}
?>
<body>
<?php include("./include/layout/header.php"); ?>
<div class="container">
<div class="container col-md-6 order-md-1">
          <center><h2 class="mb-3">Thông tin khách hàng</h2></center>
          <form method="POST" action="./capnhatkhachhang.php?mkh=<?php echo $mkh; ?>">

            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="fullName">Họ và tên</label>
                <input type="text" class="form-control" id="fullName" name="txtTenKH" value="<?php echo $tenKH; ?>">
              </div>      
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="txtEmail" value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
              <label for="address">Địa chỉ</label>
              <input type="text" class="form-control" id="address" name="txtDiaChiGH" value="<?php echo $diaChiGH; ?>" >
            </div>
            <div class="mb-3">
              <label for="quyen">Quyền</label>
              <input type="number" class="form-control" id="phone" name="txtQuyen" value="<?php echo $quyen; ?>">
            </div>
			<div class="mb-3">
              <label for="sodienthoai">Số điện thoại</label>
              <input type="text" class="form-control" id="phone" name="txtSDT" value="<?php echo $sDT; ?>">
            </div>
            <div class="mb-3">
              <label for="matkhau">Mật khẩu</label>
              <input type="text" class="form-control" id="phone" name="txtMatKhau" value="<?php echo $matKhau; ?>">
            </div>
            <div class="mb-3">
              <label for="point">Số điểm tích lũy hiện có</label>
              <input type="text" class="form-control" id="point" name="txtDiemTichLuy" value="<?php echo $diemTichLuy; ?>">
            </div>         
            <hr class="mb-4" width="100%">
            <?php
              if  (isset($_SESSION['message']))
              {
            ?>
                <span class="text-danger"><?php echo $_SESSION['message']; ?></span>
            <?php
              }
            ?>
            <button class="btn btn-danger" type="submit" name="btnUpdate" value="submit">Cập nhật thông tin</button>
          </form>
</div>
        
</div>
<?php include("./include/layout/footer.php"); ?>
</body>
</html>
<!-- Header -->
<?php include("./include/layout/header.php"); ?>
<?php include("./include/Connect.php");?>
<?php require("./Class/User.php"); ?>
<?php require("./Class/DonHang.php"); ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    if (!empty($_SESSION["MaKhachHang"]))
    {
        $maKH = $_SESSION["MaKhachHang"];
        $account = User::getUser($pdo,$maKH);
        $donhanghientai = DonHang::getLastDonHang($pdo, $maKH);
        if($donhanghientai["TrongGioHang"] == 1)
            {
                $MaDH = $donhanghientai["MaDonHang"];
                $dulieugio = DonHang::getChiTietDonHang($pdo,$MaDH);
            }
    }
?>
<?php
// Giả sử $account đã được khởi tạo từ cơ sở dữ liệu hoặc từ một nguồn nào khác

$diemTL = isset($_POST['diemTL']) ? intval($_POST['diemTL']) : $account["DiemTichLuy"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($diemTL > $account["DiemTichLuy"]) {
        $diemTL = $account["DiemTichLuy"];
        $error_message = "Giá trị nhập vào lớn hơn điểm tích lũy hiện có. Điểm tích lũy được đặt lại.";
    }
    // Tiếp tục xử lý sau khi kiểm tra
}
?>
<!-- Contain -->
<div class="container">
<h1 align="center" style="margin:20px;">THÔNG TIN ĐƠN HÀNG</h1>
<div class="row mt-3">
        <div class="col-md-6 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span style="width: fit-content;" class="text-muted">Giỏ hàng</span>
          </h4>
          <ul class="list-group mb-3">
            <?php
                $total = 0;
                foreach($dulieugio as $cartItem)
                {
                    $total+=$cartItem['SoLuong']*$cartItem['KhuyenMai'];
                ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $cartItem['TenSP'] ?></h6>
                            <small class="text-muted">Số lượng: <?php echo $cartItem['SoLuong'] ?> X Giá: <?php echo $cartItem['KhuyenMai'] ?></small>
                        </div>
                        <span class="text-muted"><?php echo number_format($cartItem['SoLuong']*$cartItem['KhuyenMai']);?> VNĐ</span>
                    </li>
            <?php
                }
            ?>
           
            <li class="list-group-item d-flex justify-content-between">
              <span>Tổng tiền (VNĐ)</span>
              <strong><?php echo number_format($total);  $_SESSION['total'] = $total;?> VNĐ</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Só điểm tích lũy sử dụng (1000 điểm = 1000 VNĐ)</span>
              <form action="./trangthanhtoan.php" method="post" enctype="multipart/form-data">
                  <input style="margin-left: 150px; width: 100px;" type="number" class="num" name="diemTL" value="<?php echo $diemTL; $_SESSION['diemTL'] = $diemTL;?>" min="1000" />
                  <button class="btn" type="submit"></button>
              </form>             
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Só tiền phải thanh toán </span>
              <strong><?php echo number_format($total-$diemTL);   $_SESSION['tienPhaiTra'] = $total-$diemTL;?> VNĐ</strong>
            </li>
          </ul>
          <form method="POST" action="xulithanhtoan.php" >
          <button style="" class="btn btn-danger btn-lg" type="submit" name="submit" value="submit">Tiếp tục thanh toán</button>
            <a style="" class="btn btn-secondary btn-lg" href="./giohang.php">Thoát</a>
        </div>
        <div class="col-md-6 order-md-1">
          <h4 class="mb-3">Thông tin khách hàng</h4>

            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="fullName">Họ và tên</label>
                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="<?php echo $account["TenKhachHang"]; ?>" readonly >
              </div>
              
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $account["Email"]; ?>" readonly>
            </div>

            <div class="mb-3">
              <label for="address">Địa chỉ</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="<?php echo $account["DiaChiGiaoHang"]; ?>" readonly >
            </div>

			<div class="mb-3">
              <label for="address">Số điện thoại</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php echo $account["SoDienThoai"]; ?>" readonly>
            </div>
            <div class="mb-3">
              <label for="address">Số điểm tích lũy hiện có</label>
              <input type="text" class="form-control" id="point" name="point" placeholder="<?php echo $account["DiemTichLuy"]; ?>" readonly>
            </div>         
            <hr class="mb-4" width="100%">
            <?php
                    if (isset($error_message)) {
                        echo "<p style='color:red;'>$error_message</p>";
                    }
                    ?>               
          </form>
           </div>
        </div>
      </div>
</div>
<!-- Footer -->
<?php include("./include/layout/footer.php"); ?>
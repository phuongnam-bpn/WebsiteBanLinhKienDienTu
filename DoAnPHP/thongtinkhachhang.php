<?php include("./include/Connect.php");?>
<!-- header -->
<?php include("./include/layout/header.php"); ?>
<?php require("./Class/User.php"); ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    if (!empty($_SESSION["MaKhachHang"]))
    {
        $maKH = $_SESSION["MaKhachHang"];
        $account = User::getUser($pdo,$maKH);
    }
?>
<!-- <div class="container" style="max-width: 860px; margin-bottom: 280px; padding-top: 120px;"> -->
<div class="container col-md-6 order-md-1">
          <h4 class="mb-3">Thông tin khách hàng</h4>
          <form method="POST" action="./capnhatthongtinkhachhang.php">

            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="fullName">Họ và tên</label>
                <input type="text" class="form-control" id="fullName" name="full_name" value="<?php echo $account["TenKhachHang"]; ?>">
              </div>
              
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $account["Email"]; ?>">
            </div>

            <div class="mb-3">
              <label for="address">Địa chỉ</label>
              <input type="text" class="form-control" id="address" name="address" value="<?php echo $account["DiaChiGiaoHang"]; ?>" >
            </div>

			<div class="mb-3">
              <label for="address">Số điện thoại</label>
              <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $account["SoDienThoai"]; ?>">
            </div>
            <div class="mb-3">
              <label for="address">Số điểm tích lũy hiện có</label>
              <input type="text" class="form-control" id="point" name="point" value="<?php echo $account["DiemTichLuy"]; ?>" readonly>
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
            <button class="btn btn-danger" type="submit" name="submit" value="submit">Cập nhật thông tin</button>
          </form>
</div>
        <hr>
<!-- </div> -->
<?php include("./include/layout/footer.php"); ?>
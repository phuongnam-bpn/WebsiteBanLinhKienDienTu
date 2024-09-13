<?php
    include("./include/Connect.php");
    $user=1;
    //$sql="select sanpham.*,Quantity from sanpham,cart WHERE sanpham.MaSP=cart.MaSP and cart.IdUser=$user";
    //$result= mysqli_query($conn,$sql);
    $total=0;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!empty($_SESSION["MaKhachHang"]))
    {
        header("Location: /DoAnPHP/xulidangnhap.php");
        exit();
    }
?>
<!-- Header -->
<?php include("./include/layout/header.php"); ?>

<style>
    .login {
        display: flex;
        flex-direction: column;
    }

        .login input {
            padding: 4px 24px;
            margin-bottom: 12px;
            max-width: 450px;
        }

        .login button {
            border: 0.5px solid #E02207;
            border-radius: 0;
            color: white;
            background-color: #E02207;
            max-width: 450px;
            margin-bottom: 24px;
        }

            .login button:hover {
                background: white;
                color: #E02207;
                border: 0.5px solid #E02207;
            }

    .row {
        margin-bottom: 24px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">

            <form action="./xulidangnhap.php" method="post" enctype="multipart/form-data">
                <div class="login">
                    <h2>ĐĂNG NHẬP</h2>
                    <input type="text" name="Username" placeholder="Nhập tài khoản" />
                    <input type="password" name="Password" placeholder="Nhập mật khẩu" />
                    <button type="submit" class="btn">Đăng nhập</button>
                    <?php
                        if (!empty($_GET["error"]))
                        {
                    ?>
                        <span class="text-danger">Tài khoản hoặc mật khẩu không đúng !!!</span>
                    <?php
                        }
                    ?>
                    
                </div>
            </form>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <form action="./xulidangky.php" method="post" enctype="multipart/form-data">
                <div class="login">
                    <h2>ĐĂNG KÝ MỚI</h2>
                    <input type="text" class="form-control" name="Name" placeholder="Họ Tên" />
                    <input type="email" class="form-control" name="Email" placeholder="Email của bạn" />
                    <input type="text" class="form-control" name="DiaChi" placeholder="Địa chỉ" />
                    <input type="text" class="form-control" name="Username" placeholder="Số Điện Thoại" />
                    <input type="password" class="form-control" name="Password" placeholder="Nhập mật khẩu" />
                    <input type="password" class="form-control" name="ConfirmPassword" placeholder="Nhập lại mật khẩu" />
                    <button type="submit" class="btn">Đăng ký</button>
                    <?php
                        if (isset($_GET["dangKy"]))
                        {
                            if ($_GET["dangKy"] == 0)
                            {
                    ?>
                        <span class="text-danger">Không được để trống !!!</span>
                    <?php
                            }
                        if ($_GET["dangKy"] == 2)
                        {
                    ?>
                        <span class="text-danger">Mật khẩu không khớp !!!</span>
                    <?php
                        }
                        if ($_GET["dangKy"] == 3)
                        {
                    ?>
                        <span class="text-danger">Số điện thoại hoặc email đã trùng vui lòng điền lại !!!</span>
                    <?php
                        }
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include("./include/layout/footer.php"); ?>
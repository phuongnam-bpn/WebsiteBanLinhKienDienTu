<?php
include("./include/Connect.php");
$sql = "SELECT * FROM `loaisanpham`";
$sta = $pdo->prepare($sql);
$sta->execute();
$loaisp = $sta->fetchAll(PDO::FETCH_ASSOC);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Tin học ngôi sao</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./include/js/script.js"></script>
    <link rel="stylesheet" href="./include/style/responesive.css">
    <link href="./include/style/layout.css" rel="stylesheet" />
    <style>
        .search {
            color: white;
        }

        .nav-item form button:hover {
            border: 1px solid #E02207;

        }

        .nav-item form button:hover i {
            color: #E02207;
        }

        .action-1 {
            background: #E02207;
            color: white;
            border: 1px solid #E02207;
        }

        .action-1:hover {
            background: white;
            color: #E02207;
        }

        .action-2 {
            background: white;
            color: #E02207;
            border: 1px solid #E02207;
        }

        .action-2:hover {
            background: #E02207;
            color: white;
        }
    </style>

<body>
    <nav class="nav">
        <div class="container ">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-3 nav-item">
                    <a class="navbar-brand" href="./trangchu.php">
                        <img src="./include/Images/logo.jpg" alt="Alternate Text" />
                    </a>
                </div>
                <div class="col-lg-5 col-md-7 col-6 nav-item">

                    <form action="./timkiem.php" class="d-flex" method="POST">
                        <input class="form-control" type="search" name="txt_search" value="" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn" type="submit"><i class="fas fa-search search"></i></button>
                    </form>
                </div>
                <div class="col-lg-3 col-md-1 col-1 nav-item">
                    <?php
                    if (!empty($_SESSION["MaKhachHang"]))
                    {
                    ?>

                        <a href="./thongtinkhachhang.php">
                            <i class="fas fa-user"></i>
                            <span class="item-nav"><?php echo $_SESSION["TenKhachHang"] ?></span>
                        </a>
                        <span> | </span>
                        <a href="./dangxuat.php">
                            <span class="item-nav">Đăng xuất</span>
                        </a>
                        <?php
                        if (!empty($_SESSION["QUYEN"] && $_SESSION["QUYEN"] == 1))
                        {
                        ?>
                        <span> | </span>
                        <a href="./trangchuadmin.php">
                            <span class="item-nav">Quản lý</span>
                        </a>
                        <?php
                        }
                        ?>

                    <?php
                    } else { ?>

                        <a href="./dangnhap.php">
                            <i class="fas fa-user"></i>
                            <span class="item-nav">Đăng nhập/ Đăng ký</span>
                        </a>

                    <?php } ?>
                </div>
                <div class="col-lg-2 col-md-1 col-1 nav-item">
                    <a href="./giohang.php">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="item-nav">Giỏ hàng</span>
                    </a>
                    <?php
                    if (!empty($_SESSION["MaKhachHang"]))
                    {
                    ?>
                    <a href="./lichsudonhang.php">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="item-nav">Lịch sử</span>
                    </a>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-1 dropdown icon-bar">
                    <button class="btn " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

            </div>
            <div class="row">
                <div class="col-3">
                    <div class="nav-sidebar">
                        <i class="fas fa-bars"></i>
                        <a class="product__link" href="./sanpham.php">DANH MỤC SẢN PHẨM</a>
                        <div class="nav-sidebar__list">
                            <ul>
                                <?php foreach ($loaisp as $each) { ?>
                                    <li class="li-child">
                                        <a href="./sanphamtheoloai.php?MaLoai=<?php echo $each["MaLoaiSP"]?>">
                                            <span><?php echo $each['TenLoaiSP']; ?></span>
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    </li>
                                <?php }
                                echo '<li class="li-child">
                                    <a href="./sanpham.php">
                                        <span>Xem tất cả</span>
                                    <i class="fas fa-angle-right"></i>

                                    </a>
                                </li>'; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="nav-menu">
                        <ul class="nav-navbar">
                            <li>
                                <a href="#"><i class="fas fa-wrench"></i> Lắp đặt phòng net</a>
                            </li>
                            <li>
                                <a href="#"><i class="fas fa-money-check"></i> Trả góp</a>
                            </li>
                            <li>
                                <a href="#"><i class="fas fa-money-bill"></i> Bảng giá</a>
                            </li>
                            <li>
                                <a href="#"><i class="fas fa-sliders-h"></i> Xây dựng cấu hình</a>
                            </li>
                            <li>
                                <a href="#"><i class="fas fa-shield-alt"></i> Kiểm tra bảo hành</a>
                            </li>
                            <li>
                                <a href="#"><i class="fas fa-dollar-sign"></i> Thiết bị mining</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </nav>
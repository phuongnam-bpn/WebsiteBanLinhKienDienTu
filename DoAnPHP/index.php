<?php
include("./include/Connect.php");
require("./Class/SanPham.php");
?>

<!-- header -->
<?php include("./include/layout/header.php"); ?>
<link href="./include/style/homeIndex.css" rel="stylesheet" />

<!-- main -->
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-0 col-0"></div>
        <div class="col-lg-9 col-md-12 col-12">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-8">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner border-radius_5px">
                            <div class="carousel-item active">
                                <img src="./include/Images/layout/slider-1.webp" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="./include/Images/layout/slider-2.webp" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="./include/Images/layout/slider-3.webp" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <img src="./include/Images/layout/banner_right_1.webp" style="padding-bottom: 12px;" class="img-banner" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <img src="./include/Images/layout/banner_right_2.webp" class="img-banner" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-footer">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <img src="./include/Images/layout/banner_right_3.webp" class="img-banner" alt="">
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <img src="./include/Images/layout/banner_right_4.webp" class="img-banner" alt="">
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <img src="./include/Images/layout/banner_right_5.webp" class="img-banner" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapperBanner">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-6 pd-bottom-12"><a href="#"><img src="./content/images/layout/banner_home_1_master.webp" class="img-banner" alt=""></a></div>
                <div class="col-lg-3 col-md-6 col-6 pd-bottom-12"><a href="#"><img src="./content/images/layout/banner_home_2_master.webp" class="img-banner" alt=""></a></div>
                <div class="col-lg-3 col-md-6 col-6 pd-bottom-12"><a href="#"><img src="./content/images/layout/banner_home_3_master.webp" class="img-banner" alt=""></a></div>
                <div class="col-lg-3 col-md-6 col-6 pd-bottom-12"><a href="#"><img src="./content/images/layout/banner_home_4_master.webp" class="img-banner" alt=""></a></div>
            </div>
        </div>
        <div class="flashsaleBanner">
            <div class="row mt-5">
                <img src="./include/Images/layout/home_fsale_apps_banner.webp" class="img-banner" alt="">
            </div>
        </div>
    </div>
    <div class="homeProduct">
        <div class="blockTitle">
            <div class="row" style="align-items: baseline;">
                <div class="col-3">
                    <a href="#">
                        <h2 class="mt-5">CPU - Bộ xử lý</h2>
                    </a>
                </div>
                <div class="col-9" style="text-align: right;">
                    <a href="" style="display: inline-flex; align-items: center;">
                        Xem tất cả <i class="fas fa-angle-right" style="margin-left: 5px;"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="blockContent">
            <div class="row justify-content-center">
                <div id="recipeCarousel1" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $products = SanPham::getSPById($pdo, 1);
                        if ($products && count($products) > 0) {
                            $firstProduct = $products[0];
                        ?>
                            <div class="carousel-item active item-1">
                                <div class="col-lg-3 col-md-3">
                                    <div class="card-product">
                                        <div class="card">
                                            <img src="./include/Images/ImagesSP/<?php echo $firstProduct["Anh"] ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <a href="./thongtinSP.php?MaSP=<?php echo $firstProduct['MaSP'] ?>"><?php echo $firstProduct['TenSP'] ?></a>
                                                <div style="color: red;">
                                                    <?php echo number_format($firstProduct['GiaSP'], 0, ".", ",") ?> đ</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            for ($i = 1; $i < count($products); $i++) {
                                $product = $products[$i];
                            ?>
                                <div class="carousel-item item-1">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="card-product">
                                            <div class="card">
                                                <img src="./include/Images/ImagesSP/<?php echo $product["Anh"] ?>" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <a href="./thongtinSP.php?MaSP=<?php echo $product['MaSP'] ?>"><?php echo $product['TenSP'] ?></a>
                                                    <div style="color: red;">
                                                        <?php echo number_format($product['GiaSP'], 0, ".", ",") ?> đ</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<p>No products found.</p>';
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel1" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="border-radius: 1px solid red; color: red;"></span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel1" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="border-radius: 1px solid red; color: red;"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="homeProduct">
        <div class="blockTitle">
            <div class="row">
                <div class="col-3">
                    <a href="#">
                        <h2>Mainboard</h2>
                    </a>
                </div>
                <div class="col-9" style="text-align: right;">
                    <a href="" style="display: inline-flex; align-items: center;">
                        Xem tất cả <i class="fas fa-angle-right" style="margin-left: 5px;"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="blockContent">
            <div class="row justify-content-center">
                <div id="recipeCarousel2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $products = SanPham::getSPById($pdo, 2);
                        if ($products && count($products) > 0) {
                            $firstProduct = $products[0];
                        ?>
                            <div class="carousel-item active item-1">
                                <div class="col-lg-3 col-md-3">
                                    <div class="card-product">
                                        <div class="card">
                                            <img src="./include/Images/ImagesSP/<?php echo $firstProduct["Anh"] ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <a href="./thongtinSP.php?MaSP=<?php echo $firstProduct['MaSP'] ?>"><?php echo $firstProduct['TenSP'] ?></a>
                                                <div style="color: red;">
                                                    <?php echo number_format($firstProduct['GiaSP'], 0, ".", ",") ?> đ</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            for ($i = 1; $i < count($products); $i++) {
                                $product = $products[$i];
                            ?>
                                <div class="carousel-item item-1">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="card-product">
                                            <div class="card">
                                                <img src="./include/Images/ImagesSP/<?php echo $product["Anh"] ?>" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <a href="./thongtinSP.php?MaSP=<?php echo $product['MaSP'] ?>"><?php echo $product['TenSP'] ?></a>
                                                    <div style="color: red;">
                                                        <?php echo number_format($product['GiaSP'], 0, ".", ",") ?> đ</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<p>No products found.</p>';
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel2" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="border-radius: 1px solid red; color: red;"></span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel2" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="border-radius: 1px solid red; color: red;"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="homeProduct">
        <div class="blockTitle">
            <div class="row">
                <div class="col-3">
                    <a href="#">
                        <h2>CASE - THÙNG MÁY</h2>
                    </a>
                </div>
                <div class="col-9" style="text-align: right;">
                    <a href="" style="display: inline-flex; align-items: center;">
                        Xem tất cả <i class="fas fa-angle-right" style="margin-left: 5px;"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="blockContent block-3">
            <div class="row justify-content-center">
                <div id="recipeCarousel3" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $products = SanPham::getSPById($pdo, 3);
                        if ($products && count($products) > 0) {
                            $firstProduct = $products[0];
                        ?>
                            <div class="carousel-item active item-1">
                                <div class="col-lg-3 col-md-3">
                                    <div class="card-product">
                                        <div class="card">
                                            <img src="./include/Images/ImagesSP/<?php echo $firstProduct["Anh"] ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <a href="./thongtinSP.php?MaSP=<?php echo $firstProduct['MaSP'] ?>"><?php echo $firstProduct['TenSP'] ?></a>
                                                <div style="color: red;">
                                                    <?php echo number_format($firstProduct['GiaSP'], 0, ".", ",") ?> đ</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            for ($i = 1; $i < count($products); $i++) {
                                $product = $products[$i];
                            ?>
                                <div class="carousel-item item-1">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="card-product">
                                            <div class="card">
                                                <img src="./include/Images/ImagesSP/<?php echo $product["Anh"] ?>" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <a href="./thongtinSP.php?MaSP=<?php echo $product['MaSP'] ?>"><?php echo $product['TenSP'] ?></a>
                                                    <div style="color: red;">
                                                        <?php echo number_format($product['GiaSP'], 0, ".", ",") ?> đ</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<p>No products found.</p>';
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel3" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="border-radius: 1px solid red; color: red;"></span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel3" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="border-radius: 1px solid red; color: red;"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("./include/layout/footer.php"); ?>
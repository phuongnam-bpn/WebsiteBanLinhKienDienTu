<?php
include("./include/Connect.php");
include("Pager.php");
$sql = "SELECT * FROM `sanpham`";
$sta = $pdo->prepare($sql);
$sta->execute();
if ($sta->rowCount() > 0)
    $sanpham = $sta->fetchAll(PDO::FETCH_ASSOC);

//Phân trang
$p = new Pager();
$limit = 6;
$count = count($sanpham);
$vt = $p->findStart($limit);
$pages = $p->findPages($count, $limit);
$cur = $_GET["page"];
$phanTrang = $p->pageList($cur, $pages);
$sql = "SELECT * FROM `sanpham` limit $vt, $limit";
$sta = $pdo->prepare($sql);
$sta->execute();
$sanpham = $sta->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("./include/layout/header.php"); ?>
<link href="./include/style/homeIndex.css" rel="stylesheet" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-0 col-0"></div>
        <div class="col-lg-9 col-md-12 col-12">
            <div class="row">
                <div class="text-center">
                    <h4>DANH SÁCH SẢN PHẨM</h4>
                </div>
                <?php
                if (empty($sanpham)) {
                    echo "Không có sản phẩm nào";
                } else {
                    foreach ($sanpham as $sp) {
                ?>
                        <div class="col-4 border card" style="background-color: transparent; border: solid 1px #000!important;">
                            <div class="" style="width: 18rem;">
                                <img src="./include/Images/ImagesSP/<?php echo $sp["Anh"] ?>" style="height: 250px;" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="./thongtinSP.php?MaSP=<?php echo $sp["MaSP"] ?>"><?php echo $sp["TenSP"] ?></a>
                                    <div class="d-flex mt-3">
                                        <div style="text-decoration: line-through;">
                                            <?php echo number_format($sp['GiaSP'], 0, ".", ",") ?> đ</div>
                                        <sup>
                                            <p>
                                                <?php echo number_format(- (100 - ($sp["KhuyenMai"] / $sp["GiaSP"] * 100)), 2) . '%'; ?>
                                            </p>
                                        </sup>
                                    </div>
                                    <div class="d-flex" style="color: red; justify-content: space-between;">
                                        <h4>
                                            <?php echo number_format($sp['KhuyenMai'], 0, ".", ",") ?> đ
                                        </h4>
                                        <div class="d-flex float-right">
                                            <h5 class="mb-0 me-2"><?php echo $sp["SoSaoDanhGia"]; ?></h5>
                                            <a href="#">
                                                <span class="material-symbols-outlined" style="color: yellowgreen;">
                                                    star_rate
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="text-center">
                <a class="btn border" href="./sanpham.php?page=1">
                    <i class="fas fa-fast-backward"></i>
                </a>
                <a class="btn border" href="./sanpham.php?page=<?php echo max(1, $cur - 1); ?>">
                    <i class="fas fa-step-backward"></i>
                </a>
                <?php
                for ($i = 1; $i <= $pages; $i++) {
                ?>
                    <a class="btn border" href="./sanpham.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php
                }
                ?>
                <a class="btn border" href="./sanpham.php?page=<?php echo min($pages, $cur + 1); ?>">
                    <i class="fas fa-step-forward"></i>
                </a>
                <a class="btn border" href="./sanpham.php?page=<?php echo $pages; ?>">
                    <i class="fas fa-fast-forward"></i>
                </a>
            </div>

        </div>
    </div>
</div>
<?php
include("./include/layout/footer.php");
?>
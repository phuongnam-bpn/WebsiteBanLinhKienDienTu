<?php
include("./include/Connect.php");
include("./Pager.php");

if (!empty($_POST['txt_search'])) {
    $sql = "select * from sanpham where TenSP like N'%" . $_POST['txt_search'] . "%'";
    $sta = $pdo->query($sql);
    $sanpham = $sta->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php include("./include/layout/header.php"); ?>
<link href="./include/style/homeIndex.css" rel="stylesheet" />
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-0 col-0"></div>
        <div class="col-lg-9 col-md-12 col-12">
            <div class="row">
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
                                                <?php echo number_format((($sp["GiaSP"] - $sp["KhuyenMai"]) / $sp["GiaSP"]) * 100, 2) . '%'; ?>
                                            </p>
                                        </sup>
                                    </div>
                                    <div style="color: red;">
                                        <h4>
                                            <?php echo number_format($sp['KhuyenMai'], 0, ".", ",") ?> đ
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include("./include/layout/footer.php");
?>
<?php include("./include/Connect.php");?>
<!-- header -->
<?php include("./include/layout/header.php"); ?>

<div class="container" style="max-width: 500px;">
    <h2>Xin chào admin</h2>
    <table class="table table-bordered table-hover">
        <tr class="table-danger">
            <td><center><a href="./quanlikhachhang.php">Quản lý khách hàng</a></center></td>
        </tr>
        <tr class="table-danger">
            <td><center><a href="./quanlisanpham.php">Quản lý sản phẩm</a></center></td>
        </tr>
        <tr class="table-danger">
            <td><center><a href="./quanlidonhang.php">Quản lý đơn hàng</a></center></td>
        </tr>
        <tr class="table-danger">
            <td><center><a href="./quanliloaisanpham.php">Quản lý loại sản phẩm</a></center></td>
        </tr>
    </table>
</div>
<?php include("./include/layout/footer.php"); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sản phẩm</title>
 <!--Bootstrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <link href="./include/style/homeIndex.css" rel="stylesheet" />
    <style>
            
            .center-content {
                margin: auto;
               
            }
        
</style>
</head>

<?php
include("./include/Connect.php");

if (!isset($_GET['mlsp'])) {
    die("Mã loại sản phẩm không hợp lệ.");
}

$tb = "";
$mlsp = (int)$_GET['mlsp'];
$sql = "SELECT * FROM loaisanpham WHERE MaLoaiSP = :mlsp";
$sta = $pdo->prepare($sql);
$sta->execute(['mlsp' => $mlsp]);
if ($sta->rowCount() > 0) {
    $loaisanpham = $sta->fetchAll(PDO::FETCH_BOTH);
}
foreach ($loaisanpham as $lsp) {
   
    $tenLoaiSP = $lsp['TenLoaiSP'];   
    $hinh = $lsp['AnhLoaiSP'];
    $note = $lsp['Note'];
}

if (isset($_POST["btnUpdate"])) {
   
    $tenLoaiSP = $_POST["txtTenLoaiSP"];
    $hinh = $_FILES["image"]["error"] == 0 ? $_FILES["image"]["name"] : $hinh;
  
    $note = $_POST["txtNote"];

    $sql = "SELECT * FROM loaisanpham WHERE TenLoaiSP = :tenLoaiSP";
    $sta = $pdo->prepare($sql);
    $sta->execute(['tenLoaiSP' => $tenLoaiSP]);

    if ($sta->rowCount() > 0) {
        $tb = "Tên này đã tồn tại trong CSDL";
    } else {
        $sql = "UPDATE loaisanpham SET TenLoaiSP = :tenLoaiSP, AnhLoaiSP = :hinh,  Note = :note WHERE MaLoaiSP = :mlsp";
        $sta = $pdo->prepare($sql);
        $params = [
            'tenLoaiSP' => $tenLoaiSP,
            'hinh' => $hinh,
            'note' => $note,
            'mlsp' => $mlsp
        ];
        $kq = $sta->execute($params);

        if ($kq) {
            $tb = "Cập nhật thành công";
            if ($_FILES["image"]["error"] == 0) {
                move_uploaded_file($_FILES["image"]["tmp_name"], "./include/Images/ImagesLoaiSP/$hinh");
            }
        } else {
            $tb = "Không thể cập nhật";
        }
    }
}
?>
<body>
<?php include("./include/layout/header.php"); ?>
<div class="container">
   
    <div id="Content" class="row">

        <div class="col-8 center-content">
            <br>
            <br>
            <h2 align="center">CẬP NHẬT LOẠI SẢN PHẨM</h2>
            <form method="post" action="./capnhatloaisanpham.php?mlsp=<?php echo $mlsp; ?>" enctype="multipart/form-data">
              
                <div class="form-group">
                    <label for="txtTenLoaiSP">Tên loại sản phẩm</label>
                    <input type="text" class="form-control" name="txtTenLoaiSP" id="txtTenLoaiSP" value="<?php echo $tenLoaiSP; ?>" required>
                </div>
             
                <div class="form-group">
                    <label for="image">Ảnh </label>
                    <input type="file" class="form-control" name="image" id="image">
                    <input type="hidden" name="existing_image" value="<?php echo $hinh; ?>">
                </div>
              
                <div class="form-group">
                    <label for="txtNote">Note</label>
                    <input type="text" class="form-control" name="txtNote" id="txtNote" value="<?php echo $note; ?>" required>
                </div>
                <div class="form-group text-danger">
                    <?php if (isset($tb)) echo $tb; ?>
                </div>
                <button type="submit" class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' name="btnUpdate">Cập nhật</button>
                <button class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' name="btnSubmit"><a class="text-light"href="./quanliloaisanpham.php"> Show Products Type</a></button>
            </form>
        </div>
        
</div>
<?php include("./include/layout/footer.php"); ?>
</body>
</html>
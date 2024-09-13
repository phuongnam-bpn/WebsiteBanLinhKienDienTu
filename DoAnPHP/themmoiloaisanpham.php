

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Khách Hàng</title>
 <!--Bootstrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <link href="./include/style/homeIndex.css" rel="stylesheet" />
    <script src="js/Validate.js"></script>
    <script>
        function kiemTra() {
            var tenLoaiSP = document.getElementById("idName").value;
            var image = document.querySelector('input[type="file"]').files[0];
            var note = document.querySelector('input[name="txtNote"]').value;
            var errorMessage = "";

            // Kiểm tra tên loại sản phẩm
            if (tenLoaiSP.trim() === "") {
                errorMessage += "Tên loại sản phẩm không được để trống.\n";
            }

            // Kiểm tra file ảnh (nếu cần thiết)
            if (!image) {
                errorMessage += "Ảnh loại sản phẩm không được để trống.\n";
            } else {
                // Kiểm tra định dạng ảnh
                var allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                var fileExtension = image.name.split('.').pop().toLowerCase();
                if (allowedExtensions.indexOf(fileExtension) === -1) {
                    errorMessage += "Định dạng ảnh không hợp lệ. Chỉ chấp nhận các định dạng: " + allowedExtensions.join(", ") + ".\n";
                }
            }

            // Hiển thị thông báo lỗi nếu có
            if (errorMessage !== "") {
                alert(errorMessage);
                return false;
            }
            
            return true;
        }
        function redirectToShowProductsType() {
            window.location.href = "quanliloaisanpham.php";
        }
    </script>
    <style>
            
            .center-content {
                margin: auto;
               
            }
        
</style>

</head>

<?php
    include("./include/Connect.php");

    if (isset($_POST["btnSubmit"])) {

      
        $tenLoaiSP = $_POST["txtTenLoaiSP"];
      
        $hinh = $_FILES["image"]["error"] == 0 ? $_FILES["image"]["name"] : "";
       
        $note = $_POST["txtNote"];

        // Chỉ định các cột trong câu lệnh INSERT ngoại trừ MaSP
        $sql = "INSERT INTO loaisanpham (TenLoaiSP, AnhLoaiSP, Note) VALUES (?, ?, ?)";
        $param = array($tenLoaiSP,$hinh, $note);
        $sta = $pdo->prepare($sql);
        $kq = $sta->execute($param);

        if ($kq) {
            $tb = "Thêm thành công";
            if ($hinh != "") {
                move_uploaded_file($_FILES["image"]["tmp_name"], "./include/Images/ImagesLoaiSP/$hinh");
            }
        } else {
            $tb = "Không thể thêm";
        }
    }


    $sql1 = "SELECT MaLoaiSP FROM loaisanpham";
    $sta1 = $pdo->prepare($sql1);
    $sta1->execute();
    $loai_san_pham = $sta1->fetchAll(PDO::FETCH_OBJ);
?>
<body>
<?php include("./include/layout/header.php"); ?>
<div class="container">
    
    <div id="Content" class="row">
    <div class="col-8 center-content">
            <br>
            <br>
            <h2 align="center">TRANG THÊM MỚI LOẠI SẢN PHẨM</h2>
            <form method="post" action="./themmoiloaisanpham.php" enctype="multipart/form-data" onsubmit="return kiemTra();">
                <div class="form-group">
                    <label>Tên loại sản phẩm</label>
                    <input type="text" class="form-control" placeholder="Nhập tên loại sản phẩm" name="txtTenLoaiSP" id="idName" required />
                </div>
              
                <div class="form-group">
                    <label>Ảnh loại sản phẩm</label>
                    <input type="file" class="form-control" name="image" />
                </div>
                <div class="form-group">
                    <label>Note</label>
                    <input type="text" class="form-control" placeholder="Nhập ghi chú" name="txtNote" />
                </div>
                <div class="form-group">
                    <button type="submit" class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' name="btnSubmit">Create</button>
                    <button type="button" class='btn btn-danger' style='font-size:12px; text-align: left; border: 2px solid #333;' onclick="redirectToShowProductsType()">Show Products Type</button>
                </div>
                </div>
                 <div class="form-group text-danger">
                    <?php if (isset($tb)) echo $tb; ?>
                  
                </div>
              
            </form>
        </div>

            
        </div>
  
</div>
<?php include("./include/layout/footer.php"); ?>
</body>
</html>
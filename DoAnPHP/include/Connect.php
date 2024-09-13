<?php
$servername = "localhost";
$db = "doanphp";
$username = "root";
$pass = "";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$db", $username, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Lỗi kết nối đến cơ sở dữ liệu" + $e->getMessage();
}
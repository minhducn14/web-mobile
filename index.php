<?php
include("myclass/clskhachhang.php");
error_reporting(0);
$p = new khachhang();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>21092831_MaDanLy</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<style>
    #left a {
        padding: 10px;
        text-decoration: none;
        margin-bottom: 5px;
        border-radius: 5px;
        color: #000;
    }

    #left a:hover {
        color: red;
    }

    h1 {
        font-size: 50px;
        color: #1f18d5;
        font-weight: bold;
        text-align: center;
    }

    #footer{
        text-align: center;
    }
</style>

<body>
    <div id="container">
        <div id="banner">
            <h1>Trang Chủ</h1>
        </div>
        <div id="main">
            <div id="left">
                <a href="index.php">Trang Chủ</a>
                <br>
                <a href="xuatcongty.php">Công Ty</a>
                <br>
                <?php
                $khachhang = new KhachHang();
                $currentDirectoryName = basename(__DIR__);
                $companyMenu = $khachhang->xemdscongty("SELECT * FROM congty ORDER BY tencty ASC", $currentDirectoryName);
                if ($companyMenu) {
                    echo "<li>index<ul>{$companyMenu}</ul></li>";
                }
                ?>
                <a href="admin/admin.php">Admin</a>

            </div>
            <div id="right">
                <?php
                $idcty = $_REQUEST['id'];
                if (isset($idcty) && $idcty > 0) {
                    $p->xemdssanpham("select *from sanpham where idcty = '$idcty' order by gia asc");
                } else {
                    $p->xemdssanpham("select *from sanpham order by gia asc");
                }
                ?>

            </div>
        </div>
        <div id="footer">
                <h3>Mã Đan Ly - 21092831</h3>
        </div>
    </div>

</body>

</html>
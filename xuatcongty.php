<?php
include ("myclass/clskhachhang.php");

$con = mysqli_connect("localhost", "dly", "123456", "tmdt_db");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$tmdt = new tmdt();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Công ty</title>
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
    
    h1 {
    font-size: 50px;
    color: #1f18d5;
    font-weight: bold;
    text-align: center;
    }
</style>
<body>
    <div id="container">
        <div id="banner">
            <h1>Công Ty</h1>
        </div>
        <div id="main">
            <div id="left">
                <a href="index.php">Trang Chủ</a>
                <br>
                <a href="xuatcongty.php">Công Ty</a>
                <br>
                <?php
                    $khachhang = new khachhang();   
                    $currentDirectoryName = basename(__DIR__);                
                    $companyMenu = $khachhang->xemdscongty("SELECT * FROM congty ORDER BY tencty ASC", $currentDirectoryName);
                    if ($companyMenu) {
                        echo "<li>index<ul>{$companyMenu}</ul></li>";
                    }
                ?>
                <a href="admin/admin.php">Admin</a>
            </div>
        
            <div id="right">
                <div id="table-container">
                    <?php
                    $tmdt->xuatcongty();
                    ?>
                </div>
            </div>
        </div>
        <div id="footer">
                    
        </div>
    </div>
</body>
</html>

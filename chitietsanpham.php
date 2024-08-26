<?php
error_reporting(0);
include("myclass/clskhachhang.php");
include("myclass/clslogin.php");
$p = new khachhang();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">

    <style>
        table {
            width: 800px;
            border-collapse: collapse;
            align-items: center;
            margin: auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"] {
            width: 100%;
            box-sizing: border-box;
            padding: 4px;
        }

        .add-to-cart-btn {
            padding: 6px 12px;
            background-color: #4CAF50;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="banner"></div>
        <div id="main">
            <div align="right"> 
                
                <?php 
                if (isset($_SESSION['idkh'])) {
                    $idkh = $_SESSION['idkh'];
                    $tenkh = $p->laycot("select ten from khachhang where iduser='$idkh' limit 1");
                    echo 'Xin chào: ' . $tenkh;
                    echo ' | <a href="logout/index.php">Đăng xuất</a>';
                }
            ?>

            </div> 
            <form action="" method="post">
                <?php
                $idsp = $_REQUEST['id'];
                $p->xemchitietsanpham("select * from sanpham where idsp='$idsp' limit 1");
                ?>

                <?php
                if ($_POST['nut'] == 'Thêm vào giỏ hàng') {
                    if (isset($_SESSION['idkh'])) {
                        $idkh = $_SESSION['idkh'];
                        $ngaydathang = date('Y-m-d');
                        
                        if($p->themxoasua("INSERT INTO dathang(idkh,ngaydathang) VALUES ('$idkh', '$ngaydathang')")==1)
                        {
                            $iddh=$p->laycot("select iddh from dathang where idkh='$idkh' order by iddh desc limit 1");
                            $idsp=$_REQUEST['id'];
                            $soluong=$_REQUEST['txtsoluong'];
                            $dongia=$p->laycot("select gia from sanpham where idsp='$idsp'  limit 1");
                            $giamgia=$p->laycot("select giamgia from sanpham where idsp='$idsp'  limit 1");
                            if(($p->themxoasua("INSERT INTO `dathang_chitiet`(`iddh`, `idsp`, `soluong`, `dongia`, `giamgia`)  VALUES ('$iddh', '$idsp', '$soluong', '$dongia', '$giamgia');"))==1)
                            {
                                echo '<script language="javascript">
                                    alert("Đặt hàng thành công.");
                                    </script>';
                            }
                            else
                            {
                                echo '<script language="javascript">
                                    alert("Đặt hàng không thành công.");
                                    </script>';  
                            }
                        }
                    } else {
                        echo '<script language="javascript">
                                    alert("Vui lòng đăng nhập trước khi đặt hàng.");
                                    </script>';  
                        echo '<script language="javascript">
                                    window.location="khachhang/";
                                    </script>';
                    }
                }
                ?>
            </form>

            <?php
            if(isset($_SESSION['idkh']))
            {
                $idkh = $_SESSION['idkh'];
                $p->giohang("select ct.idsp, ct.soluong, ct.dongia, ct.giamgia from dathang dh, dathang_chitiet ct 
                where dh.iddh=ct.iddh and dh.idkh='$idkh'");
            }
            ?>
        </div>
        <div id="footer"></div>
    </div>

</body>

</html>
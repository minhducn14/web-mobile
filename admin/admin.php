<?php
error_reporting(0);
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen'])) {
    include("../myclass/clslogin.php");
    $q = new login();
    $q->confirmlogin($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen']);
} else {
    header('location: ../login/');
}
?>

<?php
include("../myclass/clsquantri.php");
$p = new quantri();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>admin</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;

    }

    h1 {
        text-align: center;
    }

    .form-table {
        width: 50%;
        border-collapse: collapse;
        margin: 0 auto;
    }

    .form-table td,
    .form-table th {
        padding: 5px;
        border: 2px solid #000000;
    }

    .form-table label {
        margin-bottom: 5px;
        display: block;
    }

    input[type="text"],
    textarea,
    select {
        width: 75%;
        padding: 8px;
        margin: 4px 0 8px;

        border: 1px solid #000000;
        border-radius: 4px;
    }

    input[type="submit"] {
        width: auto;
        padding: 10px 20px;
        margin-top: 10px;
        margin-bottom: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 10px;
    }


    textarea {
        resize: vertical;
    }

    .display-table {
        width: 50%;
        margin: 0 auto;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .display-table,
    .display-table th,
    .display-table td {
        border: 2px solid #000000;
        background-color: #fff;
    }

    a {
        text-decoration: none;
        color: #333;
        padding: 5px 10px;
        border: 1px solid #333;
        border-radius: 4px;
        transition: all 0.3s ease;
        display: inline-block;
    }

    a:hover {
        background-color: #333;
        color: #fff;
    }

    div#navbar {
        display: flex;
        justify-content: center;
    }
</style>

<body>

    <?php
    if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
        $layid = $_REQUEST['id'];
    } else {
        $layid = null;
    }

    if ($layid != null) {
        $layten = $p->laycot("select tensp from sanpham where idsp='$layid' limit 1");
        $laymota = $p->laycot("select mota from sanpham where idsp='$layid' limit 1");
        $laygia = $p->laycot("select gia from sanpham where idsp='$layid' limit 1");
        $laygiamgia = $p->laycot("select giamgia from sanpham where idsp='$layid' limit 1");
    } else {
        $layten = '';
        $laymota = '';
        $laygia = '';
        $laygiamgia = '';
    }

    ?>

    <div id="banner">
        <h1>QUẢN LÝ SẢN PHẨM</h1>
    </div>


    <div id="navbar">
        <a href="../index.php">Trang Chủ</a>
        <br>
        <a href="../xuatcongty.php">Công Ty</a>
        <br>
        <?php
        $quantri = new quantri();
        $currentDirectoryName = basename(__DIR__);
        $companyMenu = $quantri->xemdscongty("SELECT * FROM congty ORDER BY tencty ASC", $currentDirectoryName);
        if ($companyMenu) {
            echo "<li>index<ul>{$companyMenu}</ul></li>";
        }
        ?>
        <a href="admin.php">Admin</a>
    </div>
    <br>
    <form method="post" enctype="multipart/form-data">
        <table class="form-table">
            <tr>
                <td><label for="congty">Chọn công ty cung cấp:</label></td>
                <td>
                    <?php
                    $layidcty = $p->laycot("select idcty from sanpham where idsp='$layid' limit 1");
                    $p->choncongty("select * from congty order by tencty asc", $layidcty);
                    ?>
                    <input type="text" name="txtid" id="txtid" value="<?php echo $layid; ?>">
                </td>
            </tr>
            <tr>
                <td><label for="txtten">Nhập tên sản phẩm:</label></td>
                <td><input type="text" id="txtten" name="txtten" value="<?php echo $layten; ?>"></td>
            </tr>
            <tr>
                <td><label for="txtgia">Nhập giá:</label></td>
                <td><input type="text" id="txtgia" name="txtgia" value="<?php echo $laygia; ?>"></td>
            </tr>
            <tr>
                <td><label for="txtmota">Nhập mô tả:</label></td>
                <td><textarea id="txtmota" name="txtmota" cols="100" rows="10" style="width: 85%;"><?php echo $laymota; ?></textarea></td>
            </tr>
            <tr>
                <td><label for="myfile">Hình đại diện:</label></td>
                <td><input type="file" id="myfile" name="myfile"></td>
            </tr>
            <tr>
                <td><label for="txtgiamgia">Nhập giảm giá:</label></td>
                <td><input type="text" id="txtgiamgia" name="txtgiamgia" value="<?php echo $laygiamgia; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" id="nut" name="nut" value="Thêm sản phẩm">
                    <input type="submit" id="nut" name="nut" value="Sửa sản phẩm">
                    <input type="submit" id="nut" name="nut" value="Xóa sản phẩm">
                </td>
            </tr>
        </table>
        <div align="center">
            <?php
            if (isset($_POST['nut'])) {
                switch ($_POST['nut']) {
                    case 'Thêm sản phẩm': {
                            $name = $_FILES['myfile']['name'];
                            $tmp_name = $_FILES['myfile']['tmp_name'];
                            $idcty = $_REQUEST['congty'];
                            $ten = $_REQUEST['txtten'];
                            $gia = $_REQUEST['txtgia'];
                            $mota = $_REQUEST['txtmota'];
                            $giamgia = $_REQUEST['txtgiamgia'];

                            if ($name != '') {
                                $name = time() . "_" . $name;
                                if ($p->uploadFile($name, $tmp_name, "../img")) {
                                    if ($p->themxoasua("INSERT INTO sanpham (tensp, gia, mota, hinh, giamgia, idcty) VALUES ('$ten', '$gia', '$mota','$name', '$giamgia', '$idcty')") == 1) {
                                        echo '<script language="javascript">
                                            alert("Thêm sản phẩm thành công.");
                                            </script>';
                                    } else {
                                        echo '<script language="javascript">
                                            alert("Thêm sản phẩm không thành công. Vui lòng kiểm tra lại.");
                                            </script>';
                                    }
                                } else {
                                    echo '<script language="javascript">
                                    alert("Upload hình không thành công.");
                                    </script>';
                                }
                            } else {
                                echo '<script language="javascript">
                                    alert("Vui lòng chọn hình cần upload.");
                                    </script>';
                            }

                            echo '<script language="javascript">
                            window.location="../admin/admin.php";
                            </script>';

                            break;
                        }
                    case 'Sửa sản phẩm': {
                            $idsua = $_REQUEST['txtid'];
                            $idcty = $_REQUEST['congty'];
                            $ten = $_REQUEST['txtten'];
                            $gia = $_REQUEST['txtgia'];
                            $mota = $_REQUEST['txtmota'];
                            $giamgia = $_REQUEST['txtgiamgia'];
                            if ($idsua > 0) {
                                if ($p->themxoasua("UPDATE  sanpham SET tensp = '$ten',gia='$gia',mota='$mota',giamgia='$giamgia',idcty='$idcty' WHERE idsp='$idsua' LIMIT 1") == 1) {
                                    echo '<script language="javascript">
                                            alert("Sửa thành công.");
                                            </script>';
                                } else {
                                    echo '<script language="javascript">
                                            alert("Sửa không thành công.");
                                            </script>';
                                }
                            } else {
                                echo '<script language="javascript">
                                    alert("Vui lòng chọn sản phẩm cần sửa.");
                                    </script>';
                            }

                            echo '<script language="javascript">
                            window.location="../admin/admin.php";
                            </script>';

                            break;
                        }
                    case 'Xóa sản phẩm': {
                            $idxoa = $_REQUEST['txtid'];
                            $hinh = $p->laycot("select hinh from sanpham where idsp='$idxoa' limit 1");
                            if ($idxoa > 0) {

                                if ($p->themxoasua("delete from sanpham where  idsp='$idxoa' limit 1") == 1) {

                                    if (unlink("../img/" . $hinh)) {
                                        echo '<script language="javascript">
                                            alert("Xoá thành công.");
                                            </script>';
                                    } else {
                                        echo '<script language="javascript">
                                            alert("Xóa hình không thành công.");
                                            </script>';
                                    }
                                } else {
                                    echo '<script language="javascript">
                                    alert("Xoá không thành công.");
                                    </script>';
                                }
                            } else {
                                echo '<script language="javascript">
                                    alert("Vui lòng chọn sản phẩm cần xóa.");
                                    </script>';
                            }

                            echo '<script language="javascript">
                            window.location="../admin/admin.php";
                            </script>';
                            break;
                        }
                }
            }

            ?>
        </div>
    </form>

    <table class="display-table">
        <?php
        $p->danhsachsanpham("select * from sanpham")
        ?>

    </table>
</body>

</html>
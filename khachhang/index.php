<?php
error_reporting(0);
include("../myclass/clslogin.php");
$p=new login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách hàng đăng nhập</title>
    <style>
        .container {
            width: 400px;
            margin: 0 auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <div class="container">
            <table>
                <tr>
                    <td colspan="2">
                        <h2>KHÁCH HÀNG ĐĂNG NHẬP</h2>
                    </td>
                </tr>
                <tr>
                    <td>Nhập email khách hàng:</td>
                    <td><input type="text" id="txtuser" name="txtuser"></td>
                </tr>
                <tr>
                    <td>Nhập mật khẩu:</td>
                    <td><input type="password" id="txtpass" name="txtpass"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="nut" id="nut" value="Đăng nhập">
                    </td>
                </tr>
            </table>
        </div>
    </form>

    <div align="center">
        <?php
        switch ($_POST['nut']) {
            case 'Đăng nhập': {
                    $user = $_REQUEST['txtuser'];
                    $pass = $_REQUEST['txtpass'];
                    if ($user != '' && $pass != '') {
                        if ($p->myloginkh($user, $pass, "khachhang", "../") == 0) {
                            echo 'Sai email hoặc mật khẩu.';
                        }
                    } else {
                        echo 'Vui lòng nhập đầy đủ thông tin.';
                    }

                    break;
                }
        }
        ?>
    </div>

    
</body>

</html>+

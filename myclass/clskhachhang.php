<?php
include("clstmdt.php");

class khachhang extends tmdt
{
    public function xemdssanpham($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        if ($ketqua) {
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                while ($row = mysqli_fetch_array($ketqua)) {
                    $idsp = $row["idsp"];
                    $tensp = $row['tensp'];
                    $gia = $row['gia'];
                    $hinh = $row['hinh'];
                    echo '
                    <div id="sanpham">
                        <div id="sanpham_ten">' . $tensp . '</div>
                        <div id="sanpham_hinh">
                            <a href="chitietsanpham.php?id=' . $idsp . '"> 
                            <img class="sanpham_fit_img" src="./img/' . $hinh . '" alt=""></a>
                        </div>
                        <div id="sanpham_gia">Giá: ' . $gia . '</div>
                    </div>
                    ';
                }
            } else {
                echo 'Không có dữ liệu';
            }
        } else {
            echo 'Lỗi trong quá trình thực hiện câu truy vấn';
        }
    }

    public function xemchitietsanpham($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        if ($ketqua) {
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                echo '<table>';
                while ($row = mysqli_fetch_array($ketqua)) {
                    $idsp = $row["idsp"];
                    $tensp = $row['tensp'];
                    $mota = $row['mota'];
                    $gia = $row['gia'];
                    $hinh = $row['hinh'];
                    $giamgia = $row['giamgia'];
                    $idcty = $row['idcty'];
                    $tencty = $this->laycot("select tencty from congty where idcty='$idcty' limit 1");
                    echo '
                    <colgroup>
                        <col style="width: 300px;">
                        <col style="width: 200px;">
                        <col style="width: 300px;">
                    </colgroup>
                    <tr>
                        <th colspan="3">Chi Tiết Sản Phẩm</th>
                    </tr>
                    <tr>
                        <td rowspan="7" align="center" valign="middle"><img src="img/' . $hinh . '" width="205px" height="246px" alt=""/></td>
                        <td>Tên sản phẩm</td>
                        <td>' . $tensp . '</td>
                    </tr>
                    <tr>
                        <td>Nhà sản xuất</td>
                        <td>' . $tencty . '</td>
                    </tr>
                    <tr>
                        <td>Mô tả</td>
                        <td>' . $mota . '</td>
                    </tr>
                    <tr>
                        <td>Giá</td>
                        <td>' . $gia . '</td>
                    </tr>
                    <tr>
                        <td>Giảm giá</td>
                        <td>' . $giamgia . '</td>
                    </tr>
                    <tr>
                        <td>Số Lượng</td>
                        <td><input type="text" name="txtsoluong" value="1"></td>
                    </tr>
                    <tr>
                        <td>Đặt hàng</td>
                        <td><input type="submit" name="nut" id="nut" value="Thêm vào giỏ hàng"class="add-to-cart-btn"></td>
                    </tr>
                    ';
                }
                echo '</table>';
            } else {
                echo 'Không có dữ liệu';
            }
        } else {
            echo 'Đang cập nhật sản phẩm.';
        }
    }

    public function giohang($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        if ($ketqua) {
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                echo '<table border="1" align="center">
                <tbody>
                    <tr>
                        <td width="44" algin="center" valign="middle">STT</td>
                        <td width="189" algin="center" valign="middle">Tên Sản Phẩm</td>
                        <td width="103" algin="center" valign="middle">Số Lượng</td>
                        <td width="116" algin="center" valign="middle">Đơn Giá</td>
                        <td width="106" algin="center" valign="middle">Giảm Giá</td>
                    </tr>
                ';
                $dem = 1;
                while ($row = mysqli_fetch_array($ketqua)) {

                    $idsp = $row[0];
                    $tensp=$this->laycot("select tensp from sanpham where idsp='$idsp' limit 1");
                    $soluong = $row[1];
                    $dongia = $row[2];
                    $giamgia = $row[3];

                    echo '
                    <tr>
                    <td align="center" valign="middle">'.$dem.'</td>                    
                    <td align="center" valign="middle">'.$tensp.'</td>
                    <td align="center" valign="middle">'.$soluong.'</td>
                    <td align="center" valign="middle">'.$dongia.'</td>
                    <td align="center" valign="middle">'.$giamgia.'</td>
                    </tr>';
                    $dem++;
                }
                echo '
                </tbody>
                </table>';
            } else {
                echo 'Không có dữ liệu';
            }
        } else {
            echo 'Lỗi trong quá trình thực hiện câu truy vấn';
        }
    }
}

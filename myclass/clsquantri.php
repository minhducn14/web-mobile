<?php
include("clstmdt.php");
class quantri extends tmdt
{
    public function choncongty($sql, $idchon)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        if ($ketqua) {
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                echo '
                    <select name="congty" id="congty" >
                        <option value="">Mời chọn công ty</option>
                ';
                while ($row = mysqli_fetch_array($ketqua)) {
                    $id = $row["idcty"];
                    $ten = $row['tencty'];
                    if($id==$idchon)
                    {
                        echo '<option value="'.$id.'" selected>'.$ten.'</option>';
                    }
                    else
                    {
                        echo '<option value="' . $id . '">' . $ten . '</option>';
                    }
                }
            } else {
                echo ' </select>';
            }
        } else {
            echo 'Không có dữ liệu';
        }
    }

    public function danhsachsanpham($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        if ($ketqua) {
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                echo'<table class="display-table">
                <tbody>
                    <tr>
                        <th>STT</th>
                        <th>TÊN SẢN PHẨM</th>
                        <th>MÔ TẢ</th>
                        <th>GIÁ</th>
                        <th>GIẢM GIÁ</th>
                    </tr>';
                while ($row = mysqli_fetch_array($ketqua)) {
                    $idsp = $row["idsp"];
                    $tensp = $row['tensp'];
                    $mota = $row['mota'];
                    $gia = $row['gia'];
                    $giamgia = $row['giamgia'];
                    echo '<tr>
                    <td><a href="?id=' . $idsp . '">' . $idsp . '</a></td>
                    <td><a href="?id=' . $idsp . '">' . $tensp . '</a></td>
                    <td><a href="?id=' . $idsp . '">' . $mota . '</a></td>
                    <td><a href="?id=' . $idsp . '">' . $gia . '</a></td>
                    <td><a href="?id=' . $idsp . '">' . $giamgia . '</a></td>
                    </tr>';
                
                }
            } else {
                echo ' </tbody>
                    </table>';
            }
        } else {
            echo 'Không có dữ liệu';
        }
    }

    public function uploadFile($name, $tmp_name, $folder)
    {
        $newname = $folder . "/" . $name;
        if (move_uploaded_file($tmp_name, $newname)) {
            return 1;
        } else {
            return 0;
        }
    }



    

    
}

<?php
class tmdt
{
    public function connect()
    {
        $con = mysqli_connect("localhost", "dly", "123456", "tmdt_db");

        if (!$con) { 
            return false; 
        } else {
            mysqli_set_charset($con, "utf8");
            return $con; 
        }
    }

    public function xuatcongty()
    {
        $sql = "SELECT * FROM congty"; 
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        if ($ketqua) {
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                echo '<table width="490" border="1" align="center" cellpadding="5" cellspacing="1">
                <tbody>
                    <tr>
                        <td width="30" align="center" valign="middle"><strong>STT</strong></td>
                        <td width="83" align="center" valign="middle"><strong>TÊN CÔNG TY</strong></td>
                        <td width="148" align="center" valign="middle"><strong>ĐỊA CHỈ</strong></td>
                    </tr>';
                $dem = 1;
                while ($row = mysqli_fetch_array($ketqua)) {
                    $id = $row['idcty'];
                    $ten = $row['tencty'];
                    $diachi = $row['diachi'];
                    echo '<tr>
                            <td align="center" valign="middle">' . $dem . '</td>
                            <td align="center" valign="middle">' . $ten . '</td>
                            <td align="center" valign="middle">' . $diachi . '</td>
                        </tr>';
                    $dem++;
                }
                echo '</tbody></table>';
            }
        } else {
            echo "Query failed: " . mysqli_error($link);
        }
    }
    
    
    public function xemdscongty($sql, $dict){
        if($dict == "admin"){
            $dict = "../index.php";
        } else {
            $dict = "index.php";
        }
        $link=$this->connect(); 
        $ketqua=mysqli_query ($link, $sql); 
        if ($ketqua) { 
            $i=mysqli_num_rows ($ketqua) ;
            if ($i>0)
            {
                while ($row=mysqli_fetch_array($ketqua))
                {
                    $idcty=$row["idcty"];
                    $tencty=$row['tencty'];
                    echo'<a href="'.$dict.'?id='.$idcty.'">Điện thoại '.$tencty.'</a>';
                    echo '<br>';
                }
            } else {
                echo 'Không có dữ liệu';
            }
        } else {
            echo 'Lỗi trong quá trình thực hiện câu truy vấn';
        }
    }
    public function laycot($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        $giatri ='';
        if ($ketqua) 
        {
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                
                while ($row = mysqli_fetch_array($ketqua)) {
                    $gt = $row["0"];
                    $giatri = $gt;
                    
                }
            } 
        } 
        return $giatri;
    }

    public function themxoasua($sql)
    {
        $link = $this->connect();
        if (mysqli_query($link, $sql)) 
        {
            return 1;
        } else {
            return 0;
        }
    }
}
?>

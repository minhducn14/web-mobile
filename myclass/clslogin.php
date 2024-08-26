<?php
session_start();
class login {
    public function connectlogin()
    {
        $con = mysqli_connect("localhost", "dly", "123456", "tmdt_db");

        if (!$con) { 
            return false; 
        } else {
            mysqli_set_charset($con, "utf8");
            return $con; 
        }
    }

    public function mylogin ($user, $pass)
    {
        $pass=md5($pass);
        $sql = "select iduser, username, password, phanquyen from taikhoan where username='$user' and password ='$pass' limit 1";
        $link=$this->connectlogin();
        $ketqua=mysqli_query ($link, $sql); 
        $i=mysqli_num_rows ($ketqua) ;
        if($i == 1)
        {
            while ($row = mysqli_fetch_array($ketqua)) 
            {
                $id=$row['iduser'];
                $myuser=$row['username'];
                $mypass=$row['password'];
                $phanquyen=$row['phanquyen'];
                session_start();
                $_SESSION['id']=$id;
                $_SESSION['user']=$myuser;
                $_SESSION['pass']=$mypass;
                $_SESSION['phanquyen']=$phanquyen;
                header('location: ../admin/admin.php');
            }
            
        }
        else
        {
            return 0;
        }
    }

    public function myloginkh ($user, $pass, $table, $header)
    {
        $pass=md5($pass);
        $sql = "select iduser, username, password, phanquyen from $table where username='$user' and password ='$pass' limit 1";
        $link=$this->connectlogin();
        $ketqua=mysqli_query ($link, $sql); 
        $i=mysqli_num_rows ($ketqua) ;
        if($i == 1)
        {
            while ($row = mysqli_fetch_array($ketqua)) 
            {
                $idkh=$row['iduser'];
                $myuser=$row['username'];
                $mypass=$row['password'];
                $phanquyen=$row['phanquyen'];
                session_start();
                $_SESSION['idkh']=$idkh;
                $_SESSION['user']=$myuser;
                $_SESSION['pass']=$mypass;
                $_SESSION['phanquyen']=$phanquyen;
                header('location: '.$header);
            }
            
        }
        else
        {
            return 0;
        }
    }

    public function confirmlogin($id, $user, $pass, $phanquyen)
    {
        $sql="select iduser from taikhoan where iduser ='$id' and username='$user' and password='$pass' and phanquyen='$phanquyen' limit 1";
        $link=$this->connectlogin();
        $ketqua=mysqli_query ($link, $sql); 
        $i=mysqli_num_rows ($ketqua) ;
        if($i!=1)
        {
            header('location: ../login/');
        }
    }
}
?>
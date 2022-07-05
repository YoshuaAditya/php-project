<?php
include("connection/koneksi.php");

SESSION_START();

if(!$_POST['pass1'] || !$_POST['pass2']){
   header("location:../changePassword.php?alert=1");

}else {
    $sql  = "SELECT * FROM user WHERE id_user = '".$_SESSION['id']."'" ;
    $cek=mysqli_query($connect,$sql);
    $hasil = mysqli_fetch_assoc($cek);
    $pass1  = md5($_POST['pass1']);
    $pass2 = md5($_POST['pass2']);
    if($pass1 == $hasil['password_user']){
        $query = "UPDATE user set password_user = '".$pass2."' WHERE id_user='".$_SESSION['id']."'";
        $run = mysqli_query($connect, $query);
        if($run){
            $_SESSION = array();
            header("location:../login.php?alert=3");
        }else{
            header("location:../changePassword.php?alert=1");
        }
    }else{
        header("location:../changePassword.php?alert=1");
    }
}

<?php
include("connection/koneksi.php");

SESSION_START();

if(!$_POST['pass1'] || !$_POST['pass2']){
   header("location:../changePassword.php?alert=1");	
   
}else {
    $pass1  = md5($_POST['pass1']);
    $pass2 = md5($_POST['pass2']);
    if($pass1 == $pass2){
        $query = "UPDATE user set password_user = '".$pass1."' WHERE id_user='".$_SESSION['id_user']."'";
        $run = mysqli_query($connect, $query);
        if($run){
            header("location:../changePassword.php?alert=2");	
        }else{
            header("location:../changePassword.php?alert=1");	
        }
    }else{
        header("location:../changePassword.php?alert=1"); 
    }
}




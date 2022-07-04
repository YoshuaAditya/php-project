<?php
include("connection/koneksi.php");

SESSION_START();

if(!$_POST['username'] || !$_POST['password']){
   header("location:../login.php?alert=1");	
   
}else {
    $username  = $_POST['username'];
    $pass = md5($_POST['password']);
    $sql  = "SELECT * FROM user WHERE username = '".$username."' AND password_user = '".$pass."' AND status_user = '1'" ;
    $cek=mysqli_query($connect,$sql);
	$jumlah = mysqli_num_rows($cek);
    $hasil = mysqli_fetch_assoc($cek);
    if($jumlah == 0 ){
        header("location:../login.php?alert=1");
    }else {
        $_SESSION['id']	    	    = $hasil['id_user'];   
        $_SESSION['akses']  	        = $hasil ['fk_id_al'];
        $_SESSION['nama']	    	    = $hasil['username'];      
        header("location:../index.php");
    }
}




<?php
    include("connection/koneksi.php");
    
    if(!empty($_POST["nama"])){
        $nama = $_POST['nama'];
    }
    if(!empty($_POST["alamat"])){
        $alamat = $_POST['alamat'];
    }
    $status=$_POST['status'];


  
    if(!$nama || !$alamat ){
        
        header("location:../menu.phpalert=1");
        
    }else {
        $query = "INSERT INTO menu(nama_menu, alamat_menu, status_menu)
         VALUES ('".$nama."', '".$alamat."', '".$status."')";
        $jalan = mysqli_query($connect,$query);
        if($jalan){
            
           header("location:../menu.php?alert=2");

        }
        else {
            
           header("location:../menu.php?alert=3");
            
        }
    }
    
  
        
?>
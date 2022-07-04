<?php
    include("connection/koneksi.php");
    
    if(!empty($_POST["nama"])){
        $nama = $_POST['nama'];
    }

    $status=$_POST['status'];


  
    if(!$nama ){
        
        header("location:../kategori_menu.phpalert=1");
        
    }else {
        $query = "INSERT INTO kategori_menu(nama_category, status_category)
         VALUES ('".$nama."', '".$status."')";
        $jalan = mysqli_query($connect,$query);
        if($jalan){
            
           header("location:../kategori_menu.php?alert=2");

        }
        else {
            
           header("location:../kategori_menu.php?alert=3");
            
        }
    }
    
  
        
?>
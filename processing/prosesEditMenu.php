<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }
    if(!empty($_POST["nama_menu"])){
        $nama = $_POST['nama_menu'];
    }
    if(!empty($_POST["alamat_menu"])){
        $alamat_menu = $_POST['alamat_menu'];
    }
    if(!empty($_POST["status_menu"])){
        $status_menu = $_POST['status_menu'];
    }
    


  
    if(!$nama || !$alamat_menu ){
        
       header("location:../menu.php?alert=1");
        
    }else {
       echo $query = "UPDATE menu SET 
        nama_menu= '$nama' ,
        alamat_menu= '$alamat_menu' , 
        status_menu= '$status_menu'  WHERE id_menu = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){
            
            header("location:../menu.php?alert=2");

        }
        else {
            
            header("location:../menu.php?alert=3");
            
        }
    }
    
  
        
?>
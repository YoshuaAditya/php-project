<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }
    if(!empty($_POST["nama_category"])){
        $nama = $_POST['nama_category'];
    }
    if(!empty($_POST["status_category"])){
        $status_menu = $_POST['status_category'];
    }
    


  
    if(!$nama ){
        
       header("location:../kategori_menu.php?alert=1");
        
    }else {
       echo $query = "UPDATE kategori_menu SET 
        nama_category= '$nama' ,
        status_category= '$status_menu' WHERE id_category = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){
            
            header("location:../kategori_menu.php?alert=2");

        }
        else {
            
            header("location:../kategori_menu.php?alert=3");
            
        }
    }
    
  
        
?>
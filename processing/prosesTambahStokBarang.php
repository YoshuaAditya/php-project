<?php
    include("connection/koneksi.php");
    if(!empty($_POST["fk_id_category"])){
        $fk_id_category = $_POST['fk_id_category'];
    }
    if(!empty($_POST["fk_id_menu"])){
        $fk_id_menu = $_POST['fk_id_menu'];
    }
    if(!empty($_POST["fk_id_al"])){
        $fk_id_al = $_POST['fk_id_al'];
    }

    echo $status_access_menu = $_POST['status'];
    
    


  
    if(!$fk_id_category || !$fk_id_menu || !$fk_id_al){
        
       header("location:../accessMenu.php?alert=1");
        
    }else {
        $query = "INSERT INTO access_menu(fk_id_category, fk_id_menu, fk_id_al, status_access_menu) VALUES
        ('".$fk_id_category."','".$fk_id_menu."','".$fk_id_al."','".$status_access_menu."')";
        $jalan = mysqli_query($connect,$query);
        if($jalan){
            
            header("location:../accessMenu.php?alert=2");

        }
        else {
            
            header("location:../accessMenu.php?alert=3");
            
        }
    }
    
  
        
?>
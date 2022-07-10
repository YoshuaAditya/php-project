<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
         $id = $_POST['id'];
    }
    if(!empty($_POST["nama_jenis"])){
         $id_jenis = $_POST['nama_jenis'];
    }
    if(!empty($_POST["nama_transaksi"])){
         $nama_transaksi = $_POST['nama_transaksi'];
    }
    if(!empty($_POST["nama_projek"])){
         $id_projek = $_POST['nama_projek'];
    }
    if(!empty($_POST["qty"])){
         $qty = $_POST['qty'];
    }
    if(!empty($_POST["satuan"])){
         $satuan = $_POST['satuan'];
    }
    $keterangan_transaksi = $_POST['keterangan_transaksi'];






    if(!$id_jenis||!$nama_transaksi||!$id_projek||!$qty||!$satuan){

       header("location:../dataPengeluaran.php?alert=1");

    }else {
       echo $query = "UPDATE transaksi SET
        fk_id_jenis_transaksi= '$id_jenis' ,
        nama_transaksi= '$nama_transaksi' ,
        fk_id_projek= '$id_projek' ,
        qty= '$qty' ,
        satuan= '$satuan' ,
        keterangan_transaksi= '$keterangan_transaksi' WHERE id_transaksi = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../dataPengeluaran.php?alert=2");

        }
        else {

            header("location:../dataPengeluaran.php?alert=3");

        }
    }



?>

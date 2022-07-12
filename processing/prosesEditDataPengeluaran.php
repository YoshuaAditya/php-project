<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
         $id = $_POST['id'];
    }
    if(!empty($_POST["fk_id_perusahaan"])){
         $fk_id_perusahaan = $_POST['fk_id_perusahaan'];
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
    if(!empty($_POST["tanggal"])){
         $tanggal = $_POST['tanggal'];
    }
    $pengeluaran=false;$previousPengeluaran=false;
    if(!empty($_POST["pengeluaran"])){
         $pengeluaran = $_POST['pengeluaran'];
         $previousPengeluaran=$_POST['previousPengeluaran'];
    }
    $pemasukan=false;$previousPemasukan=false;
    if(!empty($_POST["pemasukan"])){
         $pemasukan = $_POST['pemasukan'];
         $previousPemasukan=$_POST['previousPemasukan'];
    }
    if(!empty($_POST["qty"])){
         $qty = $_POST['qty'];
    }
    if(!empty($_POST["satuan"])){
         $satuan = $_POST['satuan'];
    }
    $keterangan_transaksi = $_POST['keterangan_transaksi'];

    if(!$fk_id_perusahaan||!$id_jenis||!$nama_transaksi||!$id_projek||!$qty||!$satuan||!$tanggal){

       header("location:../dataPengeluaran.php?alert=1");

    }else if($pengeluaran){
       echo $query = "UPDATE transaksi SET
        fk_id_jenis_transaksi= '$id_jenis' ,
        nama_transaksi= '$nama_transaksi' ,
        pengeluaran= '$pengeluaran' ,
        fk_id_projek= '$id_projek' ,
        qty= '$qty' ,
        satuan= '$satuan' ,
        keterangan_transaksi= '$keterangan_transaksi' WHERE id_transaksi = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){
           $query = "UPDATE transaksi SET
           saldo_before_transaction = saldo_before_transaction - '$pengeluaran' + '$previousPengeluaran' WHERE id_transaksi > '$id' AND fk_id_perusahaan = '$fk_id_perusahaan' AND tanggal_transaksi = '$tanggal'";
           $jalan = mysqli_query($connect,$query);

           $query = "UPDATE saldo SET
           saldo = saldo - '$pengeluaran' + '$previousPengeluaran' WHERE fk_id_perusahaan='$fk_id_perusahaan'";
           $jalan = mysqli_query($connect,$query);
           if($jalan){
            header("location:../dataPengeluaran.php?alert=2");
           }
           else {
               header("location:../dataPengeluaran.php?alert=3");
           }
        }
        else {
            header("location:../dataPengeluaran.php?alert=3");
        }
    }else{
       echo $query = "UPDATE transaksi SET
       fk_id_jenis_transaksi= '$id_jenis' ,
       nama_transaksi= '$nama_transaksi' ,
       pemasukan= '$pemasukan' ,
       fk_id_projek= '$id_projek' ,
       qty= '$qty' ,
       satuan= '$satuan' ,
       keterangan_transaksi= '$keterangan_transaksi' WHERE id_transaksi = '$id'";
       $jalan = mysqli_query($connect,$query);
       if($jalan){
          $query = "UPDATE transaksi SET
          saldo_before_transaction = saldo_before_transaction + '$pemasukan' - '$previousPemasukan' WHERE  id_transaksi > '$id' AND fk_id_perusahaan = '$fk_id_perusahaan' AND tanggal_transaksi = '$tanggal'";
          $jalan = mysqli_query($connect,$query);

          $query = "UPDATE saldo SET
          saldo = saldo + '$pemasukan' - '$previousPemasukan' WHERE fk_id_perusahaan = '$fk_id_perusahaan'";
          $jalan = mysqli_query($connect,$query);
          if($jalan){
           header("location:../dataPengeluaran.php?alert=2");
          }
          else {
              header("location:../dataPengeluaran.php?alert=3");
          }
       }
       else {
           header("location:../dataPengeluaran.php?alert=3");
       }
    }



?>

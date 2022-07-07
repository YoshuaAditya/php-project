<?php
SESSION_START();
include("connection/koneksi.php");
include("fungsi.php");
date_default_timezone_set("Asia/Jakarta");
//ini berfungsi untuk membedakan mana transaksi pengeluaran (1) dan pemasukan (2)
$transaksi = $_GET['trx'];
echo $id = "TRB".date("dmYHis");
if(!empty($_POST["nama_barang"])){
   $nama_barang = $_POST['nama_barang'];
}
$id_lokasi = '5';
if(!empty($_POST["qty"])){
   $qty = $_POST['qty'];
}else{
   $qty = "1";
}
if(!empty($_POST["keterangan"])){
    $keterangan = $_POST['keterangan'];
}else{
    $keterangan = "";
}
$dataStock=getIdStockBarang($id_lokasi,$nama_barang,$connect);
$id_stock_barang=$dataStock['id_stock_barang'];
$stock=$dataStock['stock'];

if($id_stock_barang==0){
  header("location:../transaksiBarangCVKCI.php?alert=3&trx=".$transaksi);
}
else{
if($transaksi == "1"){
    // --------------------------------------------------- Ini untuk transaksi 1 Pengeluaran ----------------------------------------------------------------
    $newStock = $stock - $qty;
    if($newStock<0){
      header("location:../transaksiBarangCVKCI.php?alert=4&trx=1");
    }
    else{
      $query = "INSERT INTO transaksi_bbm(id_transaksi_bbm, fk_id_stock_barang, fk_id_lokasi, tanggal_transaksi, pengeluaran_stock, stock_sebelumnya, status_transaksi, keterangan_transaksi)";
      $query .= "VALUES('".$id."', '".$id_stock_barang."', '".$id_lokasi."',NOW(),'".$qty."','".$stock."','1','".$keterangan."')";

      $run = mysqli_query($connect, $query);
      if ($run){
        if (updateStock($newStock, $id_stock_barang, $connect) == True){
            $headerValue="location:../transaksiBarangCVKCI.php?alert=2&trx=1";
            header($headerValue);
           }else{
              deleteTransasksiBarang($id, $connect);
           }

      }else{
         $headerValue="location:../transaksiBarangCVKCI.php?alert=1&trx=1";
         header($headerValue);
      }
    }
}elseif($transaksi == "2"){
   // --------------------------------------------------- Ini untuk transaksi 2 Pemasukan ----------------------------------------------------------------
   $query = "INSERT INTO transaksi_bbm(id_transaksi_bbm, fk_id_stock_barang, fk_id_lokasi, tanggal_transaksi, pemasukan_stock, stock_sebelumnya, status_transaksi, keterangan_transaksi)";
   $query .= "VALUES('".$id."', '".$id_stock_barang."', '".$id_lokasi."',NOW(),'".$qty."','".$stock."','1','".$keterangan."')";

   $run = mysqli_query($connect, $query);
   if ($run){
     $newStock = $stock + $qty;
     if (updateStock($newStock, $id_stock_barang, $connect) == True){
         $headerValue="location:../transaksiBarangCVKCI.php?alert=2&trx=2";
         header($headerValue);
        }else{
           deleteTransasksiBarang($id, $connect);
        }

   }else{
      $headerValue="location:../transaksiBarangCVKCI.php?alert=1&trx=2";
      header($headerValue);
   }
}
}


?>

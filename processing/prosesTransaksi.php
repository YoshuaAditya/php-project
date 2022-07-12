<?php
SESSION_START();
include("connection/koneksi.php");
include("fungsi.php");
date_default_timezone_set("Asia/Jakarta");
//ini berfungsi untuk membedakan mana transaksi pengeluaran (1) dan pemasukan (2)
$transaksi = $_GET['trx'];
echo $alt_id = "TR".date("dmYHis");
//ini untuk mengambil data  perusahaan yang input
$prs = $_GET['prs'];
if($_SESSION['akses'] == 5){
   $perusahaan = getIdPerusahaan($prs, $connect);
}else {
   $perusahaan = getIdPerusahaan($_SESSION['akses'], $connect);
}

$saldo = getIdSaldo($perusahaan, $connect);
$jumlahSaldo = getJumlahSaldo($perusahaan, $connect);
if(!empty($_POST["jenis_transaksi"])){
    $jenis = $_POST['jenis_transaksi'];
}
if(!empty($_POST["nama"])){
   $nama_barang = $_POST['nama'];
}
if(!empty($_POST["proyek"]) && $prs == 1){
   $id_proyek = $_POST['proyek'];
}else{
   $id_proyek = "1";
}

if(!empty($_POST["qty"])){
   $qty = $_POST['qty'];
}else{
   $qty = "";
}

if(!empty($_POST["satuan"])){
   $satuan = $_POST['satuan'];
}

if(!empty($_POST["uang"])){
    $uang = $_POST['uang'];
}

 if(!empty($_POST["keterangan"])){
    $keterangan = $_POST['keterangan'];
 }else{
    $keterangan = "";
 }

if($qty <= 0){
 header("location:../transaksi.php?alert=3&trx=".$transaksi."&prs=".$prs);
}
elseif($uang <= 0){
 header("location:../transaksi.php?alert=4&trx=".$transaksi."&prs=".$prs);
}
else{
if($transaksi == "1"){
    // --------------------------------------------------- Ini untuk transaksi 1 Pengeluaran ----------------------------------------------------------------
    $query = "INSERT INTO transaksi(alt_id_transaksi, fk_id_perusahaan, fk_id_saldo, fk_id_jenis_transaksi, nama_transaksi, fk_id_projek, qty, satuan, pengeluaran, saldo_before_transaction, tanggal_transaksi, keterangan_transaksi, status_transaksi)";
    $query .= "VALUES('".$alt_id."', '".$perusahaan."', '".$saldo."', '".$jenis."','".$nama_barang."','".$id_proyek."','".$qty."','".$satuan."', '".$uang."','".$jumlahSaldo."',NOW(),'".$keterangan."','1')";

    $run = mysqli_query($connect, $query);
    if ($run){
      $newSaldo = $jumlahSaldo - $uang;
      if (updateSaldo($newSaldo, $saldo, $connect) == True){
          $headerValue="location:../transaksi.php?alert=2&trx=1&prs=".$perusahaan;
          header($headerValue);
         }else{
            deleteTransasksi($alt_id, $connect);
         }

    }else{
       $headerValue="location:../transaksi.php?alert=1&trx=1&prs=".$perusahaan;
       header($headerValue);
    }
}elseif($transaksi == "2"){
   // --------------------------------------------------- Ini untuk transaksi 2 Pemasukan ----------------------------------------------------------------
   $query = "INSERT INTO transaksi(alt_id_transaksi, fk_id_perusahaan, fk_id_saldo, fk_id_jenis_transaksi, nama_transaksi, fk_id_projek, qty, satuan, pemasukan, saldo_before_transaction, tanggal_transaksi, keterangan_transaksi, status_transaksi)";
   $query .= "VALUES('".$alt_id."', '".$perusahaan."', '".$saldo."', '".$jenis."','".$nama_barang."','".$id_proyek."','".$qty."','".$satuan."', '".$uang."','".$jumlahSaldo."',NOW(),'".$keterangan."','1')";

   $run = mysqli_query($connect, $query);
   if ($run){
      $newSaldo = $jumlahSaldo + $uang;
      if (updateSaldo($newSaldo, $saldo, $connect) == True){
        $headerValue="location:../transaksi.php?alert=2&trx=2&prs=".$perusahaan;
         header($headerValue);
      }else{
         deleteTransasksi($alt_id, $connect);
      }

   }else{
      $headerValue="location:../transaksi.php?alert=1&trx=2&prs=".$perusahaan;
      header($headerValue);
   }
 }
}



?>

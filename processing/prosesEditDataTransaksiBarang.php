<?php
    include("connection/koneksi.php");
    include("fungsi.php");
    if(!empty($_POST["id"])){
         $id = $_POST['id'];
    }
    if(!empty($_POST["fk_id_perusahaan"])){
         $fk_id_perusahaan = $_POST['fk_id_perusahaan'];
    }
    $previousLokasi=$_POST["previousLokasi"];
    if(!empty($_POST["id_lokasi"])){
         $id_lokasi = $_POST['id_lokasi'];
    }
    $prev_id_stock_barang=$_POST["previousBarang"];
    if(!empty($_POST["nama_barang"])){
       $nama_barang = $_POST['nama_barang'];
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
    if(!empty($_POST["tanggal"])){
         $tanggal = $_POST['tanggal'];
    }
    $keterangan_transaksi = $_POST['keterangan_transaksi'];

    if(!$id_lokasi||!$nama_barang){
       header("location:../dataTransaksiBarang.php?alert=1");
    }
    $dataStock=getIdStockBarang($id_lokasi,$nama_barang,$fk_id_perusahaan,$connect);
    $id_stock_barang=$dataStock['id_stock_barang'];
    $stock=$dataStock['stock'];

    $lastStock=getLastStockBarang($id,$id_stock_barang,$connect);
    if($lastStock['pemasukan_stock']){
      $prev_stock_barang=$lastStock['stock_sebelumnya']+$lastStock['pemasukan_stock'];
    }
    elseif($lastStock['pengeluaran_stock']){
      $prev_stock_barang=$lastStock['stock_sebelumnya']-$lastStock['pengeluaran_stock'];
    }
    else{
      $prev_stock_barang=$lastStock['stock_sebelumnya'];
    }


    if(!$id_stock_barang||!$prev_id_stock_barang){
      header("location:../dataTransaksiBarang.php?alert=3");
    }

    else if($pengeluaran){
      if($pengeluaran <= 0){
         header("location:../dataTransaksiBarang.php?alert=5");
      }
      else{
       echo $query = "UPDATE transaksi_bbm SET
        fk_id_stock_barang= '$id_stock_barang' ,
        fk_id_lokasi= '$id_lokasi' ,
        pengeluaran_stock= '$pengeluaran' ,
        keterangan_transaksi= '$keterangan_transaksi' WHERE id_transaksi_bbm = '$id'";
        $jalan = mysqli_query($connect,$query);

        $query = "UPDATE transaksi_bbm SET
         stock_sebelumnya= '$prev_stock_barang' WHERE id_transaksi_bbm = '$id'";
         $jalan = mysqli_query($connect,$query);


        $query = "UPDATE stock_barang SET
        stock = stock + '$previousPengeluaran' WHERE id_stock_barang = '$prev_id_stock_barang'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){
          $query = "UPDATE transaksi_bbm SET
          stock_sebelumnya = stock_sebelumnya + '$previousPengeluaran' WHERE  id_transaksi_bbm > '$id' AND fk_id_stock_barang = '$prev_id_stock_barang' AND tanggal_transaksi = '$tanggal'";
          $jalan = mysqli_query($connect,$query);

          $query = "UPDATE transaksi_bbm SET
          stock_sebelumnya = stock_sebelumnya - '$pengeluaran' WHERE  id_transaksi_bbm > '$id' AND fk_id_stock_barang = '$id_stock_barang' AND tanggal_transaksi = '$tanggal'";
          $jalan = mysqli_query($connect,$query);

          $query = "UPDATE stock_barang SET
          stock = stock - '$pengeluaran' WHERE id_stock_barang = '$id_stock_barang'";
          $jalan = mysqli_query($connect,$query);

          if($jalan){
           header("location:../dataTransaksiBarang.php?alert=2");
          }
          else {
              header("location:../dataTransaksiBarang.php?alert=3");
          }
        }
        else {

            header("location:../dataTransaksiBarang.php?alert=3");

        }
      }
    }else{
      if($pemasukan <= 0){
         header("location:../dataTransaksiBarang.php?alert=5");
      }
      else{
       echo $query = "UPDATE transaksi_bbm SET
        fk_id_stock_barang= '$id_stock_barang' ,
        fk_id_lokasi= '$id_lokasi' ,
        pemasukan_stock= '$pemasukan' ,
        keterangan_transaksi= '$keterangan_transaksi' WHERE id_transaksi_bbm = '$id'";
        $jalan = mysqli_query($connect,$query);

        $query = "UPDATE transaksi_bbm SET
         stock_sebelumnya= '$prev_stock_barang' WHERE id_transaksi_bbm = '$id'";
         $jalan = mysqli_query($connect,$query);


        $query = "UPDATE stock_barang SET
        stock = stock - '$previousPemasukan' WHERE id_stock_barang = '$prev_id_stock_barang'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){
          $query = "UPDATE transaksi_bbm SET
          stock_sebelumnya = stock_sebelumnya - '$previousPemasukan' WHERE  id_transaksi_bbm > '$id' AND fk_id_stock_barang = '$prev_id_stock_barang' AND tanggal_transaksi = '$tanggal'";
          $jalan = mysqli_query($connect,$query);

          $query = "UPDATE transaksi_bbm SET
          stock_sebelumnya = stock_sebelumnya + '$pemasukan' WHERE  id_transaksi_bbm > '$id' AND fk_id_stock_barang = '$id_stock_barang' AND tanggal_transaksi = '$tanggal'";
          $jalan = mysqli_query($connect,$query);

          $query = "UPDATE stock_barang SET
          stock = stock + '$pemasukan' WHERE id_stock_barang = '$id_stock_barang'";
          $jalan = mysqli_query($connect,$query);

          if($jalan){
           header("location:../dataTransaksiBarang.php?alert=2");
          }
          else {
              header("location:../dataTransaksiBarang.php?alert=3");
          }
        }
        else {

            header("location:../dataTransaksiBarang.php?alert=3");

        }
      }
    }


?>

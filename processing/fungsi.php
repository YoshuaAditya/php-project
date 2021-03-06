<?php


//mengecheck session apakah sudah ada atau belum
function checkSession(){
    if(!$_SESSION['akses']){
        header("location:login.php");
    }
}

//check akses apakah user boleh masuk atau tidak jika tidak ada akses maka ke halaman dashboard terus
function checkPage($level, $lokasi, $koneksi){
  /*  $query = "SELECT * FROM access_menu inner join menu on access_menu.fk_id_menu = menu.id_menu where fk_id_al ='".$level."' and menu.alamat_menu ='".$lokasi."'";
    $run = mysqli_query($koneksi, $query);
    $count = mysqli_num_rows($run);
    if($count == 0){
       header("location:index.php");

    }*/
}

function rupiah($angka){

    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;

}

function getPerusahaan($level, $koneksi){
    $query = "SELECT nama_perusahaan FROM perusahaan INNER JOIN access_level on access_level.fk_id_perusahaan = perusahaan.id_perusahaan
             WHERE access_level.id_al = '".$level."'";
    $run = mysqli_query ($koneksi, $query);
    $getData = mysqli_fetch_assoc($run);
    return $getData['nama_perusahaan'];
}

function getIdPerusahaan($level, $koneksi){
    $query = "SELECT id_perusahaan FROM perusahaan INNER JOIN access_level on access_level.fk_id_perusahaan = perusahaan.id_perusahaan
             WHERE access_level.id_al = '".$level."'";
    $run = mysqli_query ($koneksi, $query);
    $getData = mysqli_fetch_assoc($run);
    return $getData['id_perusahaan'];
}

function getIdSaldo($perusahaan, $koneksi){
    $query = "SELECT id_saldo from saldo where fk_id_perusahaan = '".$perusahaan."'";
    $run = mysqli_query ($koneksi, $query);
    $getData = mysqli_fetch_assoc($run);
    return $getData['id_saldo'];
}

function getJumlahSaldo($perusahaan, $koneksi){
    $query = "SELECT saldo from saldo where fk_id_perusahaan = '".$perusahaan."'";
    $run = mysqli_query ($koneksi, $query);
    $getData = mysqli_fetch_assoc($run);
    return $getData['saldo'];
}

function getIdStockBarang($id_lokasi, $nama_barang,$perusahaan, $koneksi){
    $query = "SELECT id_stock_barang,stock from stock_barang where fk_id_lokasi = '".$id_lokasi."' AND nama_barang = '".$nama_barang."'  AND fk_id_perusahaan = '".$perusahaan."'";
    $run = mysqli_query ($koneksi, $query);
    $getData = mysqli_fetch_assoc($run);
    return $getData;
}
function getLastStockBarang($id,$id_stock_barang, $koneksi){
  $querycount = "SELECT count(id_transaksi_bbm) as jumlah FROM transaksi_bbm";
  $run = mysqli_query ($koneksi, $querycount);
  $datacount = $run->fetch_array();
  $totalData = $datacount['jumlah'];
  if($totalData>0){
    $query = "SELECT stock_sebelumnya,pengeluaran_stock,pemasukan_stock from transaksi_bbm where id_transaksi_bbm < '".$id."' AND fk_id_stock_barang = '".$id_stock_barang."' ORDER BY id_transaksi_bbm DESC LIMIT 1";
    $run = mysqli_query ($koneksi, $query);
    $getData = mysqli_fetch_assoc($run);
    return $getData;
  }
  else {
    $query = "SELECT stock from stock_barang where id_stock_barang = '".$id_stock_barang;
    $run = mysqli_query ($koneksi, $query);
    $getData = mysqli_fetch_assoc($run);
    $getData['stock_sebelumnya'] = $getData['stock'];
    return $getData;
  }
}

function updateSaldo($saldo, $idSaldo, $koneksi){
    $query = "Update saldo SET saldo = '".$saldo."' WHERE id_saldo = '".$idSaldo."'";
    $run = mysqli_query ($koneksi, $query);
    if ($run){
        return True;
    }else{
        return False;
    }
}

function updateStock($stock, $id_stock_barang, $koneksi){
    $query = "Update stock_barang SET stock = '".$stock."' WHERE id_stock_barang = '".$id_stock_barang."'";
    $run = mysqli_query ($koneksi, $query);
    if ($run){
        return True;
    }else{
        return False;
    }
}

function deleteTransasksi($id, $koneksi){
   $query = "DELETE FROM transaksi where alt_id_transaksi = '".$id."'";
    $run = mysqli_query($koneksi, $query);
    if($run){
        return True;
    }else{
        return False;
    }
}
function deleteTransasksiBarang($id, $koneksi){
   $query = "DELETE FROM transaksi_bbm where alt_id_transaksi_bbm = '".$id."'";
    $run = mysqli_query($koneksi, $query);
    if($run){
        return True;
    }else{
        return False;
    }
}

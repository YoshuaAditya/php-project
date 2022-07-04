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

function updateSaldo($saldo, $idSaldo, $koneksi){
    $query = "Update saldo SET saldo = '".$saldo."' WHERE id_saldo = '".$idSaldo."'";
    $run = mysqli_query ($koneksi, $query);
    if ($run){
        return True;
    }else{
        return False;
    }
}

function deleteTransasksi($id, $koneksi){
   $query = "DELETE FROM transaksi where id_transaksi = '".$id."'";
    $run = mysqli_query($koneksi, $query);
    if($run){
        return True;
    }else{
        return False;
    }
}


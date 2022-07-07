<?php
SESSION_START();
require_once '../processing/connection/koneksi.php';
include("../processing/fungsi.php");
if($_SESSION['akses'] == '5'){
    $perusahaan = "";
    $condition ="";
    $conditionAddition="";
}else{
    $perusahaan = getIdPerusahaan($_SESSION['akses'],$connect);
    $condition = "where fk_id_perusahaan = '".$perusahaan."' ";
    $conditionAddition = "fk_id_perusahaan = '".$perusahaan."' AND ";
}

if($_GET['action'] == "transaksi"){


      $columns = array(
                        0  => 'id_transaksi_bbm',
                        1  => 'nama_barang',
                        2  => 'nama_perusahaan',
                        3  => 'nama_lokasi',
                        4  => 'tanggal_transaksi',
                        5  => 'pengeluaran_stock',
                        6  => 'pemasukan_stock',
                        7  => 'stock_sebelumnya',
                        8  => 'stock_akhir',
                        9  => 'keterangan_transaksi'
                    );

      $querycount = $mysqli->query("SELECT count(id_transaksi_bbm) as jumlah FROM transaksi_bbm ".$condition);
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];

        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        if(empty($_POST['search']['value']))
        {

         $query = $mysqli->query("SELECT id_transaksi_bbm, fk_id_stock_barang, tanggal_transaksi, pengeluaran_stock,
          pemasukan_stock, stock_sebelumnya, keterangan_transaksi, nama_barang, nama_perusahaan, nama_lokasi from transaksi_bbm
                                    inner join stock_barang on stock_barang.id_stock_barang = transaksi_bbm.fk_id_stock_barang
                                    inner join perusahaan on perusahaan.id_perusahaan = stock_barang.fk_id_perusahaan
                                    inner join lokasi on lokasi.id_lokasi = transaksi_bbm.fk_id_lokasi ".$condition." order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value'];
            $query = $mysqli->query("SELECT id_transaksi_bbm, fk_id_stock_barang, tanggal_transaksi, pengeluaran_stock,
             pemasukan_stock, stock_sebelumnya, keterangan_transaksi, nama_barang, nama_perusahaan, nama_lokasi from transaksi_bbm
                                       inner join stock_barang on stock_barang.id_stock_barang = transaksi_bbm.fk_id_stock_barang
                                       inner join perusahaan on perusahaan.id_perusahaan = stock_barang.fk_id_perusahaan
                                       inner join lokasi on lokasi.id_lokasi = transaksi_bbm.fk_id_lokasi WHERE ".$conditionAddition." nama_barang LIKE '%$search%'
                                                         or nama_lokasi LIKE '%$search%' or nama_perusahaan LIKE '%$search%'
                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");


           $querycount = $mysqli->query("SELECT count(id_transaksi_bbm) as jumlah, nama_barang, nama_lokasi, nama_perusahaan FROM transaksi_bbm
           inner join stock_barang on stock_barang.id_stock_barang = transaksi_bbm.fk_id_stock_barang
           inner join perusahaan on perusahaan.id_perusahaan = stock_barang.fk_id_perusahaan
           inner join lokasi on lokasi.id_lokasi = transaksi_bbm.fk_id_lokasi WHERE ".$conditionAddition." nama_barang LIKE '%$search%'
                             or nama_lokasi LIKE '%$search%' or nama_perusahaan LIKE '%$search%'");
         $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }

        $data = array();
        if(!empty($query))
        {

            while ($r = $query->fetch_array())
            {
                $newDate =  date("d-M-Y", strtotime($r['tanggal_transaksi']));
                $nestedData['id_transaksi_bbm'] =  $r['id_transaksi_bbm'];
                $nestedData['nama_barang'] = $r['nama_barang'];
                $nestedData['nama_perusahaan'] = $r['nama_perusahaan'];
                $nestedData['nama_lokasi'] = $r['nama_lokasi'];
                $nestedData['tanggal_transaksi'] = $newDate ;
                $nestedData['pengeluaran_stock'] = $r['pengeluaran_stock'];
                $nestedData['pemasukan_stock'] = $r['pemasukan_stock'];
                $nestedData['stock_sebelumnya'] = $r['stock_sebelumnya'];
                $nestedData['stock_akhir'] = $r['pengeluaran_stock']==null? $r['stock_sebelumnya']+$r['pemasukan_stock'] : $r['stock_sebelumnya']-$r['pengeluaran_stock'];
                $nestedData['keterangan_transaksi'] = $r['keterangan_transaksi'];


                $data[] = $nestedData;

            }
        }

        $json_data = array(
                    "draw"            => intval($_POST['draw']),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);

}
?>

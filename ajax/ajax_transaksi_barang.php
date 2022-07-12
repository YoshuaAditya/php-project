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
    $condition = "WHERE id_perusahaan = '".$perusahaan."' ";
    $conditionAddition = " AND id_perusahaan = '".$perusahaan."' ";
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

      $querycount = $mysqli->query("SELECT count(id_transaksi_bbm) as jumlah FROM transaksi_bbm
      inner join stock_barang on stock_barang.id_stock_barang = transaksi_bbm.fk_id_stock_barang
      inner join perusahaan on perusahaan.id_perusahaan = stock_barang.fk_id_perusahaan ".$condition);
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];
        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        $where = "";$where1="";$where2="";$where3="";$where4="";$where5="";$where6="";$where7="";$where9="";
        if(!empty($_POST['columns']['1']['search']['value'])){
          $where1 = " AND nama_barang LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['2']['search']['value'])){
          $where2 = " AND nama_perusahaan LIKE '%".$_POST['columns'][2]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['3']['search']['value'])){
          $where3 = " AND nama_lokasi LIKE '%".$_POST['columns'][3]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['4']['search']['value'])){
          $where4 = " AND tanggal_transaksi LIKE '%".$_POST['columns'][4]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['5']['search']['value'])){
          $where5 = " AND pengeluaran_stock LIKE '%".$_POST['columns'][5]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['6']['search']['value'])){
          $where6 = " AND pemasukan_stock LIKE '%".$_POST['columns'][6]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['7']['search']['value'])){
          $where7 = " AND stock_sebelumnya LIKE '%".$_POST['columns'][7]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['9']['search']['value'])){
          $where9 = " AND keterangan_transaksi LIKE '%".$_POST['columns'][9]['search']['value']."%' ";
        }

        if($where1||$where2||$where3||$where4||$where5||$where6||$where7||$where9){
          $where = " where 1=1 ";
        }
        $query = $mysqli->query("SELECT id_transaksi_bbm, fk_id_stock_barang, tanggal_transaksi, pengeluaran_stock,
         pemasukan_stock, stock_sebelumnya, keterangan_transaksi, nama_barang, nama_perusahaan, nama_lokasi, id_lokasi from transaksi_bbm
                                   inner join stock_barang on stock_barang.id_stock_barang = transaksi_bbm.fk_id_stock_barang
                                   inner join perusahaan on perusahaan.id_perusahaan = stock_barang.fk_id_perusahaan
                                   inner join lokasi on lokasi.id_lokasi = transaksi_bbm.fk_id_lokasi ".$where.$conditionAddition.$where1.$where2.$where3.$where4.$where5.$where6.$where7.$where9."
          order by $order $dir
          LIMIT $limit
          OFFSET $start");

        $querycount = $mysqli->query("SELECT count(*) as jumlah  from transaksi_bbm
                                  inner join stock_barang on stock_barang.id_stock_barang = transaksi_bbm.fk_id_stock_barang
                                  inner join perusahaan on perusahaan.id_perusahaan = stock_barang.fk_id_perusahaan
                                  inner join lokasi on lokasi.id_lokasi = transaksi_bbm.fk_id_lokasi ".$where.$conditionAddition.$where1.$where2.$where3.$where4.$where5.$where6.$where7.$where9);
        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];

        $data = array();
        if(!empty($query))
        {

            while ($r = $query->fetch_array())
            {
                $newDate =  date("d-M-Y", strtotime($r['tanggal_transaksi']));
                $todayDate =  date_create()->format('d-M-Y');
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
                if($nestedData['tanggal_transaksi'] === $todayDate){
                  $nestedData['action'] = "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                  data-id='".$r['id_transaksi_bbm']."'
                  data-id_lokasi='".$r['id_lokasi']."'
                  data-keterangan_transaksi='".$r['keterangan_transaksi']."'> edit</button>";
                }
                else{
                  $nestedData['action'] ="";
                }

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

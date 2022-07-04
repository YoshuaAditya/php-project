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
                        0  => 'id_transaksi',
                        1  => 'nama_perusahaan',
                        2  => 'nama_jenis',
                        3  => 'nama_transaksi',
                        4  => 'nama_proyek',
                        5  => 'qty',
                        6  => 'satuan',
                        7  => 'pemasukan',
                        8  => 'pengeluaran',
                        9 =>  'saldo_before_transaction',
                        10 =>  'saldo_akhir',
                        11 => 'tanggal_transaksi',
                        12 => 'keterangan_transaksi'
                    );

      $querycount = $mysqli->query("SELECT count(id_transaksi) as jumlah FROM transaksi ".$condition);
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];

        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        if(empty($_POST['search']['value']))
        {

         $query = $mysqli->query("SELECT id_transaksi, nama_perusahaan, nama_jenis, nama_transaksi, nama_proyek, qty, satuan, pemasukan, pengeluaran, saldo_before_transaction, tanggal_transaksi, keterangan_transaksi from transaksi
                                    inner join perusahaan on perusahaan.id_perusahaan = transaksi.fk_id_perusahaan
                                    inner join jenis_transaksi on jenis_transaksi.id_jenis = transaksi.fk_id_jenis_transaksi ".$condition." order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value'];
            $query = $mysqli->query("SELECT id_transaksi, nama_perusahaan, nama_jenis, nama_transaksi, nama_proyek, qty, satuan, pemasukan, pengeluaran,
            saldo_before_transaction, tanggal_transaksi, keterangan_transaksi from transaksi
            inner join perusahaan on perusahaan.id_perusahaan = transaksi.fk_id_perusahaan
            inner join jenis_transaksi on jenis_transaksi.id_jenis = transaksi.fk_id_jenis_transaksi WHERE ".$conditionAddition." nama_jenis LIKE '%$search%'
                                                         or nama_transaksi LIKE '%$search%' or nama_proyek LIKE '%$search%'
                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");


           $querycount = $mysqli->query("SELECT count(id_transaksi) as jumlah FROM transaksi WHERE ".$conditionAddition." nama_proyek LIKE '%$search%'
                                                                        or nama_transaksi LIKE '%$search%'");
         $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }

        $data = array();
        if(!empty($query))
        {

            while ($r = $query->fetch_array())
            {
                $newDate =  date("d-M-Y", strtotime($r['tanggal_transaksi']));
                $nestedData['id_transaksi'] =  $r['id_transaksi'];
                $nestedData['nama_perusahaan'] = $r['nama_perusahaan'];
                $nestedData['nama_jenis'] = $r['nama_jenis'];
                $nestedData['nama_transaksi'] = $r['nama_transaksi'];
                $nestedData['nama_proyek'] = $r['nama_proyek'];
                $nestedData['qty'] = $r['qty']." ".$r['satuan'];
                $nestedData['pengeluaran'] = rupiah($r['pengeluaran']);
                $nestedData['pemasukan'] = rupiah($r['pemasukan']);
                $nestedData['saldo_before_transakction'] = rupiah($r['saldo_before_transaction']);
                $nestedData['saldo_akhir'] = $r['pengeluaran']==null? rupiah($r['saldo_before_transaction']+$r['pemasukan']) : rupiah($r['saldo_before_transaction']-$r['pengeluaran']);
                $nestedData['tanggal_transaksi'] = $newDate ;
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

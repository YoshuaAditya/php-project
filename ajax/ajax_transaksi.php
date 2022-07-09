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
                        4  => 'nama_projek',
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

        $where = "";$where1="";$where2="";$where3="";$where4="";$where6="";$where7="";$where8="";$where10="";$where11="";
        if(!empty($_POST['columns']['1']['search']['value'])){
          $where1 = " AND nama_perusahaan LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['2']['search']['value'])){
          $where2 = " AND nama_jenis LIKE '%".$_POST['columns'][2]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['3']['search']['value'])){
          $where3 = " AND nama_transaksi LIKE '%".$_POST['columns'][3]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['4']['search']['value']) && $_SESSION['akses']== 1 || $_SESSION['akses']== 5){
          $where4 = " AND nama_projek LIKE '%".$_POST['columns'][4]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['6']['search']['value'])){
          $where6 = " AND pengeluaran LIKE '%".$_POST['columns'][6]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['7']['search']['value'])){
          $where7 = " AND pemasukan LIKE '%".$_POST['columns'][7]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['8']['search']['value'])){
          $where8 = " AND saldo_before_transaction LIKE '%".$_POST['columns'][8]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['10']['search']['value'])){
          $where10 = " AND tanggal_transaksi LIKE '%".$_POST['columns'][10]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['11']['search']['value'])){
          $where11 = " AND keterangan_transaksi LIKE '%".$_POST['columns'][11]['search']['value']."%' ";
        }

        if($where1||$where2||$where3||$where4||$where6||$where7||$where8||$where10||$where11){
          $where = " where 1=1 ";
        }
        if($_SESSION['akses']== 1 || $_SESSION['akses']== 5 ){
          $query = $mysqli->query("SELECT id_transaksi,fk_id_perusahaan, nama_perusahaan,fk_id_jenis_transaksi, nama_jenis, nama_transaksi, nama_proyek, projek.nama_projek as nama_projek, qty, satuan, pemasukan, pengeluaran,
          saldo_before_transaction, tanggal_transaksi, keterangan_transaksi from transaksi
          inner join perusahaan on perusahaan.id_perusahaan = transaksi.fk_id_perusahaan
          inner join projek on projek.id_projek = transaksi.nama_proyek
          inner join jenis_transaksi on jenis_transaksi.id_jenis = transaksi.fk_id_jenis_transaksi ".$conditionAddition.$where.$where1.$where2.$where3.$where4.$where6.$where7.$where8.$where10.$where11."
            order by $order $dir
            LIMIT $limit
            OFFSET $start");
        }else{
          $query = $mysqli->query("SELECT id_transaksi,fk_id_perusahaan, nama_perusahaan,fk_id_jenis_transaksi, nama_jenis, nama_transaksi, nama_proyek, nama_proyek as nama_projek, qty, satuan, pemasukan, pengeluaran,
          saldo_before_transaction, tanggal_transaksi, keterangan_transaksi from transaksi
          inner join perusahaan on perusahaan.id_perusahaan = transaksi.fk_id_perusahaan
          inner join jenis_transaksi on jenis_transaksi.id_jenis = transaksi.fk_id_jenis_transaksi ".$conditionAddition.$where.$where1.$where2.$where3.$where4.$where6.$where7.$where8.$where10.$where11."
            order by $order $dir
            LIMIT $limit
            OFFSET $start");
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
                $nestedData['nama_projek'] = $r['nama_projek'] == ""? "":$r['nama_projek'];
                $nestedData['qty'] = $r['qty']." ".$r['satuan'];
                $nestedData['pengeluaran'] = rupiah($r['pengeluaran']);
                $nestedData['pemasukan'] = rupiah($r['pemasukan']);
                $nestedData['saldo_before_transakction'] = rupiah($r['saldo_before_transaction']);
                $nestedData['saldo_akhir'] = $r['pengeluaran']==null? rupiah($r['saldo_before_transaction']+$r['pemasukan']) : rupiah($r['saldo_before_transaction']-$r['pengeluaran']);
                $nestedData['tanggal_transaksi'] = $newDate ;
                $nestedData['keterangan_transaksi'] = $r['keterangan_transaksi'];
                $nestedData['action'] = "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
               > edit</button>";


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

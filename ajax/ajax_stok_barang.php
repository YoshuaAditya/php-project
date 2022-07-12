<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "stokBarang"){


      $columns = array(
                               0 =>'id_stock_barang',
                               1 =>'fk_id_lokasi',
                               2 =>'fk_id_perusahaan',
                               3=> 'nama_barang',
                               4=> 'stock',
                               5=> 'status_barang'
                           );

      $querycount = $mysqli->query("SELECT count(id_stock_barang) as jumlah FROM stock_barang");
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];
        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        $where = "";$where1="";$where2="";$where3="";$where4="";
        if(!empty($_POST['columns']['1']['search']['value'])){
          $where1 = " AND nama_lokasi LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['2']['search']['value'])){
          $where2 = " AND nama_perusahaan LIKE '%".$_POST['columns'][2]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['3']['search']['value'])){
          $where3 = " AND nama_barang LIKE '%".$_POST['columns'][3]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['4']['search']['value'])){
          $where4 = " AND stock LIKE '%".$_POST['columns'][4]['search']['value']."%' ";
        }

        if($where1||$where2||$where3||$where4){
          $where = " where 1=1 ";
        }
        $query = $mysqli->query("SELECT id_stock_barang, fk_id_lokasi, fk_id_perusahaan, nama_barang, stock, status_barang, nama_lokasi, nama_perusahaan FROM stock_barang
        inner join lokasi on lokasi.id_lokasi = stock_barang.fk_id_lokasi
        inner join perusahaan on perusahaan.id_perusahaan = stock_barang.fk_id_perusahaan ".$where.$where1.$where2.$where3.$where4."
          order by $order $dir
          LIMIT $limit
          OFFSET $start");

        $querycount = $mysqli->query("SELECT count(*) as jumlah from stock_barang
        inner join lokasi on lokasi.id_lokasi = stock_barang.fk_id_lokasi
        inner join perusahaan on perusahaan.id_perusahaan = stock_barang.fk_id_perusahaan ".$where.$where1.$where2.$where3.$where4);
        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];


        $data = array();
        if(!empty($query))
        {


            while ($r = $query->fetch_array())
            {
                $nestedData['id_stock_barang'] =  $r['id_stock_barang'];
                $nestedData['nama_lokasi'] = $r['nama_lokasi'];
                $nestedData['nama_perusahaan'] = $r['nama_perusahaan'];
                $nestedData['nama_barang'] = $r['nama_barang'];
                $nestedData['stock'] = $r['stock'];
                $nestedData['status_barang'] = ($r['status_barang'] == "1")? "Aktif":"Tidak Aktif";
                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id='".$r['id_stock_barang']."'
                data-fk_id_lokasi='".$r['fk_id_lokasi']."'
                data-fk_id_perusahaan='".$r['fk_id_perusahaan']."'
                data-nama_barang='".$r['nama_barang']."'
                data-stock='".$r['stock']."'
                data-status='".$r['status_barang']."'> edit</button>";
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

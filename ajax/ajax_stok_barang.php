<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "stokBarang"){


      $columns = array(
                               0 =>'id_stock_barang',
                               1 =>'fk_id_lokasi',
                               2=> 'nama_barang',
                               3=> 'stock',
                               4=> 'status_barang'
                           );

      $querycount = $mysqli->query("SELECT count(id_stock_barang) as jumlah FROM stock_barang");
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];

        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        if(empty($_POST['search']['value']))
        {

        $query = $mysqli->query("SELECT id_stock_barang, fk_id_lokasi, nama_barang, stock, status_barang, nama_lokasi FROM stock_barang
         inner join lokasi on lokasi.id_lokasi = stock_barang.fk_id_lokasi order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value'];
            $query = $mysqli->query("SELECT id_stock_barang, fk_id_lokasi, nama_barang, stock, status_barang, nama_lokasi FROM stock_barang
            inner join lokasi on lokasi.id_lokasi = stock_barang.fk_id_lokasi WHERE nama_barang LIKE '%$search%'
            or nama_lokasi LIKE '%$search%'
            order by $order $dir
            LIMIT $limit
            OFFSET $start");


           $querycount = $mysqli->query("SELECT count(id_stock_barang) as jumlah FROM stock_barang WHERE nama_barang LIKE '%$search%'");
         $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }

        $data = array();
        if(!empty($query))
        {


            while ($r = $query->fetch_array())
            {
                $nestedData['id_stock_barang'] =  $r['id_stock_barang'];
                $nestedData['nama_lokasi'] = $r['nama_lokasi'];
                $nestedData['nama_barang'] = $r['nama_barang'];
                $nestedData['stock'] = $r['stock'];
                $nestedData['status_barang'] = ($r['status_barang'] == "1")? "Aktif":"Tidak Aktif";
                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id='".$r['id_stock_barang']."'
                data-fk_id_lokasi='".$r['fk_id_lokasi']."'
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

<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "jenis"){


      $columns = array(
                               0 =>'id_jenis',
                               1 =>'nama_jenis',
                               2=> 'status_jenis',
                           );

      $querycount = $mysqli->query("SELECT count(id_jenis) as jumlah FROM jenis_transaksi");
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];
        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        $where ="";$where1="";
        if(!empty($_POST['columns']['1']['search']['value'])){
          $where1 = " AND nama_jenis  LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }

        if($where1){
          $where = " where 1=1 ";
        }
        $query = $mysqli->query("SELECT id_jenis, nama_jenis, status_jenis FROM jenis_transaksi ".$where.$where1."
          order by $order $dir
          LIMIT $limit
          OFFSET $start");

        $data = array();
        if(!empty($query))
        {
            while ($r = $query->fetch_array())
            {
                $nestedData['id_jenis'] =  $r['id_jenis'];
                $nestedData['nama_jenis'] = $r['nama_jenis'];
                $nestedData['status_jenis'] = ($r['status_jenis'] == "1")? "Aktif":"Tidak Aktif";
                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id='".$r['id_jenis']."'
                data-nama_jenis='".$r['nama_jenis']."'
                data-status_jenis='".$r['status_jenis']."'> edit</button>";
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

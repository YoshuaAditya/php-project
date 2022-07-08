<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "projek"){


      $columns = array(
                               0 =>'id_projek',
                               1 =>'nama_projek',
                               2=> 'status_projek',
                           );

      $querycount = $mysqli->query("SELECT count(id_projek) as jumlah FROM projek");
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];
        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        $where="";
        if(!empty($_POST['columns']['1']['search']['value'])){
          $where = " WHERE nama_projek LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }

        $query = $mysqli->query("SELECT id_projek, nama_projek, status_projek FROM projek ".$where."
          order by $order $dir
          LIMIT $limit
          OFFSET $start");

        $data = array();
        if(!empty($query))
        {
            while ($r = $query->fetch_array())
            {
                $nestedData['id_projek'] =  $r['id_projek'];
                $nestedData['nama_projek'] = $r['nama_projek'];
                $nestedData['status_projek'] = ($r['status_projek'] == "1")? "Aktif":"Tidak Aktif";
                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id='".$r['id_projek']."'
                data-nama_projek='".$r['nama_projek']."'
                data-status='".$r['status_projek']."'> edit</button>";
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

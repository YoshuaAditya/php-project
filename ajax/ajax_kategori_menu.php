<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "kategori"){


      $columns = array(
                               0 =>'id_category',
                               1 =>'nama_category',
                               2=> 'status_category'
                           );

      $querycount = $mysqli->query("SELECT count(id_category) as jumlah FROM kategori_menu");
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];
        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        $where="";
        if(!empty($_POST['columns']['1']['search']['value'])){
          $where = " where nama_category LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }

        $query = $mysqli->query("SELECT id_category,nama_category,status_category FROM kategori_menu ".$where."
          order by $order $dir
          LIMIT $limit
          OFFSET $start");

        $data = array();
        if(!empty($query))
        {

            while ($r = $query->fetch_array())
            {
                $nestedData['id_category'] =  $r['id_category'];
                $nestedData['nama_category'] = $r['nama_category'];
                $nestedData['status_category'] = ($r['status_category'] == 1)? "Aktif":"Tidak Aktif";

                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id_category='".$r['id_category']."'
                data-nama_category='".$r['nama_category']."'
                data-status_category='".$r['status_category']."'> edit</button>";
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

<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "lokasi"){


      $columns = array(
                               0 =>'id_lokasi',
                               1 =>'nama_lokasi',
                               2=> 'status_lokasi',
                           );

      $querycount = $mysqli->query("SELECT count(id_lokasi) as jumlah FROM lokasi");
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];

        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        if(empty($_POST['search']['value']))
        {

        $query = $mysqli->query("SELECT * FROM lokasi order by $order $dir
                                                LIMIT $limit
                                                OFFSET $start");
        }
        else {
            $search = $_POST['search']['value'];
            $query = $mysqli->query("SELECT id_lokasi, nama_lokasi, status_lokasi FROM lokasi
            WHERE nama_lokasi LIKE '%$search%'
            order by $order $dir
            LIMIT $limit
            OFFSET $start");


           $querycount = $mysqli->query("SELECT count(id_lokasi) as jumlah FROM lokasi WHERE nama_lokasi LIKE '%$search%'");
         $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }

        $data = array();
        if(!empty($query))
        {


            while ($r = $query->fetch_array())
            {
                $nestedData['id_lokasi'] =  $r['id_lokasi'];
                $nestedData['nama_lokasi'] = $r['nama_lokasi'];
                $nestedData['status_lokasi'] = ($r['status_lokasi'] == "1")? "Aktif":"Tidak Aktif";
                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id='".$r['id_lokasi']."'
                data-nama_lokasi='".$r['nama_lokasi']."'
                data-status='".$r['status_lokasi']."'> edit</button>
                <button type='submit' id='buttonDelete' onClick='Delete(this)' data-toggle='modal' data-target='#delete' class='btn btn-danger btn-flat btn_edit'
                data-id='".$r['id_lokasi']."'> delete</button>";
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

<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "menu"){


      $columns = array(
                               0 =>'id_menu',
                               1 =>'nama_menu',
                               2=> 'alamat_menu',
                               3=> 'status_menu'
                           );

      $querycount = $mysqli->query("SELECT count(id_menu) as jumlah FROM menu");
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];

        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        if(empty($_POST['search']['value']))
        {
         $query = $mysqli->query("SELECT *  FROM menu order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value'];
            $query = $mysqli->query("SELECT id_menu,nama_menu, alamat_menu,status_menu FROM menu WHERE nama_menu LIKE '%$search%'
                                                         or status_menu LIKE '%$search%'
                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");


           $querycount = $mysqli->query("SELECT count(id_menu) as jumlah FROM menu WHERE nama_menu LIKE '%$search%'or status_menu LIKE '%$search%' ");
         $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }

        $data = array();
        if(!empty($query))
        {

            while ($r = $query->fetch_array())
            {
                $nestedData['id_menu'] =  $r['id_menu'];
                $nestedData['nama_menu'] = $r['nama_menu'];
                $nestedData['alamat_menu'] = $r['alamat_menu'];
                $nestedData['status_menu'] = ($r['status_menu'] == 1)? "Aktif":"Tidak Aktif";

                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id_menu='".$r['id_menu']."'
                data-nama_menu='".$r['nama_menu']."'
                data-alamat_menu='".$r['alamat_menu']."'
                data-status_menu='".$r['status_menu']."'> edit</button>";
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

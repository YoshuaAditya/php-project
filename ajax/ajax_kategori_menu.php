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

        if(empty($_POST['search']['value']))
        {
         $query = $mysqli->query("SELECT *  FROM kategori_menu order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value'];
            $query = $mysqli->query("SELECT id_category,nama_category,status_category FROM kategori_menu WHERE nama_category LIKE '%$search%'

                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");


           $querycount = $mysqli->query("SELECT count(id_category) as jumlah FROM kategori_menu WHERE nama_category LIKE '%$search%' ");
         $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }

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
                data-status_category='".$r['status_category']."'> edit</button>
                <button type='submit' id='buttonDelete' onClick='Delete(this)' data-toggle='modal' data-target='#delete' class='btn btn-danger btn-flat btn_edit'
                data-id='".$r['id_category']."'> delete</button>";
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
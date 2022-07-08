<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "accessMenu"){


      $columns = array(
                               0 =>'id_access_menu',
                               1 =>'fk_id_category',
                               2=> 'fk_id_menu',
                               3=> 'fk_id_al',
                               4=> 'status_access_menu',
                               5=> 'nama_menu',
                               6=> 'nama_category',
                               7=> 'nama_al'
                           );

      $querycount = $mysqli->query("SELECT count(id_access_menu) as jumlah FROM access_menu");
      $datacount = $querycount->fetch_array();
      $totalData = $datacount['jumlah'];

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];


        $where1="";$where2="";$where3="";
        if(!empty($_POST['columns']['1']['search']['value'])){
          $where1 = " AND nama_menu LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['2']['search']['value'])){
          $where2 = " AND nama_category LIKE '%".$_POST['columns'][2]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['3']['search']['value'])){
          $where3 = " AND nama_al LIKE '%".$_POST['columns'][3]['search']['value']."%' ";
        }

        if(!$where1||!$where2||$where3){
          $where = "";
        }
        else{
          $where = " where 1=1 ";
        }
        $query = $mysqli->query("SELECT id_access_menu, fk_id_category,fk_id_menu,fk_id_al, status_access_menu,nama_menu,nama_category,nama_al FROM access_menu
         inner join access_level on access_level.id_al = access_menu.fk_id_al
         inner join kategori_menu on kategori_menu.id_category = access_menu.fk_id_category
         inner join menu on menu.id_menu = access_menu.fk_id_menu ".$where." ".$where1." ".$where2." ".$where3."
          order by $order $dir
          LIMIT $limit
          OFFSET $start");

        $data = array();
        if(!empty($query))
        {
            while ($r = $query->fetch_array())
            {
                $nestedData['id_access_menu'] =  $r['id_access_menu'];
                $nestedData['fk_id_category'] = $r['fk_id_category'];
                $nestedData['fk_id_menu'] = $r['fk_id_menu'];
                $nestedData['fk_id_al'] = $r['fk_id_al'];
                $nestedData['nama_menu'] = $r['nama_menu'];
                $nestedData['nama_category'] = $r['nama_category'];
                $nestedData['nama_al'] = $r['nama_al'];
                $nestedData['status_access_menu'] = ($r['status_access_menu'] == "1")? "Aktif":"Tidak Aktif";
                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id='".$r['id_access_menu']."'
                data-fk_id_category='".$r['fk_id_category']."'
                data-fk_id_menu='".$r['fk_id_menu']."'
                data-fk_id_al='".$r['fk_id_al']."'
                data-status='".$r['status_access_menu']."'> edit</button>";
                $data[] = $nestedData;

            }
        }

        $json_data = array(
                    "draw"            => intval($_POST['draw']),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalData),
                    "data"            => $data
                    );

        echo json_encode($json_data);

}
?>

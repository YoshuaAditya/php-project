<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "user"){


      $columns = array(
                               0 =>'id_user',
                               1 =>'username',
                               2=> 'fk_id_al',
                               3=> 'status_user',
                               4=> 'id_al',
                               5=> 'nama_al'
                           );

      $querycount = $mysqli->query("SELECT count(id_user) as jumlah FROM user");
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];
        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];


        $where = "";$where1="";$where2="";
        if(!empty($_POST['columns']['1']['search']['value'])){
          $where1 = " AND username LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['2']['search']['value'])){
          $where2 = " AND nama_al LIKE '%".$_POST['columns'][2]['search']['value']."%' ";
        }

        if($where1||$where2){
          $where = " where 1=1 ";
        }
        $query = $mysqli->query("SELECT id_user,username, fk_id_al, status_user, id_al, nama_al FROM user
          inner join access_level on access_level.id_al = user.fk_id_al ".$where.$where1.$where2."
          order by $order $dir
          LIMIT $limit
          OFFSET $start");

        $data = array();
        if(!empty($query))
        {

            while ($r = $query->fetch_array())
            {
                $nestedData['id_user'] =  $r['id_user'];
                $nestedData['username'] = $r['username'];
                $nestedData['fk_id_al'] = $r['fk_id_al'];
                $nestedData['status_user'] = ($r['status_user'] == "1")? "Aktif":"Tidak Aktif";
                $nestedData['id_al'] = $r['id_al'];
                $nestedData['nama_al'] = $r['nama_al'];
                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id='".$r['id_user']."'
                data-username='".$r['username']."'
                data-fk_id_al='".$r['fk_id_al']."'
                data-status='".$r['status_user']."'> edit</button>";
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

<?php
require_once '../processing/connection/koneksi.php';

if($_GET['action'] == "accessLevel"){


      $columns = array(
                               0 =>'id_al',
                               1 =>'nama_al',
                               2=> 'fk_id_perusahaan',
                               3=> 'status_al',
                           );

      $querycount = $mysqli->query("SELECT count(id_al) as jumlah FROM access_level");
      $datacount = $querycount->fetch_array();

        $totalData = $datacount['jumlah'];
        $totalFiltered = $totalData;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];

        $where ="";$where1="";$where2="";$where3="";
        if(!empty($_POST['columns']['1']['search']['value'])){
          $where1 = " AND nama_al LIKE '%".$_POST['columns'][1]['search']['value']."%' ";
        }
        if(!empty($_POST['columns']['2']['search']['value'])){
          $where2 = " AND nama_perusahaan LIKE '%".$_POST['columns'][2]['search']['value']."%' ";
        }

        if($where1||$where2||$where3){
          $where = " where 1=1 ";
        }
        $query = $mysqli->query("SELECT id_al, nama_al,fk_id_perusahaan, status_al, nama_perusahaan FROM access_level
         inner join perusahaan on perusahaan.id_perusahaan = access_level.fk_id_perusahaan ".$where.$where1.$where2."
          order by $order $dir
          LIMIT $limit
          OFFSET $start");

        $data = array();
        if(!empty($query))
        {


            while ($r = $query->fetch_array())
            {
                $nestedData['id_al'] =  $r['id_al'];
                $nestedData['nama_al'] = $r['nama_al'];
                $nestedData['nama_perusahaan'] = $r['nama_perusahaan'];
                $nestedData['status_al'] = ($r['status_al'] == "1")? "Aktif":"Tidak Aktif";
                $nestedData['aksi'] =
                "<button type='submit' id='buttonEdit' onClick='Edit(this)' data-toggle='modal' data-target='#edit' class='btn btn-primary btn-flat btn_edit'
                data-id='".$r['id_al']."'
                data-nama_al='".$r['nama_al']."'
                data-fk_id_perusahaan='".$r['fk_id_perusahaan']."'
                data-status='".$r['status_al']."'> edit</button>";
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

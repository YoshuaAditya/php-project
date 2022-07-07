<!DOCTYPE html>
<?php
SESSION_START();
include("connection/koneksi.php");
include("fungsi.php");
//checkSession();
$perusahaan = $_GET['prs'];
if(!isset($_GET['bulanAwal'])){
    $awal = $_POST['bulanAwal'];
}

if(!isset($_GET['bulanAkhir'])){
    $akhir = $_POST['bulanAkhir'];
}

$lokasi='';
if(!empty($_POST['fk_id_lokasi'])){
    $fk_id_lokasi = $_POST['fk_id_lokasi'];
    $lokasi = 'AND transaksi_bbm.fk_id_lokasi = '.$fk_id_lokasi;
}

?>
<html>
<head>
	<title>Data Invoice Bulanan</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;

	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Barang.xls");
	?>

<center>
    <h1><?php echo getPerusahaan($perusahaan,$connect); ?></h1>
    <h2>Laporan Pengeluaran Barang</h2>
    <?php
    if($awal != NULL && $akhir != NULL){
        echo "Tanggal: ".date("d - F - Y", strtotime($awal))." s/d ". date("d - F - Y", strtotime($akhir))." <br>";
    }
    ?>
</center>



	<table border=1>
		<tr>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Lokasi</th>
            <th>Pengeluaran Stock</th>
            <th>Pemasukan Stock</th>
            <th>Stock Sebelumnya</th>
            <th>Stock Akhir</th>
            <th>Keterangan</th>
		</tr>
      <?php
        $query = "select tanggal_transaksi, nama_barang, nama_lokasi, pengeluaran_stock, pemasukan_stock, stock_sebelumnya, keterangan_transaksi from transaksi_bbm ";
        $query .= "inner join stock_barang on stock_barang.id_stock_barang = transaksi_bbm.fk_id_stock_barang ";
        $query .= "inner join lokasi on lokasi.id_lokasi = transaksi_bbm.fk_id_lokasi ";
        $query .= "WHERE fk_id_perusahaan=".$perusahaan." ".$lokasi." AND tanggal_transaksi BETWEEN '".$awal."' AND '".$akhir."' ORDER BY tanggal_transaksi ASC";
        $previousDate="";
        $run = mysqli_query($connect, $query);
        while($o = mysqli_fetch_assoc($run)){
            echo "<tr>";
            if($previousDate!=strtotime($o['tanggal_transaksi'])){
              $previousDate=strtotime($o['tanggal_transaksi']);
              echo "<td>".date("d- F - Y", $previousDate)."</td>";
            }
            else{
              echo "<td></td>";
            }
            echo "<td>".$o['nama_barang']."</td>";
            echo "<td>".$o['nama_lokasi']."</td>";
            if($o['pengeluaran_stock'] == NULL){
                echo "<td>0</td>";
                echo "<td>".$o['pemasukan_stock']."</td>";
                $stock = $o['stock_sebelumnya'] + $o['pemasukan_stock'];
            }else{
                echo "<td>".$o['pengeluaran_stock']."</td>";
                echo "<td>0</td>";
                $stock = $o['stock_sebelumnya'] - $o['pengeluaran_stock'];
            }
            echo "<td>".$o['stock_sebelumnya']."</td>";
            echo "<td>".$stock."</td>";
            echo "<td>".$o['keterangan_transaksi']."</td>";
            echo "</tr>";
        }
      ?>


</table>
</body>
</html>

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
	header("Content-Disposition: attachment; filename=Data Invoice.xls");
	?>

<center>
    <h1><?php echo getPerusahaan($perusahaan,$connect); ?></h1>
    <h2>Laporan Pengeluaran Toko</h2>
    <?php
    if($awal != NULL && $akhir != NULL){
        echo "Tanggal: ".date("d - F - Y", strtotime($awal))." s/d ". date("d - F - Y", strtotime($akhir))." <br>";
    }
    ?>
</center>



	<table border=1>
		<tr>
            <th>Tanggal </th>
            <th>Qty</th>
            <th>Nama Pengeluaran/Pemasukan</th>
            <th>Projek</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Pengeluaran</th>
            <th>Pemasukan</th>
            <th>Saldo</th>
            <th>Keterangan</th>
		</tr>
      <?php
        $query = "select tanggal_transaksi, qty, satuan, nama_transaksi, pemasukan, pengeluaran, saldo_before_transaction, keterangan_transaksi, nama_projek from transaksi ";
        $query .= "inner join projek on projek.id_projek = transaksi.fk_id_projek ";
        $query .= "WHERE fk_id_perusahaan='".$perusahaan."' AND tanggal_transaksi BETWEEN '".$awal."' AND '".$akhir."' ORDER BY tanggal_transaksi ASC";
        $previousDate="";
        $run = mysqli_query($connect, $query);
        while($o = mysqli_fetch_assoc($run)){
            $harga = $o['pengeluaran'] / $o['qty'];
            echo "<tr>";
            if($previousDate!=strtotime($o['tanggal_transaksi'])){
              $previousDate=strtotime($o['tanggal_transaksi']);
              echo "<td>".date("d- F - Y", $previousDate)."</td>";
            }
            else{
              echo "<td></td>";
            }
            echo "<td>".$o['qty']."</td>";
            echo "<td>".$o['nama_transaksi']."</td>";
            echo "<td>".$o['nama_projek']."</td>";
            echo "<td>".$o['satuan']."</td>";
            echo "<td>".rupiah($harga)."</td>";
            if($o['pengeluaran'] == NULL){
                echo "<td>-</td>";
                echo "<td>".rupiah($o['pemasukan'])."</td>";
                $saldo = $o['saldo_before_transaction'] + $o['pemasukan'];
            }else{
                echo "<td>".rupiah($o['pengeluaran'])."</td>";
                echo "<td>-</td>";
                $saldo = $o['saldo_before_transaction'] - $o['pengeluaran'];
            }
            echo "<td>".rupiah($saldo)."</td>";
            echo "<td>".$o['keterangan_transaksi']."</td>";
            echo "</tr>";
        }
      ?>


</table>
</body>
</html>

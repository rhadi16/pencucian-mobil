<?php 
	session_start();

	$id_admin = $_SESSION['user'];
	if(!isset($_SESSION['user'])){
	    // fungsi redirect menggunakan javascript
	    echo '<script language="javascript"> window.location.href = "../index.php" </script>';
	}

	// echo '<link rel="shortcut icon" href="assets/gambar/logo_lutra.png" type="image/x-icon">';
	require_once 'assets/lib/mpdf/vendor/autoload.php';

	$mpdf = new \Mpdf\Mpdf();

	$html = '
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Laporan Seluruh Pencucian Mobil</title>
			<style type="text/css">
				body, main, h1, table, td, th {
					margin: 0;
					padding: 0;
					border-collapse: collapse;
					font-family: calibri, sans-serif;
				}
				main {
					width: 100%;
					position: relative;
				}
				h1 {
					text-align: center;
					border-bottom: 2px solid black;
					padding-bottom: 10px;
					margin-bottom: 20px;
					line-height: 1.5rem;
					font-size: 1.2rem;
				}
				table {
		  		width: 100%;
				}
				td, th {
					border: 1px solid #212121;
				  text-align: left;
				  padding: 8px;
		  		text-align: center;
				}
				tr:nth-child(even) {
				  background-color: #dddddd;
				}
			</style>
		</head>';

	include 'config/connect.php';
    include 'config/auth.php';
    include 'assets/datetime/datetimeFormat.php';
    
	$dt = mysqli_query($mysqli, "SELECT * FROM transaksi");

	$html .= '
		  <body>
				<main>
					<h1>LAPORAN SEMUA PENCUCIAN MOBIL</h1>

					<table>
						<tr>
							<th>No.</th>
							<th>ID Transaksi</th>
							<th>Tanggal</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Nomor Hp</th>
							<th>Jenis Kendaraan</th>
							<th>Operator</th>
							<th>Paket</th>
						</tr>';
					$no = 1; 
      		while($d  = mysqli_fetch_array($dt)){
      		$html .= '
      			<tr>
      				<td>'. $no .'</td>
      				<td>'. $d['id_transaksi'] .'</td>
      				<td>'. datetimeFormat::TanggalIndo($d['tanggal']) .'</td>
      				<td>'. $d['nama'] .'</td>
      				<td>'. $d['alamat'] .'</td>
      				<td>'. $d['no_hp'] .'</td>
      				<td>'. $d['tipe_kendaraan'].' - Rp. '.$d['no_plat'] .'</td>
      				<td>'. $d['operator'] .'</td>
      				<td>'. $d['paket'].' - Rp. '.number_format($d['harga'],0,",",".") .'</td>
      			</tr>
      		';
      		$total_penghasilan += $d['harga'];
      		$no++;
      	}
$html .='
				    <tr>
							<th colspan="8">Total Penghasilan</th>
							<th>Rp. '. number_format($total_penghasilan,0,",",".") .'</th>
						</tr>
					</table>
				</main>
			</body>
			</html>';
	$mpdf->WriteHTML($html);
	$mpdf->Output('Daftar Pembelian.pdf', \Mpdf\Output\Destination::INLINE);

?>
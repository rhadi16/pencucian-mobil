<?php 
	include('template/header.php'); 
	include('assets/datetime/datetimeFormat.php');
?>

  <div class="container dashboard">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card text-center">
          <h5 class="card-header">Selamat Datang Di Green Wash</h5>
          <div class="card-body">
            <div class="row justify-content-center">
            	<div class="col-md-6">
            		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hari-ini" style="background-color: #e53935; border-color: #e53935;">Total Kendaraan yang <br>Dicuci Hari Ini</button>
            	</div>
            	<div class="col-md-6">
            		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bulan-ini" style="background-color: #ff9800; border-color: #ff9800;">Total Kendaraan yang <br>Dicuci Bulan Ini</button>
            	</div>
            	<div class="col-md-6">
            		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#minggu-ini" style="background-color: #388e3c; border-color: #388e3c;">Total Kendaraan yang <br>Dicuci Minggu Ini</button>
            	</div>
            	<div class="col-md-6">
            		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tahun-ini" style="background-color: #757575; border-color: #757575;">Total Kendaraan yang <br>Dicuci tahun Ini</button>
            	</div>
            	<div class="col-md-6">
            		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendapatan" style="background-color: #9c27b0; border-color: #9c27b0;">Total Pendapatan <br>yang Dicuci</button>
            	</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Hari Ini -->
	<div class="modal fade" id="hari-ini" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Kendaraan yang Dicuci Hari Ini</h5>
	      </div>
	      <div class="modal-body">
	        <table class="table">
					<thead>
				    <tr>
				      <th scope="col">No.</th>
				      <th scope="col">ID Transaksi</th>
				      <th scope="col">Tanggal</th>
				      <th scope="col">Nama</th>
				      <th scope="col">Alamat</th>
				      <th scope="col">Nomor HP</th>
				      <th scope="col">Paket</th>
				      <th scope="col">Jenis Kendaraan</th>
				      <th scope="col">Operator</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php 
						$qry = "SELECT
											*
										FROM transaksi
										WHERE tanggal = CURDATE()";
					  $dt = mysqli_query($mysqli, $qry);

						$no = 1;
						while($data = mysqli_fetch_array($dt)) {
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data['id_transaksi']; ?></td>
						<td><?php echo datetimeFormat::TanggalIndo($data['tanggal']); ?></td>
						<td><?php echo $data['nama']; ?></td>
						<td><?php echo $data['alamat']; ?></td>
						<td><?php echo $data['no_hp']; ?></td>
						<td><?php echo $data['paket'].' - Rp. '.number_format($data['harga'],0,",","."); ?></td>
						<td><?php echo $data['tipe_kendaraan'].' - '.$data['no_plat']; ?></td>
						<td><?php echo $data['operator']; ?></td>
					</tr>
				<?php $no++; } ?>
					</tbody>
				</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Minggu Ini -->
	<div class="modal fade" id="minggu-ini" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Kendaraan yang Dicuci Minggu Ini</h5>
	      </div>
	      <div class="modal-body">
	        <table class="table">
					<thead>
				    <tr>
				      <th scope="col">No.</th>
				      <th scope="col">ID Transaksi</th>
				      <th scope="col">Tanggal</th>
				      <th scope="col">Nama</th>
				      <th scope="col">Alamat</th>
				      <th scope="col">Nomor HP</th>
				      <th scope="col">Paket</th>
				      <th scope="col">Jenis Kendaraan</th>
				      <th scope="col">Operator</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php 
						$qry1 = "SELECT
											*
										FROM transaksi
										WHERE WEEKOFYEAR(tanggal) = WEEKOFYEAR(NOW())";
					  $dt1 = mysqli_query($mysqli, $qry1);

						$no = 1;
						while($data1 = mysqli_fetch_array($dt1)) {
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data1['id_transaksi']; ?></td>
						<td><?php echo datetimeFormat::TanggalIndo($data1['tanggal']); ?></td>
						<td><?php echo $data1['nama']; ?></td>
						<td><?php echo $data1['alamat']; ?></td>
						<td><?php echo $data1['no_hp']; ?></td>
						<td><?php echo $data1['paket'].' - Rp. '.number_format($data1['harga'],0,",","."); ?></td>
						<td><?php echo $data1['tipe_kendaraan'].' - '.$data1['no_plat']; ?></td>
						<td><?php echo $data1['operator']; ?></td>
					</tr>
				<?php $no++; } ?>
					</tbody>
				</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Bulan Ini -->
	<div class="modal fade" id="bulan-ini" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Kendaraan yang Dicuci Bulan Ini</h5>
	      </div>
	      <div class="modal-body">
	        <table class="table">
					<thead>
				    <tr>
				      <th scope="col">No.</th>
				      <th scope="col">ID Transaksi</th>
				      <th scope="col">Tanggal</th>
				      <th scope="col">Nama</th>
				      <th scope="col">Alamat</th>
				      <th scope="col">Nomor HP</th>
				      <th scope="col">Paket</th>
				      <th scope="col">Jenis Kendaraan</th>
				      <th scope="col">Operator</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php 
						$qry1 = "SELECT
											*
										FROM transaksi
										WHERE YEAR(tanggal) = YEAR(NOW()) AND MONTH(tanggal) = MONTH(NOW())";
					  $dt1 = mysqli_query($mysqli, $qry1);

						$no = 1;
						while($data1 = mysqli_fetch_array($dt1)) {
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data1['id_transaksi']; ?></td>
						<td><?php echo datetimeFormat::TanggalIndo($data1['tanggal']); ?></td>
						<td><?php echo $data1['nama']; ?></td>
						<td><?php echo $data1['alamat']; ?></td>
						<td><?php echo $data1['no_hp']; ?></td>
						<td><?php echo $data1['paket'].' - Rp. '.number_format($data1['harga'],0,",","."); ?></td>
						<td><?php echo $data1['tipe_kendaraan'].' - '.$data1['no_plat']; ?></td>
						<td><?php echo $data1['operator']; ?></td>
					</tr>
				<?php $no++; } ?>
					</tbody>
				</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Tahun Ini -->
	<div class="modal fade" id="tahun-ini" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Kendaraan yang Dicuci Tahun Ini</h5>
	      </div>
	      <div class="modal-body">
	        <table class="table">
					<thead>
				    <tr>
				      <th scope="col">No.</th>
				      <th scope="col">ID Transaksi</th>
				      <th scope="col">Tanggal</th>
				      <th scope="col">Nama</th>
				      <th scope="col">Alamat</th>
				      <th scope="col">Nomor HP</th>
				      <th scope="col">Paket</th>
				      <th scope="col">Jenis Kendaraan</th>
				      <th scope="col">Operator</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php 
						$qry1 = "SELECT
											*
										FROM transaksi
										WHERE YEAR(tanggal) = YEAR(NOW())";
					  $dt1 = mysqli_query($mysqli, $qry1);

						$no = 1;
						while($data1 = mysqli_fetch_array($dt1)) {
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data1['id_transaksi']; ?></td>
						<td><?php echo datetimeFormat::TanggalIndo($data1['tanggal']); ?></td>
						<td><?php echo $data1['nama']; ?></td>
						<td><?php echo $data1['alamat']; ?></td>
						<td><?php echo $data1['no_hp']; ?></td>
						<td><?php echo $data1['paket'].' - Rp. '.number_format($data1['harga'],0,",","."); ?></td>
						<td><?php echo $data1['tipe_kendaraan'].' - '.$data1['no_plat']; ?></td>
						<td><?php echo $data1['operator']; ?></td>
					</tr>
				<?php $no++; } ?>
					</tbody>
				</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Pendapatan -->
	<div class="modal fade" id="pendapatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Total Pendapatan</h5>
	      </div>
	      <div class="modal-body">
	        <table class="table">
					<thead>
				    <tr>
				      <th scope="col">Hari Ini</th>
				      <th scope="col">Minggu Ini</th>
				      <th scope="col">Bulan Ini</th>
				      <th scope="col">Tahun Ini</th>
				      <th scope="col">Total Seluruhnya</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php 
						$qry1 = "SELECT
											COUNT(id_transaksi) AS jum_ken,
											SUM(harga) AS tot_harga
										FROM transaksi
										WHERE tanggal = CURDATE()";
					  $dt1 = mysqli_query($mysqli, $qry1);
					  $du = mysqli_fetch_array($dt1);
					?>
					<?php 
						$qry2 = "SELECT
											COUNT(id_transaksi) AS jum_ken,
											SUM(harga) AS tot_harga
										FROM transaksi
										WHERE WEEKOFYEAR(tanggal) = WEEKOFYEAR(NOW())";
					  $dt2 = mysqli_query($mysqli, $qry2);
					  $du1 = mysqli_fetch_array($dt2);
					?>
					<?php 
						$qry3 = "SELECT
											COUNT(id_transaksi) AS jum_ken,
											SUM(harga) AS tot_harga
										FROM transaksi
										WHERE YEAR(tanggal) = YEAR(NOW()) AND MONTH(tanggal) = MONTH(NOW())";
					  $dt3 = mysqli_query($mysqli, $qry3);
					  $du2 = mysqli_fetch_array($dt3);
					?>
					<?php 
						$qry4 = "SELECT
											COUNT(id_transaksi) AS jum_ken,
											SUM(harga) AS tot_harga
										FROM transaksi
										WHERE YEAR(tanggal) = YEAR(NOW())";
					  $dt4 = mysqli_query($mysqli, $qry4);
					  $du3 = mysqli_fetch_array($dt4);
					?>
					<?php 
						$qry5 = "SELECT
											COUNT(id_transaksi) AS jum_ken,
											SUM(harga) AS tot_harga
										FROM transaksi";
					  $dt5 = mysqli_query($mysqli, $qry5);
					  $du4 = mysqli_fetch_array($dt5);
					?>
					<tr>
						<td><?php echo $du['jum_ken'].' - Rp. '.number_format($du['tot_harga'],0,",","."); ?></td>
						<td><?php echo $du1['jum_ken'].' - Rp. '.number_format($du1['tot_harga'],0,",","."); ?></td>
						<td><?php echo $du2['jum_ken'].' - Rp. '.number_format($du2['tot_harga'],0,",","."); ?></td>
						<td><?php echo $du3['jum_ken'].' - Rp. '.number_format($du3['tot_harga'],0,",","."); ?></td>
						<td><?php echo $du4['jum_ken'].' - Rp. '.number_format($du4['tot_harga'],0,",","."); ?></td>
					</tr>
					</tbody>
				</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

  <?php
  	if (isset($_GET['desc'])) {
    	$desc = $_GET['desc'];
  	} else {
  		$desc = "";
  	}
    if ($desc == "success-in") {
	?>
	  <div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
	<?php } elseif ($desc == "failed-in") { ?>
		<div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
	<?php } elseif ($desc == "success-ed") { ?>
		<div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
	<?php } elseif ($desc == "failed-ed") { ?>
		<div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
	<?php } elseif ($desc == "success-del") { ?>
		<div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
	<?php } elseif ($desc == "failed-del") { ?>
		<div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
	<?php } ?>

<?php include('template/footer.php'); ?>
<?php 
	include('template/header.php'); 
	include('assets/datetime/datetimeFormat.php');
?>

<?php 

	$qry = "SELECT * FROM transaksi";

	$orderby = "";

  $view   = "transaksi.php";

  $column = [
              'value'  => ['id_transaksi', 'nama', 'alamat', 'no_plat'],
              'label'  => ['Nama Operator', 'Nama', 'Alamat', 'Nomor Plat'],
              'type'   => ['text', 'text', 'text', 'text']
            ];

  $log = $_SESSION['nama'];

?>

	<section id="operator">
		<div class="container">
			<h5 class="title text-center">List Transaksi</h5>
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-transaksi">
			  Tambah Transaksi
			</button>

			<!-- Modal -->
			<div class="modal fade" id="tambah-transaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Transaksi</h5>
			      </div>
			      <form action="func/func_transaksi.php?action=insert" enctype="multipart/form-data" method="post">
				      <div class="modal-body">
				        <div class="mb-3">
							    <label for="exampleInputEmail1" class="form-label">ID Transaksi</label>
							    <input required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="id_transaksi">
							  </div>
							  <div class="mb-3">
							    <label for="tanggal" class="form-label">Tanggal</label>
							    <input required type="date" class="form-control" id="tanggal" aria-describedby="emailHelp" name="tanggal">
							  </div>
							  <div class="mb-3">
							    <label for="nama" class="form-label">Nama Pelanggan</label>
							    <input required type="text" class="form-control" id="nama" aria-describedby="emailHelp" name="nama">
							  </div>
							  <div class="mb-3">
							    <label for="alamat" class="form-label">Alamat</label>
							    <input required type="text" class="form-control" id="alamat" aria-describedby="emailHelp" name="alamat">
							  </div>
							  <div class="mb-3">
							    <label for="no_hp" class="form-label">Nomor Hp</label>
							    <input required type="text" class="form-control" id="no_hp" aria-describedby="emailHelp" name="no_hp">
							  </div>
							  <div class="mb-3">
						      <label for="paket" class="form-label">Paket</label>
									<input required class="form-control" list="paket1" id="paket" placeholder="Pilih Paket" name="paket">
									<datalist id="paket1">
									  <?php 
                      $qry1 = "SELECT * FROM paket";

                      $dt1 = mysqli_query($mysqli, $qry1);

                      while($data1 = mysqli_fetch_array($dt1)){
                    ?>
					            <option value="<?php echo $data1['paket'].' - '.$data1['harga']; ?>">
				          	<?php } ?>
									</datalist>
						    </div>
						    <div class="mb-3">
							    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
									<input required class="form-control" list="jenis_kendaraan1" id="jenis_kendaraan" placeholder="Pilih Jenis Kendaraan" name="jenis_kendaraan">
									<datalist id="jenis_kendaraan1">
									  <?php 
                      $qry1 = "SELECT * FROM jenis_kendaraan";

                      $dt1 = mysqli_query($mysqli, $qry1);

                      while($data1 = mysqli_fetch_array($dt1)){
                    ?>
					            <option value="<?php echo $data1['tipe_kendaraan'].' - '.$data1['no_plat']; ?>">
				          	<?php } ?>
									</datalist>
							  </div>
							  <div class="mb-3">
							    <label for="operator1" class="form-label">Operator</label>
							    <input type="text" class="form-control" id="operator1" aria-describedby="emailHelp" name="operator" readonly value="<?php echo $log; ?>">
							  </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-success">Save</button>
				      </div>
			      </form>
			    </div>
			  </div>
			</div>

			<div class="list">
				<div class="container">
	        <div class="card">
	          <?php include('../paginasi/pencarian.php'); ?>
	        </div>
	      </div>
				<table class="table">
					<thead>
				    <tr>
				      <th scope="col">No.</th>
				      <th scope="col">ID Transaksi</th>
				      <th scope="col">Tanggal</th>
				      <th scope="col">Nama</th>
				      <th scope="col">Nomor Hp</th>
				      <th scope="col">Paket</th>
				      <th scope="col">Jenis Kendaraan</th>
				      <th scope="col">Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php 
						include('../paginasi/main-paginasi.php');

						$no = 1;
						while($data = mysqli_fetch_array($dt)) {
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data['id_transaksi']; ?></td>
						<td><?php echo datetimeFormat::TanggalIndo($data['tanggal']); ?></td>
						<td><?php echo $data['nama']; ?></td>
						<td><?php echo $data['no_hp']; ?></td>
						<td><?php echo $data['paket'].' - '.$data['harga']; ?></td>
						<td><?php echo $data['tipe_kendaraan'].' - '.$data['no_plat']; ?></td>
						<td>
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail-transaksi<?php echo $data['id_transaksi']; ?>">
							  Lihat Detail
							</button>
							<button type="button" class="btn btn-danger confirm-delete<?php echo $data['id_transaksi']; ?>">
							  Hapus
							</button>
							<script type="text/javascript">
					      $('.confirm-delete<?php echo $data['id_transaksi']; ?>').on('click', function(e) {
					        Swal.fire({
					          title: 'Anda Yakin?',
					          text: "Ingin Menghapus Data <?php echo $data['id_transaksi']; ?>!",
					          icon: 'warning',
					          showCancelButton: true,
					          confirmButtonColor: '#3085d6',
					          cancelButtonColor: '#d33',
					          confirmButtonText: 'Ya, Yakin!'
					        }).then((result) => {
					          if (result.isConfirmed) {
					            window.location.href = "<?php echo 'func/func_transaksi.php?action=delete&id_transaksi='.$data['id_transaksi']; ?>";
					          }
					        })
					      });
					    </script>
						</td>
					</tr>
					
					<!-- Modal -->
					<div class="modal fade" id="detail-transaksi<?php echo $data['id_transaksi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					        <div class="mb-3">
								    <label for="exampleEditEmail1<?php echo $data['id_transaksi']; ?>" class="form-label">ID Transaksi</label>
								    <input readonly type="text" class="form-control" id="exampleEditEmail1<?php echo $data['id_transaksi']; ?>" aria-describedby="emailHelp" value="<?php echo $data['id_transaksi']; ?>">
								  </div>
								  <div class="mb-3">
								    <label for="tanggal<?php echo $data['id_transaksi']; ?>" class="form-label">Tanggal</label>
								    <input readonly type="text" class="form-control" id="tanggal<?php echo $data['id_transaksi']; ?>" aria-describedby="emailHelp" value="<?php echo datetimeFormat::TanggalIndo($data['tanggal']); ?>">
								  </div>
								  <div class="mb-3">
								    <label for="namaEdit<?php echo $data['id_transaksi']; ?>" class="form-label">Nama</label>
								    <input readonly type="text" class="form-control" id="namaEdit<?php echo $data['id_transaksi']; ?>" aria-describedby="emailHelp" value="<?php echo $data['nama']; ?>">
								  </div>
								  <div class="mb-3">
								    <label for="alamat<?php echo $data['id_transaksi']; ?>" class="form-label">Alamat</label>
								    <input readonly type="text" class="form-control" id="alamat<?php echo $data['id_transaksi']; ?>" aria-describedby="emailHelp" value="<?php echo $data['alamat']; ?>">
								  </div>
								  <div class="mb-3">
								    <label for="no_hp<?php echo $data['id_transaksi']; ?>" class="form-label">Nomor HP</label>
								    <input readonly type="text" class="form-control" id="no_hp<?php echo $data['id_transaksi']; ?>" aria-describedby="emailHelp" value="<?php echo $data['no_hp']; ?>">
								  </div>
								  <div class="mb-3">
								    <label for="paket<?php echo $data['id_transaksi']; ?>" class="form-label">Jenis Paket</label>
								    <input readonly type="text" class="form-control" id="paket<?php echo $data['id_transaksi']; ?>" aria-describedby="emailHelp" value="<?php echo $data['paket'].' - '.$data['harga']; ?>">
								  </div>
								  <div class="mb-3">
								    <label for="jenis_kendaraan<?php echo $data['id_transaksi']; ?>" class="form-label">Jenis Kendaraan</label>
								    <input readonly type="text" class="form-control" id="jenis_kendaraan<?php echo $data['id_transaksi']; ?>" aria-describedby="emailHelp" value="<?php echo $data['tipe_kendaraan'].' - '.$data['no_plat']; ?>">
								  </div>
								  <div class="mb-3">
								    <label for="operator<?php echo $data['id_transaksi']; ?>" class="form-label">Operator</label>
								    <input readonly type="text" class="form-control" id="operator<?php echo $data['id_transaksi']; ?>" aria-describedby="emailHelp" value="<?php echo $data['operator']; ?>">
								  </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
				<?php $no++; } ?>
					</tbody>
				</table>
				<?php include('../paginasi/btn-paginasi.php'); ?>
			</div>
		</div>
	</section>

	<?php
    error_reporting(0);
    $desc = $_GET['desc']; 
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
	<?php } elseif ($desc == "short-pass") { ?>
		<div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
	<?php } elseif ($desc == "email-ready") { ?>
		<div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
	<?php } elseif ($desc == "succes-regis") { ?>
		<div class="desc-in" data-flashdata="<?php echo $desc; ?>"></div>
	<?php } ?>

	<script type="text/javascript">
  
	  const desc_in = $('.desc-in').data('flashdata')
	  if (desc_in == "success-in") {
	    Swal.fire(
	      'Berhasil!',
	      'Anda Telah Melakukan Penambahan Transaksi',
	      'success'
	    )
	  } else if (desc_in == "failed-in") {
	  	Swal.fire(
	      'Gagal!',
	      'Anda Gagal Melakukan Penambahan Data',
	      'error'
	    )
	  } else if (desc_in == "success-ed") {
	  	Swal.fire(
	      'Berhasil!',
	      'Anda Telah Melakukan Perubahan Transaksi',
	      'success'
	    )
	  } else if (desc_in == "failed-ed") {
	  	Swal.fire(
	      'Gagal!',
	      'Anda Gagal Melakukan Perubahan Data',
	      'error'
	    )
	  } else if (desc_in == "success-del") {
	  	Swal.fire(
	      'Berhasil!',
	      'Anda Telah Melakukan Penghapusan Transaksi',
	      'success'
	    )
	  } else if (desc_in == "failed-del") {
	  	Swal.fire(
	      'Gagal!',
	      'Anda Gagal Melakukan Penghapusan Data',
	      'error'
	    )
	  } else if (desc_in == "short-pass") {
	  	Swal.fire(
	      'Gagal!',
	      'Password Kurang Dari 8 Karakter',
	      'error'
	    )
	  } else if (desc_in == "email-ready") {
	  	Swal.fire(
	      'Gagal!',
	      'Email Telah Terdaftar',
	      'error'
	    )
	  } else if (desc_in == "succes-regis") {
	  	Swal.fire(
	      'Berhasil!',
	      'Admin Telah Ditambahkan',
	      'success'
	    )
	  }

	</script>

<?php include('template/footer.php'); ?>
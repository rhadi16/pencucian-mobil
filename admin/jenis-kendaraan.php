<?php include('template/header.php'); ?>

<?php 

	$qry = "SELECT * FROM jenis_kendaraan";

	$orderby = "";

  $view   = "jenis-kendaraan.php";

  $column = [
              'value'  => ['tipe_kendaraan', 'no_plat'],
              'label'  => ['Tipe Kendaraan', 'Nomor Plat'],
              'type'   => ['text', 'text']
            ];

?>

	<section id="operator">
		<div class="container">
			<h5 class="title text-center">List Jenis Kendaraan</h5>
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-operator">
			  Tambah Jenis Kendaraan
			</button>

			<!-- Modal -->
			<div class="modal fade" id="tambah-operator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Jenis Kendaraan</h5>
			      </div>
			      <form action="func/func_kendaraan.php?action=insert" enctype="multipart/form-data" method="post">
				      <div class="modal-body">
				        <div class="mb-3">
							    <label for="tipe_kendaraan" class="form-label">Tipe Kendaraan</label>
							    <input type="text" class="form-control" id="tipe_kendaraan" aria-describedby="emailHelp" name="tipe_kendaraan">
							  </div>
							  <div class="mb-3">
							    <label for="no_plat" class="form-label">Nomor Plat</label>
							    <input type="text" class="form-control" id="no_plat" aria-describedby="emailHelp" name="no_plat">
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
				      <th scope="col">Tipe Kendaraan</th>
				      <th scope="col">Nomor Plat</th>
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
						<td><?php echo $data['tipe_kendaraan']; ?></td>
						<td><?php echo $data['no_plat']; ?></td>
						<td>
							<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-operator<?php echo $data['no']; ?>">
							  Edit
							</button>
							<button type="button" class="btn btn-danger confirm-delete<?php echo $data['no']; ?>">
							  Hapus
							</button>
							<script type="text/javascript">
					      $('.confirm-delete<?php echo $data['no']; ?>').on('click', function(e) {
					        Swal.fire({
					          title: 'Anda Yakin?',
					          text: "Ingin Menghapus Data <?php echo $data['tipe_kendaraan']; ?> dengan Plat <?php echo $data['no_plat']; ?>!",
					          icon: 'warning',
					          showCancelButton: true,
					          confirmButtonColor: '#3085d6',
					          cancelButtonColor: '#d33',
					          confirmButtonText: 'Ya, Yakin!'
					        }).then((result) => {
					          if (result.isConfirmed) {
					            window.location.href = "<?php echo 'func/func_kendaraan.php?action=delete&no='.$data['no']; ?>";
					          }
					        })
					      });
					    </script>
						</td>
					</tr>
					
					<!-- Modal -->
					<div class="modal fade" id="edit-operator<?php echo $data['no']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Edit Operator</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <form action="func/func_kendaraan.php?action=update" enctype="multipart/form-data" method="post">
						      <div class="modal-body">
						      	<input type="hidden" name="no" value="<?php echo $data['no']; ?>">
						        <div class="mb-3">
									    <label for="exampleEditEmail1<?php echo $data['no']; ?>" class="form-label">Tipe Kendaraan</label>
									    <input type="text" class="form-control" id="exampleEditEmail1<?php echo $data['no']; ?>" aria-describedby="emailHelp" name="tipe_kendaraan" value="<?php echo $data['tipe_kendaraan']; ?>">
									  </div>
									  <div class="mb-3">
									    <label for="namaEdit<?php echo $data['no']; ?>" class="form-label">Nomor Plat</label>
									    <input type="text" class="form-control" id="namaEdit<?php echo $data['no']; ?>" aria-describedby="emailHelp" name="no_plat" value="<?php echo $data['no_plat']; ?>">
									  </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-success">Change</button>
						      </div>
					      </form>
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
	      'Anda Telah Melakukan Penambahan Operator',
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
	      'Anda Telah Melakukan Perubahan Operator',
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
	      'Anda Telah Melakukan Penghapusan Data',
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
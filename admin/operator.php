<?php include('template/header.php'); ?>

<?php 

	$qry = "SELECT * FROM utenti";

	$orderby = "";

  $view   = "operator.php";

  $column = [
              'value'  => ['nama'],
              'label'  => ['Nama Operator'],
              'type'   => ['text']
            ];

?>

	<section id="operator">
		<div class="container">
			<h5 class="title text-center">List Operator</h5>
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-operator">
			  Tambah Operator
			</button>

			<!-- Modal -->
			<div class="modal fade" id="tambah-operator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Operator</h5>
			      </div>
			      <form action="func/func_regis.php" enctype="multipart/form-data" method="post">
				      <div class="modal-body">
				        <div class="mb-3">
							    <label for="exampleInputEmail1" class="form-label">Email</label>
							    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
							  </div>
							  <div class="mb-3">
							    <label for="nama" class="form-label">Nama</label>
							    <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" name="nama">
							  </div>
							  <div class="mb-3">
						      <label for="posisi" class="form-label">Posisi</label>
						      <select id="posisi" class="form-select" name="posisi">
						        <option value="admin">Admin</option>
						        <option value="kasir">Kasir</option>
						      </select>
						    </div>
						    <div class="mb-3">
							    <label for="exampleInputPassword1" class="form-label">Password</label>
							    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
							  </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				        <input type="hidden" name="register" value="register">
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
				      <th scope="col">Nama Operator</th>
				      <th scope="col">Posisi</th>
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
						<td><?php echo $data['nama']; ?></td>
						<td><?php echo $data['posisi']; ?></td>
						<td>
							<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-operator<?php echo $data['id']; ?>">
							  Edit
							</button>
							<button type="button" class="btn btn-danger confirm-delete<?php echo $data['id']; ?>">
							  Hapus
							</button>
							<script type="text/javascript">
					      $('.confirm-delete<?php echo $data['id']; ?>').on('click', function(e) {
					        Swal.fire({
					          title: 'Anda Yakin?',
					          text: "Ingin Menghapus Data <?php echo $data['nama']; ?>!",
					          icon: 'warning',
					          showCancelButton: true,
					          confirmButtonColor: '#3085d6',
					          cancelButtonColor: '#d33',
					          confirmButtonText: 'Ya, Yakin!'
					        }).then((result) => {
					          if (result.isConfirmed) {
					            window.location.href = "<?php echo 'func/operator_func.php?action=delete&id='.$data['id']; ?>";
					          }
					        })
					      });
					    </script>
						</td>
					</tr>
					
					<!-- Modal -->
					<div class="modal fade" id="edit-operator<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Edit Operator</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <form action="func/operator_func.php?action=update" enctype="multipart/form-data" method="post">
						      <div class="modal-body">
						      	<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
						        <div class="mb-3">
									    <label for="exampleEditEmail1<?php echo $data['id']; ?>" class="form-label">Email</label>
									    <input type="email" class="form-control" id="exampleEditEmail1<?php echo $data['id']; ?>" aria-describedby="emailHelp" name="email" value="<?php echo $data['email']; ?>">
									  </div>
									  <div class="mb-3">
									    <label for="namaEdit<?php echo $data['id']; ?>" class="form-label">Nama</label>
									    <input type="text" class="form-control" id="namaEdit<?php echo $data['id']; ?>" aria-describedby="emailHelp" name="nama" value="<?php echo $data['nama']; ?>">
									  </div>
									  <div class="mb-3">
								      <label for="posisiEdit<?php echo $data['id']; ?>" class="form-label">Posisi</label>
								      <select id="posisiEdit<?php echo $data['id']; ?>" class="form-select" name="posisi">
								        <option value="admin" <?php if($data['posisi']=="admin"){ echo 'selected';} ?>>Admin</option>
								        <option value="kasir" <?php if($data['posisi']=="kasir"){ echo 'selected';} ?>>Kasir</option>
								      </select>
								    </div>
								    <div class="mb-3">
									    <label for="exampleEditPassword1<?php echo $data['id']; ?>" class="form-label">Password</label>
									    <input type="hidden" name="password_lama" value="<?php echo $data['password']; ?>">
									    <input type="password" class="form-control" id="exampleEditPassword1<?php echo $data['id']; ?>" name="password">
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
	      'Anda Telah Melakukan Penghapusan Operator',
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
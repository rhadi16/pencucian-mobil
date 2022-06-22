<?php 
  session_start();
  include "config/auth.php";
?>
<?php 
  include("config/connect.php");

  if(!isset($_SESSION['user'])){
    // fungsi redirect menggunakan javascript
    echo '<script language="javascript"> window.location.href = "../index.php" </script>';
  }

  if ($_SESSION['otorisasi'] == 'admin') {
    $oto = "Admin";
  } else {
    $oto = "Kasir";
  }
  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&family=Viga&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome/all.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- My Style -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Green Wash</title>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/sweetalert/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
      <i class="fas fa-bars"></i>
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <i class="fas fa-user-circle"></i>
        <div class="akun">
          <b>
            <p>Halo,</p>
            <p><?php echo $oto; ?></p>
          </b>
        </div>
      </div>
    </div>
  </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Green Wash</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="list-group">
      <?php if ($oto == "Admin") { ?>
        <a href="index.php" class="btn btn-primary"><b>Dashboard</b></a>
        <a href="jenis-kendaraan.php" class="btn btn-primary"><b>Jenis Kendaraan</b></a>
        <a href="paket.php" class="btn btn-primary"><b>Paket</b></a>
        <a href="operator.php" class="btn btn-primary"><b>Operator</b></a>
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#cetak-laporan"><b>Laporan</b></button>
        <a href="transaksi.php" class="btn btn-primary"><b>Transaksi</b></a>
      <?php
      } else { ?>
        <a href="index.php" class="btn btn-primary"><b>Dashboard</b></a>
        <a href="transaksi.php" class="btn btn-primary"><b>Transaksi</b></a>
      <?php
      }
       ?>
      <button type="button" class="btn btn-primary"><b>About</b></button>
      <button type="button" class="btn btn-danger confirmation-logout"><b>Logout</b></button>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cetak-laporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Laporan Pencucian Kendaraan</h5>
      </div>
      <div class="modal-body">
        <div class="mb-3 text-center">
          <label class="form-label"><b>Keseluruhan</b></label><br>
          <a href="semua-laporan.php" class="btn btn-primary" target="_blank"><b>Download</b></a>
        </div>
        <div class="mb-3 text-center">
          <form action="laporan-periode.php" enctype="multipart/form-data" method="post" target="_blank">
            <label class="form-label"><b>Per Periode</b></label><br>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <input required type="date" class="form-control" id="tanggal_awal" aria-describedby="emailHelp" name="tanggal_awal">
              </div>
              <div class="col-md-6 col-sm-12">
                <input required type="date" class="form-control" id="tanggal_akhir" aria-describedby="emailHelp" name="tanggal_akhir">
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3"><b>Download</b></button>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('.confirmation-logout').on('click', function(e) {
    Swal.fire({
      title: 'Anda Yakin?',
      text: "Ingin Logout!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Yakin!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?php echo '../index.php?logout=1' ?>";
      }
    })
  });
</script>
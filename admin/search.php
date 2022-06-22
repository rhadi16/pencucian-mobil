<?php
  include("config/connect.php");

  if (isset($_POST['search'])) {
    $search = $_POST['search'];

    $qry = "SELECT * FROM list_barang";
    $field = "nama_barang";
    $view = "index.php";
    $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;

    $limit = 15;
    $limitStart = ($page - 1) * $limit;
    if ($search == "") {

      $dt = mysqli_query($mysqli, "$qry LIMIT ".$limitStart.",".$limit);

    } else {

      $dt = mysqli_query($mysqli, "$qry WHERE $field LIKE '%" . $search . "%'");
      
    }
    while ($data = mysqli_fetch_array($dt)) {
?>
      <div class="col-6 col-md-4 col-lg-3 mb-3">
        <div class="card">
          <img src="img/<?php echo $data['gambar']; ?>" class="card-img-top" alt="...">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo $data['nama_barang']; ?></li>
            <li class="list-group-item"><?php echo "Rp. ".number_format($data['harga'],0,",","."); ?></li>
          </ul>
        </div>
      </div>
<?php } 
    if ($search == "") {
?>
      <div class="mt-3 mb-4">
        <?php include('../btn-paginasi.php'); ?>
      </div>
<?php 
    }
  } 
?>
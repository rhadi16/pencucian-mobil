<?php 
	include '../config/connect.php';
	include '../config/auth.php';

	$action = $_GET['action'];

	if ($action == "insert") {
		  $id_transaksi = $_POST['id_transaksi'];
		  $tanggal = $_POST['tanggal'];
		  $nama = $_POST['nama'];
		  $alamat = $_POST['alamat'];
		  $no_hp = $_POST['no_hp'];
		  $paket1 = $_POST['paket'];
		  $jenis_kendaraan = $_POST['jenis_kendaraan'];
		  $operator = $_POST['operator'];

		  $pecah_paket = explode(" - ", $paket1);
		  $paket = $pecah_paket[0];
		  $harga = $pecah_paket[1];

		  $pecah_kendaraan = explode(" - ", $jenis_kendaraan);
		  $tipe_kendaraan = $pecah_kendaraan[0];
		  $no_plat = $pecah_kendaraan[1];

		  $result = mysqli_query($mysqli, "INSERT INTO transaksi (id_transaksi, tanggal, nama, alamat, no_hp, paket, harga, tipe_kendaraan, no_plat, operator) 
			                               VALUES('$id_transaksi', '$tanggal', '$nama', '$alamat', '$no_hp', '$paket', '$harga', '$tipe_kendaraan', '$no_plat', '$operator')") or die(mysqli_error($mysqli));
		  
		  if($result){ 
		      echo '<script language="javascript"> window.location.href = "../transaksi.php?desc=success-in" </script>';
		  }else{
		      echo '<script language="javascript"> window.location.href = "../transaksi.php?desc=failed-in" </script>';
		  }
	}
	elseif ($action == "delete") {
		$id_transaksi = $_GET['id_transaksi'];

    $result = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'") or die(mysqli_error($mysqli));

    if($result){
	    echo '<script language="javascript"> window.location.href = "../transaksi.php?desc=success-del" </script>';
	  }else{
	    echo '<script language="javascript"> window.location.href = "../transaksi.php?desc=failed-del" </script>';
	  }
	}
?>
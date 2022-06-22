<?php 
	include '../config/connect.php';
	include '../config/auth.php';

	$action = $_GET['action'];

	if ($action == "insert") {
		  $tipe_kendaraan = $_POST['tipe_kendaraan'];
		  $no_plat = $_POST['no_plat'];

		  $result = mysqli_query($mysqli, "INSERT INTO jenis_kendaraan (no, tipe_kendaraan, no_plat) 
			                               VALUES(null, '$tipe_kendaraan', '$no_plat')") or die(mysqli_error($mysqli));
		  
		  if($result){ 
		      echo '<script language="javascript"> window.location.href = "../jenis-kendaraan.php?desc=success-in" </script>';
		  }else{
		      echo '<script language="javascript"> window.location.href = "../jenis-kendaraan.php?desc=failed-in" </script>';
		  }
	}
	elseif ($action == "update") {
		$no 			= $_POST['no'];
		$tipe_kendaraan 		= $_POST['tipe_kendaraan'];
		$no_plat 		= $_POST['no_plat'];

		$result = mysqli_query($mysqli, "UPDATE jenis_kendaraan
									  									SET 
									  									   tipe_kendaraan = '$tipe_kendaraan',
									  									   no_plat = '$no_plat'
									  									   WHERE no = '$no'
									  									") or die(mysqli_error($mysqli));

		if($result){
	    echo '<script language="javascript"> window.location.href = "../jenis-kendaraan.php?desc=success-ed" </script>';
	  }else{
	    echo '<script language="javascript"> window.location.href = "../jenis-kendaraan.php?desc=failed-ed" </script>';
	  }
	}
	elseif ($action == "delete") {
		$no = $_GET['no'];

    $result = mysqli_query($mysqli, "DELETE FROM jenis_kendaraan WHERE no = $no") or die(mysqli_error($mysqli));

    if($result){
	    echo '<script language="javascript"> window.location.href = "../jenis-kendaraan.php?desc=success-del" </script>';
	  }else{
	    echo '<script language="javascript"> window.location.href = "../jenis-kendaraan.php?desc=failed-del" </script>';
	  }
	}
?>
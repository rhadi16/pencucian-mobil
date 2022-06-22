<?php 
	include '../config/connect.php';
	include '../config/auth.php';

	$action = $_GET['action'];

	if ($action == "insert") {
		  $paket = $_POST['paket'];
		  $harga = $_POST['harga'];

		  $result = mysqli_query($mysqli, "INSERT INTO paket (no, paket, harga) 
			                               VALUES(null, '$paket', '$harga')") or die(mysqli_error($mysqli));
		  
		  if($result){ 
		      echo '<script language="javascript"> window.location.href = "../paket.php?desc=success-in" </script>';
		  }else{
		      echo '<script language="javascript"> window.location.href = "../paket.php?desc=failed-in" </script>';
		  }
	}
	elseif ($action == "update") {
		$no 	 = $_POST['no'];
		$paket = $_POST['paket'];
		$harga = $_POST['harga'];

		$result = mysqli_query($mysqli, "UPDATE paket
									  									SET 
									  									   paket = '$paket',
									  									   harga = '$harga'
									  									   WHERE no = '$no'
									  									") or die(mysqli_error($mysqli));

		if($result){
	    echo '<script language="javascript"> window.location.href = "../paket.php?desc=success-ed" </script>';
	  }else{
	    echo '<script language="javascript"> window.location.href = "../paket.php?desc=failed-ed" </script>';
	  }
	}
	elseif ($action == "delete") {
		$no = $_GET['no'];

    $result = mysqli_query($mysqli, "DELETE FROM paket WHERE no = $no") or die(mysqli_error($mysqli));

    if($result){
	    echo '<script language="javascript"> window.location.href = "../paket.php?desc=success-del" </script>';
	  }else{
	    echo '<script language="javascript"> window.location.href = "../paket.php?desc=failed-del" </script>';
	  }
	}
?>
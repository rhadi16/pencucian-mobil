<?php 
	include '../config/connect.php';
	include '../config/auth.php';

	$action = $_GET['action'];

	if ($action == "update") {
		$id 			= $_POST['id'];
		$email 		= $_POST['email'];
		if ($_POST['password'] == '') {
			$password = $_POST['password_lama'];
		} else {
			$password = password_hash($_POST['password'].PEPPER, PASSWORD_DEFAULT, ['cost' => 12]);
		}
		$nama 		= $_POST['nama'];
		$posisi 	= $_POST['posisi'];

		$result = mysqli_query($mysqli, "UPDATE utenti
									  									SET 
									  									   email = '$email',
									  									   password = '$password',
									  									   nama = '$nama',
									  									   posisi = '$posisi'
									  									   WHERE id = $id
									  									") or die(mysqli_error($mysqli));

		if($result){
	    echo '<script language="javascript"> window.location.href = "../operator.php?desc=success-ed" </script>';
	  }else{
	    echo '<script language="javascript"> window.location.href = "../operator.php?desc=failed-ed" </script>';
	  }
	}
	elseif ($action == "delete") {
		$id = $_GET['id'];

    $result = mysqli_query($mysqli, "DELETE FROM utenti WHERE id = $id") or die(mysqli_error($mysqli));

    if($result){
	    echo '<script language="javascript"> window.location.href = "../operator.php?desc=success-del" </script>';
	  }else{
	    echo '<script language="javascript"> window.location.href = "../operator.php?desc=failed-del" </script>';
	  }
	}
?>
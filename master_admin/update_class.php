<?php
include('../includes/database_conn.php');
	if ($_POST['update_btn']) {
		$c_name = $_POST['c_name'];
		$c_section = $_POST['c_section'];
		// $password = $_POST['password'];
		// $firstname = $row['firstname'];
		// $email = $row['email'];
		// $password = $row['password'];

		$id = $_POST['update_btn'];
		$conn = $pdo->open();
		try {
		$stmt = $conn->prepare("UPDATE sls_classes SET c_name='$c_name', c_section='$c_section' WHERE id=$id");
		$stmt->execute();

		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	
		$pdo->close();
	}

	header('location: classes.php')

?>
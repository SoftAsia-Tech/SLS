<?php
include('../includes/database_conn.php');
	if ($_POST['update_btn']) {
		$firstname = $_POST['firstname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		// $firstname = $row['firstname'];
		// $email = $row['email'];
		// $password = $row['password'];

		$id = $_POST['update_btn'];
		$conn = $pdo->open();
		try {
		$stmt = $conn->prepare("UPDATE sls_users SET firstname='$firstname', email='$email', password='$password' WHERE id=$id");
		$stmt->execute();

		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	
		$pdo->close();
	}

	header('location: schools.php')

?>
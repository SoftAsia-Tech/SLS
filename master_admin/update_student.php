<?php
include('../includes/database_conn.php');
	if ($_POST['update_btn']) {
		$s_name = $_POST['s_name'];
		$s_email = $_POST['s_email'];
		// $password = $_POST['password'];
		// $firstname = $row['firstname'];
		// $email = $row['email'];
		// $password = $row['password'];

		$id = $_POST['update_btn'];
		$conn = $pdo->open();
		try {
		$stmt = $conn->prepare("UPDATE sls_students SET s_name='$s_name', s_email='$s_email' WHERE id=$id");
		$stmt->execute();

		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	
		$pdo->close();
	}

	header('location: students.php')

?>
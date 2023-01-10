<?php
include('../includes/database_conn.php');
	if ($_POST['update_btn']) {
		$teachern = $_POST['teachername'];
		// $c_section = $_POST['c_section'];
		// $password = $_POST['password'];
		// $firstname = $row['firstname'];
		// $email = $row['email'];
		// $password = $row['password'];

		$id = $_POST['update_btn'];
		$conn = $pdo->open();
		try {
		$stmt = $conn->prepare("UPDATE sls_teachers SET teacher_name='$teachern' WHERE id=$id");
		$stmt->execute();

		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	
		$pdo->close();
	}

	header('location: teachers.php')

?>
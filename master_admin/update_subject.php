<?php
include('../includes/database_conn.php');
	if ($_POST['update_btn']) {
        $subject_name = $_POST['subject_name'];
		// $password = $_POST['password'];
		// $firstname = $row['firstname'];
		// $email = $row['email'];
		// $password = $row['password'];

		$id = $_POST['update_btn'];
		$conn = $pdo->open();
		try {
		$stmt = $conn->prepare("UPDATE sls_subjects SET subject_name='$subject_name' WHERE id=$id");
		$stmt->execute();

		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	
		$pdo->close();
	}

	header('location: subjects.php')

?>
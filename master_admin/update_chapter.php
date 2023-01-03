<?php
include('../includes/database_conn.php');
	if ($_POST['update_btn']) {
        $chapter_name = $_POST['chapter_name'];
		$chapter_number =$_POST['chapter_number'];
		// $password = $_POST['password'];
		// $firstname = $row['firstname'];
		// $email = $row['email'];
		// $password = $row['password'];

		$id = $_POST['update_btn'];
		$conn = $pdo->open();
		try {
		$stmt = $conn->prepare("UPDATE sls_chapters SET chapter_name='$chapter_name', chapter_number='$chapter_number' WHERE id=$id");
		$stmt->execute();

		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	
		$pdo->close();
	}

	header('location: chapters.php')

?>
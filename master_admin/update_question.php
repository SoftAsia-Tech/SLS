<?php
include('../includes/database_conn.php');
	if ($_POST['update_btn']) {
        $question_name = $_POST['question_name'];
		$question_number =$_POST['question_number'];
		$option1 =$_POST['option1'];
		$option2 =$_POST['option2'];
		$option3 =$_POST['option3'];
		$option4 =$_POST['option4'];
		// $password = $_POST['password'];
		// $firstname = $row['firstname'];
		// $email = $row['email'];
		// $password = $row['password'];

		$id = $_POST['update_btn'];
		$conn = $pdo->open();
		try {
		$stmt = $conn->prepare("UPDATE sls_questions SET question='$question_name', question_number='$question_number', option1='$option1', option2='$option2', option3='$option3', option4='$option4' WHERE id=$id");
		$stmt->execute();

		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	
		$pdo->close();
	}

	header('location: questions.php')

?>
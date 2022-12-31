<?php
	include 'database_conn.php';
	session_start();

	if(isset($_SESSION['madmin'])){
		// header('location: teacher/teacher_dashboard.php');
		// header('location: index.php');
	}
	if(isset($_SESSION['teacher'])){
		// header('location: teacher/teacher_dashboard.php');
		// header('location: index.php');
	}
	
	if(isset($_SESSION['school'])){
	// 	header('location: supplier/home.php');
	}
	if(isset($_SESSION['principal'])){
		// 	header('location: supplier/home.php');
	}
	if(isset($_SESSION['parent'])){
		// 	header('location: supplier/home.php');
	}

	// if(isset($_SESSION['both'])){
	// 	header('location: both/home.php');
	// }

	if(isset($_SESSION['student'])){
		$conn = $pdo->open();
	
		try{
			$stmt = $conn->prepare("SELECT * FROM sls_users WHERE id=:id");
			$stmt->execute(['id'=>$_SESSION['student']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}
	
		$pdo->close();
	}
?>
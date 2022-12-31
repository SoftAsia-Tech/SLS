<?php
	include 'includes/session.php';
	$conn = $pdo->open();
	
	if(isset($_POST['login'])){
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		try{
			$stmt = $conn->prepare("SELECT * FROM sls_users WHERE email = :email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			// var_dump($row);
			// if($row['numrows'] > 0){
				// if($row['status']){
					if(password_verify($password, $row['password'])){
						if($row['role'] == "madmin"){
							$_SESSION['madmin'] = $row['id'];
						}
						elseif($row['role'] == "student"){
							$_SESSION['student'] = $row['id'];
						}
						elseif ($row['role'] == "teacher" ){
							$_SESSION['teacher'] = $row['id'];
						}
						elseif ($row['role'] == "school" ){
							$_SESSION['school'] = $row['id'];
						}
						elseif ($row['role'] == "principal" ){
							$_SESSION['principal'] = $row['id'];
						}
						elseif ($row['role'] == "parent" ){
							$_SESSION['parent'] = $row['id'];
						}
						else{
							echo 'Nothing';
						} 
						
					}
					else{
						$_SESSION['error'] = 'Icncorret Password';
					}
				// }
				// else{
				// 	$_SESSION['error'] = 'Account not activated.';
				// }
			// }
			// else{
			// 	$_SESSION['error'] = 'Email not found';
			// }
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}
	}
	else{
		$_SESSION['error'] = 'Input login credentails first';
	}

	$pdo->close();

	header('location: signin.php');
// var_dump($_SESSION);
?>







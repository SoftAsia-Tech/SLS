<?php include 'includes/database_conn.php'; ?> 
<?php
	if(isset($_POST['signup'])){
		$id =$_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = $_POST['role'];
		// Inserting supplier and buyer
		// $type_supplier = $_POST['supplier'];
		// $type_buyer = $_POST['buyer'];
		// $type_admin = $_POST['admin'];
		// $role = 'user';
		// if ($type_supplier == true and $type_buyer == false){
		// 	// User is supplier, value is 3
		// 	$role = 'supplier';	
		// }
		// elseif ($type_buyer == true and $type_supplier == false){
		// 	// User is buyer, value 2
		// 	$role = 'user';
		// }
		// elseif ($type_supplier == true and $type_buyer == true){
		// 	// User is buyer and supplier, value is 4
		// 	$role = 'both';
		// }
		// elseif($type_admin == true){
		// 	$role = 'admin';
		// }
		// $_SESSION['firstname'] = $firstname;
		// $_SESSION['lastname'] = $lastname;
		// $_SESSION['email'] = $email;
		// $_SESSION['password'] = $password;
		// $_SESSION['student_role'] = $role;
			
        $conn = $pdo->open();
		$password = password_hash($password, PASSWORD_DEFAULT);
		$stmt = $conn->prepare("INSERT INTO sls_users (id, email, password, firstname, lastname, role) VALUES (:id, :email, :password, :firstname, :lastname, :role)");
		$stmt->execute(['id'=>$id, 'email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'role'=>$role]);
		
		header('location: signin.php');
	 	

	}
?>
<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
    <body>
		<?php include('../includes/navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php //include('subject_sidebar.php'); ?>
		
						<div class="span9" id="content">
		                    <div class="row-fluid">
							<?php
                                if(isset($_POST['save'])){
                                    $id =$_POST['id'];
                                    $firstname = $_POST['firstname'];
                                    $email = $_POST['email'];
                                    // $password = $_POST['password'];
                                    // $role = $_POST['role'];
                                
                                    $conn = $pdo->open();
                                
                                    // $stmt = $conn->prepare("SELECT * FROM sls_users WHERE role=school");
                                    // $stmt->execute(['id'=>$id]);
                                    // $row = $stmt->fetch( 
                                    try{
                                        $password = password_hash($password, PASSWORD_DEFAULT);
		                                $stmt = $conn->prepare("INSERT INTO sls_schools (id, firstname, email) VALUES (:id, :firstname, :email)");
		                                $stmt->execute(['id'=>$id,'firstname'=>$firstname,'email'=>$email ]);
                                        // $_SESSION['success'] = 'Product added successfully';
                                    
                                    }
                                    catch(PDOException $e){
                                        $_SESSION['error'] = $e->getMessage();
                                    }
                                    
                                    header('location: schools.php');
                                    $pdo->close(); 
                                }
                                ?>
								 <script>
								// alert('Data Already Exist');
								// </script>
										
		                        <!-- block -->
		                        <div class="block">
		                            <div class="navbar navbar-inner block-header">
		                                <div class="muted pull-left">Add School</div>
                                        
		                            </div>
                                    
		                            <div class="block-content collapse/* in*/">
									<a href="schools.php"><i class="icon-arrow-left"></i> Back</a>
									    <form class="form-horizontal" method="post">
                                            <div class="control-group">
                                                <input type="hidden" name="id" class="form-control form-control-lg"/>
                                                <label class="control-label" for="inputEmail">School Name</label>
                                                <input type="text" name="firstname" class="form-control"  id="inputEmail" placeholder="School Name">
                                                <label class="control-label" for="inputPassword">Email</label>
                                                <input type="email" class="span8 form-control" name="email" id="inputPassword" placeholder="email@email.com" required>
                                                <!-- <label class="control-label" for="inputPassword">Password</label> 
                                                <input type="Password" class="span1 form-control" name="password" id="inputPassword" required> -->
                                                <!-- <label>

                                                    <input id="radio1" name="role" type="radio" checked="checked" value="school" ><label for=radio1> .</label><br>
                                                </label> -->
                                               
                                                <hr>	
                                                <button name="save" type="submit" class="btn btn-info"><i class="icon-save"></i> Save</button>
                                            </div>
										</form>
										
										
										<script>
										//window.location = "schools.php";
										</script>
										<?php
										//}
										
										
										?>
									
								
		                            </div>
		                        </div>
		                        <!-- /block -->
		                    </div>
		                </div>
            </div>
		<?php //include('footer.php'); ?>
        </div>
		<?php //include('script.php'); ?>
    </body>

</html>
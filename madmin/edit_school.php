<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php //$get_id = $_GET['id']; ?>
    <body>
		<?php include('../includes/navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php //include('subject_sidebar.php'); ?>
		
						<div class="span9" id="content">
		                    
		                        <!-- block -->
		                        <div class="block">
		                            <div class="navbar navbar-inner block-header">
		                                <!-- <div class="muted pull-left">Add School</div> -->
                                        
		                            </div>
									<?php
										if ($_POST['edit_school']) {
											
											$id = $_POST['edit_school'];
											$conn = $pdo->open();
											try {
												$stmt = $conn->prepare("SELECT * FROM sls_users WHERE role='school' and id=$id");
												$stmt->execute();
												$rows = $stmt->fetchAll(); {
													foreach ($rows as $row) {
														$a = $row['firstname'];
														$b = $row['email'];
													}
												}
											
												echo "
													<div class='block-content collapse/* in*/'>
														<a href='schools.php'><i class='icon-arrow-left'></i> Back</a>
														<form action='update_school.php' class='form-horizontal' method='post'>
															<div class='control-group'>
																<label class='control-label' for='inputEmail'>School Name</label>
																<input type='text' name='firstname' class='form-control' id='inputEmail' required value= ".$row['firstname'].">
																<label class='control-label' for='inputPassword'>Email</label>
																<input type='email' class='span8 form-control' name='email' id='inputPassword' required value= ".$row['email']." >
																<label class='control-label' for='inputPassword'>Password</label> 
																<input type='Password' class='span1 form-control' name='password' id='inputPassword' required value=".$row['password']." >
																<hr>	
																<button name='update_btn' type='submit' value=". $row['id']." class='btn btn-info'> Update</button>
															</div>
														</form>
														<div class='row-fluid'>
														</div>
													</div>
												";
												
											} catch (PDOException $e) {
												$_SESSION['error'] = $e->getMessage();
											}
										
											$pdo->close();
										}
									?>
                                    
		                            
								
								
		                        <!-- /block -->
		                    </div>
		                </div>
            </div>
		<?php //include('footer.php'); ?>
        </div>
		<?php //include('script.php'); ?>
    </body>

</html>
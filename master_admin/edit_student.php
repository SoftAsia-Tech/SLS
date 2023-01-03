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
										if ($_POST['edit_student']) {
											
											$id = $_POST['edit_student'];
											$conn = $pdo->open();
											try {
												$stmt = $conn->prepare("SELECT * FROM sls_students WHERE id=$id");
												$stmt->execute();
												$rows = $stmt->fetchAll(); {
													foreach ($rows as $row) {
														$s_name = $row['s_name'];
														$s_email = $row['s_email'];
														
													}
												}
											
												echo "
													<div class='block-content collapse/* in*/'>
														<a href='students.php'><i class='icon-arrow-left'></i> Back</a>
														<form action='update_student.php' class='form-horizontal' method='post'>
															<div class='control-group'>
																<label class='control-label' >Student Name</label>
																<input type='text' name='s_name' class='form-control' id='inputEmail' required value= ".$row['s_name'].">
																<label class='control-label' >Email</label>
																<input type='email' name='s_email' class='form-control' id='inputEmail' required value= ".$row['s_email'].">
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
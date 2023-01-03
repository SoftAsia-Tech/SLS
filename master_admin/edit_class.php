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
												$stmt = $conn->prepare("SELECT * FROM sls_classes WHERE id=$id");
												$stmt->execute();
												$rows = $stmt->fetchAll(); {
													foreach ($rows as $row) {
														$a = $row['c_name'];
														$b = $row['c_section'];
													}
												}
											
												echo "
													<div class='block-content collapse/* in*/'>
														<a href='schools.php'><i class='icon-arrow-left'></i> Back</a>
														<form action='update_class.php' class='form-horizontal' method='post'>
															<div class='control-group'>
																<label class='control-label' for='inputEmail'>Class Name</label>
																<input type='text' name='c_name' class='form-control' id='inputEmail' required value= ".$row['c_name'].">
																<label class='control-label' for='inputPassword'>Section</label>
																<input type='text' class='span8 form-control' name='c_section' id='inputPassword' required value= ".$row['c_section']." >
																
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
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
										if ($_POST['edit_chapter']) {
											
											$id = $_POST['edit_chapter'];
											$conn = $pdo->open();
											try {
												$stmt = $conn->prepare("SELECT * FROM sls_chapters WHERE id=$id");
												$stmt->execute();
												$rows = $stmt->fetchAll(); {
													foreach ($rows as $row) {
														$chapter_name = $row['chapter_name'];
														$chapter_number = $row['chapter_number'];
														
													}
												}
											
												echo "
													<div class='block-content collapse/* in*/'>
														<a href='chapters.php'><i class='icon-arrow-left'></i> Back</a>
														<form action='update_chapter.php' class='form-horizontal' method='post'>
															<div class='control-group'>
																<label class='control-label' >Chapter Name</label>
																<input type='text' name='chapter_name' class='form-control' id='inputEmail' required value= ".$row['chapter_name'].">
																<label class='control-label' >Chapter Number</label>
																<input type='text' name='chapter_number' class='form-control' required value= ".$row['chapter_number'].">
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
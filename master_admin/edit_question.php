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
										if ($_POST['edit_question']) {
											
											$id = $_POST['edit_question'];
											$conn = $pdo->open();
											try {
												$stmt = $conn->prepare("SELECT * FROM sls_questions WHERE id=$id");
												$stmt->execute();
												$rows = $stmt->fetchAll(); {
													foreach ($rows as $row) {
														$question_name = $row['question'];
														$question_number = $row['question_number'];
														$option1 = $row['option1'];
														$option2 = $row['option2'];
														$option3 = $row['option3'];
														$option4 = $row['option4'];
														
													}
												}
											
												$questions =  "
													<div class='block-content collapse/* in*/'>
														<a href='questions.php'><i class='icon-arrow-left'></i> Back</a>
														<form action='update_question.php' class='form-horizontal' method='post'>
															<div class='control-group'>
																<label class='control-label' >Question</label>
																<input type='text' name='question_name' class='form-control'  value='".$row['question']."'>
																<label class='control-label' >Question Number</label>
																<input type='text' name='question_number' class='form-control'  value= ".$row['question_number'].">
																<label class='control-label' >Option 1</label>
																<input type='text' name='option1' class='form-control'  value='".$row['option1']."'>
																<label class='control-label' >Option 2</label>
																<input type='text' name='option2' class='form-control'  value='".$row['option2']."'>
																<label class='control-label' >Option 3</label>
																<input type='text' name='option3' class='form-control'  value='".$row['option3']."'>
																<label class='control-label' >Option 4</label>
																<input type='text' name='option4' class='form-control'  value='".$row['option4']."'>
																<hr>	
																<button name='update_btn' type='submit' value='". $row['id']."' class='btn btn-info'> Update</button>
															</div>
														</form>
														<div class='row-fluid'>
														</div>
													</div>
												";

                                            echo $questions;
												
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
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
                                    $chapter_id = $_SESSION['current_chapter'];
                                    $chapter_name = $_POST['chapter_name'];
                                    $question_name = $_POST['question_name'];
                                    $question_number = $_POST['question_number'];
                                    $option1 = $_POST['option1'];
                                    $option2 = $_POST['option2'];
                                    $option3 = $_POST['option3'];
                                    $option4 = $_POST['option4'];
                                    // $section = $_POST['class_section'];
                                    // $school_id = $_POST['school_id'];
                                    
                                    $conn = $pdo->open();
                                
                                    
                                    try{
                                        
		                                $stmt = $conn->prepare("INSERT INTO sls_questions (chapter_id, question, question_number, option1, option2, option3, option4) VALUES (:chapter_id, :question, :question_number, :option1, :option2, :option3, :option4)");
                                        $stmt->execute(['chapter_id'=>$chapter_id, 'question'=>$question_name, 'question_number'=>$question_number, 'option1'=>$option1, 'option2'=>$option2, 'option3'=>$option3, 'option4'=>$option4]);
                                        // $_SESSION['success'] = 'Product added successfully';
                                    
                                    }
                                    catch(PDOException $e){
                                        $_SESSION['error'] = $e->getMessage();
                                    }
                                    
                                    header('location: questions.php');
                                    $pdo->close(); 
                                }
                                ?>
								 <script>
								// alert('Data Already Exist');
								// </script>
										
		                        <!-- block -->
		                        <div class="block">
		                            <div class="navbar navbar-inner block-header">
		                                <div class="muted pull-left">Add Question</div>
                                        
		                            </div>
                                    
		                            <div class="block-content collapse/* in*/">
									    <a href="questions.php"><i class="icon-arrow-left"></i> Back</a>
									    <form action='' class="form-horizontal" method="post">
                                            <div class="control-group">
                                                <input type="hidden" name="chapter_id" class="form-control form-control-lg"/>
                                                <label class="control-label">Question</label>
                                                <input type="text" name="question_name" value="" class="form-control"  >
                                                <label class="control-label">Question Number</label>
                                                <input type="text" name="question_number" value="" class="form-control"  >
                                                <label class="control-label">Option 1</label>
                                                <input type="text" name="option1" value="" class="form-control"  >
                                                <label class="control-label">Option 2</label>
                                                <input type="text" name="option2" value="" class="form-control"  >
                                                <label class="control-label">Option 3</label>
                                                <input type="text" name="option3" value="" class="form-control"  >
                                                <label class="control-label">Option 4</label>
                                                <input type="text" name="option4" value="" class="form-control"  >

                                                <!-- <label class="control-label" >Section</label>
                                                <input type="text" class="span8 form-control" value="section" name="class_section"  required> -->
                                                <!-- <input type="hidden" name="school_id" value=".$row['id']." class="form-control form-control-lg"/> -->
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
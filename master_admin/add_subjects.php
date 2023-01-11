<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>

<?php 
if(isset($_POST['addnew_subject'])){
    $teacherid = $_POST['addnew_subject'];
    $_SESSION['teacherid'] = $_POST['addnew_subject'];

}
?>
    <body>
		<?php include('../includes/navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php //include('subject_sidebar.php'); ?>
		
						<div class="span9" id="content">
		                    <div class="row-fluid">
							<?php
                                if(isset($_POST['save'])){
                                    $class_id = $_SESSION['current_class'];
                                    $teacherid = $_SESSION['teacherid'];
                                    $subject_name = $_POST['subject_name'];
                                    // $section = $_POST['class_section'];
                                    // $school_id = $_POST['school_id'];
                                    
                                    $conn = $pdo->open();
                                
                                    
                                    try{
                                        
		                                $stmt = $conn->prepare("INSERT INTO sls_subjects (class_id, teacher_id, subject_name) VALUES (:class_id, :teacher_id, :subject_name)");
                                        $stmt->execute(['class_id'=>$class_id, 'teacher_id'=>$teacherid, 'subject_name'=>$subject_name]);
                                        // $_SESSION['success'] = 'Product added successfully';
                                    
                                    }
                                    catch(PDOException $e){
                                        $_SESSION['error'] = $e->getMessage();
                                    }
                                    
                                    header('location: subjects.php');
                                    $pdo->close(); 
                                }
                                ?>
								 <script>
								// alert('Data Already Exist');
								// </script>
										
		                        <!-- block -->
		                        <div class="block">
		                            <div class="navbar navbar-inner block-header">
		                                <div class="muted pull-left">Add Subjects</div>
                                        
		                            </div>
                                    
		                            <div class="block-content collapse/* in*/">
									    <a href="subjects.php"><i class="icon-arrow-left"></i> Back</a>
									    <form action='' class="form-horizontal" method="post">
                                            <div class="control-group">
                                                <input type="hidden" name="class_id" class="form-control form-control-lg"/>
                                                <label class="control-label">Subject Name</label>
                                                <input type="text" name="subject_name" value="subject" class="form-control"  >
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
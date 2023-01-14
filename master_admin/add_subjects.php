<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>

<?php 
// if(isset($_POST['addnew_subject'])){
//     $teacherid = $_POST['addnew_subject'];
//     $_SESSION['teacherid'] = $_POST['addnew_subject'];

// }
?>
    <body>
		<?php include('../includes/navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php //include('subject_sidebar.php'); ?>
		
						<div class="span9" id="content">
		                    <div class="row-fluid">
							<?php
                                $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                                $sql = 'SELECT * FROM sls_teachers';
                                   try{
                                     $stmt = $conn->prepare($sql);
                                     $stmt->execute();
                                     $rows = $stmt->fetchAll();
                                    //  foreach ($rows as $row) {
                                        
                                    //     $id = $row['id'];
                                    //     echo "$id <br>";
                                    //  }
                              
                                if(isset($_POST['addNew_subject'])){
                                    $class_id = $_SESSION['current_class'];
                                    // $teacherid = $_SESSION['teacherid'];
                                    $teacher_ID = $_POST['teacher_ID'];
                                    $subject_name = $_POST['subject_name'];
                                    // $section = $_POST['class_section'];
                                    // $school_id = $_POST['school_id'];
                                    
                                    $conn = $pdo->open();
                                
                                    
                                    try{
                                        
		                                $stmt = $conn->prepare("INSERT INTO sls_subjects (class_id, teacher_id, subject_name) VALUES (:class_id, :teacher_id, :subject_name)");
                                        $stmt->execute(['class_id'=>$class_id, 'teacher_id'=>$teacher_ID, 'subject_name'=>$subject_name]);

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
                                                <?php
                                                   
                                                   ?>
                                                   <!-- <form action='' method='post'> -->
                                                    <label for='teacher_ID'>Teacher</label>
                                                    <select name='teacher_ID' id="teacher_ID" class='custom-select'>
                                                       <!-- <option >Select Teacher</option> -->
                                                       <?php foreach ($rows as $output) { ?>
                                                       <option value='<?php echo $output['id'] ?>' ><?php echo $output['teacher_name']; ?> </option>
                                                      <?php
                                                       }
                                                    }
                                                    catch(PDOException $e){
                                                      $_SESSION['error'] = $e->getMessage();
                                                  }
                                                       ?>
                                                   </select>
                                                   <!-- <input type="submit" name="submit"> -->
                                                   <!-- </form> -->
                                                <hr>	
                                                <button name="addNew_subject" type="submit" class="btn btn-info" value="add subject"> Save</button>
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
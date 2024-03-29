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
                                    $school_id = $_SESSION['current_school'];
                                    $name = $_POST['class_name'];
                                    $section = $_POST['class_section'];
                                    $teacher_ID = $_POST['teacher_ID'];
                                    // $school_id = $_POST['school_id'];
                                    
                                    $conn = $pdo->open();
                                
                                    
                                    try{
                                        
		                                $stmt = $conn->prepare("INSERT INTO sls_classes (school_id, teacher_id, c_name, c_section) VALUES (:school_id, :teacher_id, :c_name, :c_section)");
                                        $stmt->execute(['school_id'=>$school_id, 'teacher_id'=>$teacher_ID, 'c_name'=>$name, 'c_section'=>$section]);
                                        // $_SESSION['success'] = 'Product added successfully';
                                    
                                    }
                                    catch(PDOException $e){
                                        $_SESSION['error'] = $e->getMessage();
                                    }
                                    
                                    header('location: classes.php');
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
									    <a href="classes.php"><i class="icon-arrow-left"></i> Back</a>
									    <form action='' class="form-horizontal" method="post">
                                            <div class="control-group">
                                                <input type="hidden" name="school_id" class="form-control form-control-lg"/>
                                                <label class="control-label" for="inputEmail">Class Name</label>
                                                <input type="text" name="class_name" value="class1" value="" class="form-control"  >
                                                <label class="control-label" for="inputPassword">Section</label>
                                                <input type="text" class="span8 form-control" value="section" name="class_section"  required>
                                                <label for='teacher_ID'>Teacher</label>
                                                    <select name='teacher_ID' id="teacher_ID" class='custom-select'>
                                                        <option value='-1'>Select Teacher</option>
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
                                                <!-- <input type="hidden" name="school_id" value=".$row['id']." class="form-control form-control-lg"/> -->
                                                <!-- <label>
                                                    <input id="radio1" name="role" type="radio" checked="checked" value="school" ><label for=radio1> .</label><br>
                                                </label> -->
                                               
                                                <hr>	
                                                <button name="addNew_subject" type="submit" class="btn btn-info"><i class="icon-save"></i> Save</button>
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
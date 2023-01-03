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
                                    $subject_id = $_SESSION['current_subject'];
                                    $chapter_name = $_POST['chapter_name'];
                                    $chapter_number = $_POST['chapter_number'];
                                    // $section = $_POST['class_section'];
                                    // $school_id = $_POST['school_id'];
                                    
                                    $conn = $pdo->open();
                                
                                    
                                    try{
                                        
		                                $stmt = $conn->prepare("INSERT INTO sls_chapters (subject_id, chapter_name, chapter_number) VALUES (:subject_id, :chapter_name, :chapter_number)");
                                        $stmt->execute(['subject_id'=>$subject_id, 'chapter_name'=>$chapter_name, 'chapter_number'=>$chapter_number]);
                                        // $_SESSION['success'] = 'Product added successfully';
                                    
                                    }
                                    catch(PDOException $e){
                                        $_SESSION['error'] = $e->getMessage();
                                    }
                                    
                                    header('location: chapters.php');
                                    $pdo->close(); 
                                }
                                ?>
								 <script>
								// alert('Data Already Exist');
								// </script>
										
		                        <!-- block -->
		                        <div class="block">
		                            <div class="navbar navbar-inner block-header">
		                                <div class="muted pull-left">Add Chapters</div>
                                        
		                            </div>
                                    
		                            <div class="block-content collapse/* in*/">
									    <a href="chapters.php"><i class="icon-arrow-left"></i> Back</a>
									    <form action='' class="form-horizontal" method="post">
                                            <div class="control-group">
                                                <input type="hidden" name="subject_id" class="form-control form-control-lg"/>
                                                <label class="control-label">Chapter Name</label>
                                                <input type="text" name="chapter_name" value="" class="form-control"  >
                                                <label class="control-label">Chapter Number</label>
                                                <input type="text" name="chapter_number" value="" class="form-control"  >
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
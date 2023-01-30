<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>

<body>
<?php include('../includes/navbar.php'); ?>
<div class="container-fluid">
    <div class="row-fluid">
		<?php //include('subject_sidebar.php'); ?>

        <div class="span9" id="content">
            <?php
            if(isset($_SESSION['error'])){
              echo "
                <div class='alert alert-danger alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4><i class='icon fa fa-warning'></i> Error!</h4>
                  ".$_SESSION['error']."
                </div>
              ";
              unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])){
              echo "
                <div class='alert alert-success alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4><i class='icon fa fa-check'></i> Success!</h4>
                  ".$_SESSION['success']."
                </div>
              ";
              unset($_SESSION['success']);
            }
            // if (isset($class_subject_id)) {

              $conn = new PDO('mysql:host=localhost;dbname=sls', 'root', '');
              
              // $stmt = $conn->prepare(
              //       "SELECT sls_schools.id, sls_schools.firstname, 
              //       (SELECT COUNT(DISTINCT id) FROM sls_teachers WHERE sls_teachers.school_id = sls_schools.id) AS total_teachers, 
              //       (SELECT COUNT(sls_students.id) FROM sls_students WHERE sls_students.schoolID = sls_schools.id) AS total_students, 
              //       (SELECT COUNT(sls_classes.id) FROM sls_classes WHERE sls_classes.school_id = sls_schools.id) AS total_classes 
              //       FROM sls_schools GROUP BY sls_schools.id, sls_schools.firstname
              //       ");
                    

                    $stmt = $conn->prepare(
                      "SELECT sls_schools.*, 
                      COUNT(DISTINCT sls_students.id ) AS 'total_students', 
                      COUNT(DISTINCT sls_classes.id) AS 'total_classes', 
                      COUNT(DISTINCT sls_teachers.id) AS 'total_teachers'
                      FROM sls_schools 
                      LEFT JOIN sls_classes ON sls_schools.id = sls_classes.school_id 
                      LEFT JOIN sls_teachers ON sls_schools.id = sls_teachers.school_id 
                      LEFT JOIN sls_students ON sls_classes.id = sls_students.classID 
                      GROUP BY sls_schools.id                                 
                    ");
                  
           
              
            // $old_query = "SELECT sls_subjects.*, sls_teachers.teacher_name
            //   FROM sls_subjects
            //   LEFT JOIN sls_teachers
            //   ON sls_subjects.teacher_id = sls_teachers.id
            //   WHERE sls_subjects.class_id = $class_subject_id;
            //   ";
  
              $stmt->execute();
              $rows = $stmt->fetchAll();

            ?>
            <div class="row-fluid"><br>
		    <a href="add_schools.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Schools</a>
            <!-- block -->
            <div id="block_bg" class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Schools List</div>
                </div>
                <div class="block-content /*collapse in*/">
                    <div class="span12">
                        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                        
                            <!-- <a  id="delete_school" class="btn btn-danger" name="delete_school"><i class="icon-trash icon-large"></i>Delete</a> -->
                            <?php // include('delete_modal.php'); ?>
							<thead>
							  <tr>
								
								<th>School Name</th>
								<th>Classes</th>
								<th>Teachers</th>
								<th>Students</th>
								<th>Action</th>
							   </tr>
							</thead>
							<tbody>
								<?php
                    // $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // $stmt = $conn->prepare("SELECT * FROM sls_schools");
                    // $stmt->execute();
                    // $rows = $stmt-> fetchAll();
                    foreach($rows as $row){
                      $id = $row['id'];
                      // $class_name = $row['c_name'];
                      $schoolName = $row['firstname'];
                      // $studentName = $row['s_name'];
                      // $teacherName = $row['teacher_name'];
                      $total_classes = $row['total_classes'];
                      $total_students = $row['total_students'];
                      $total_teachers = $row['total_teachers'];
                        
                      if($total_classes == 0){
                        // $total_classes = "<span class='badge bg-danger text-white ms-2'>0</span>";
                        $total_classes_text = "<button  type='submit' class='btn btn-warning' value='$id' name='details_class_btn'> $total_classes</button>";
                      }
                      else{
                        // $total_classes = "<span class='badge bg-success text-white ms-2'>$total_classes </span>";
                        $total_classes_text = "<button  type='submit' class='btn btn-primary' value='$id' name='details_class_btn'> $total_classes</button>";
                      }

                    if($total_students == 0){
                        // $total_students = "<span class='badge bg-danger text-white ms-2'>0</span>";
                        $total_students_text = "<button  type='submit' class='btn btn-warning' value='$id' name='details_class_btn1'> $total_students</button>";
                      }
                      else{
                        // $total_students = "<span class='badge bg-success text-white ms-2'>$total_students </span>";
                        $total_students_text = "<button  type='submit' class='btn btn-primary' value='$id' name='details_class_btn1'> $total_students</button>";
                      } 
                    if($total_teachers == 0){
                        // $total_teachers = "<span class='badge bg-danger text-white ms-2'>0</span>";
                        $total_teachers_text = "<button  type='submit' class='btn btn-warning' value='$id' name='school_teachers_btn'> $total_teachers</button>";
                      }
                      else{
                        // $total_teachers = "<span class='badge bg-success text-white ms-2'>$total_teachers </span>";
                        $total_teachers_text = "<button  type='submit' class='btn btn-primary' value='$id' name='school_teachers_btn'> $total_teachers</button>";
                      } 
                      

                        echo " 
                            <tr> 
                              <td>$schoolName</td>
                              <td>
                              <form class='d-inline-block mb-0' action='classes.php' method='POST'>
                                <input type='hidden' name='school_name' value='$schoolName'>                                  
                                $total_classes_text
                              </form>
                              </td>
                              <td>
                              <form class='d-inline-block mb-0' action='teachers.php' method='POST'>
                                <input type='hidden' name='school_name' value='$schoolName'>                                  
                                $total_teachers_text
                              </form>
                              </td>
                              <td>
                              <form class='d-inline-block mb-0' action='school_students.php' method='POST'>
                                <input type='hidden' name='school_name' value='$schoolName'>                                  
                                $total_students_text
                              </form>
                              </td>
                              <td> 
                              
                              <form class='d-inline-block mb-0' action='delete_school.php' method='POST'>       
                                  <button  type='submit' class='btn btn-danger' value=". $row['id']." name='delete_school'><i class='bi bi-trash'></i></button>  
                              </form>
                              <form class='d-inline-block mb-0' action='edit_school.php' method='POST'>
                              <button  type='submit' class='btn btn-success' value=". $row['id']." name='edit_school'><i class='bi bi-pencil-square'></i></button>  
                              </form>
                              <!--<a href='edit_school.php?=".$row['id']."' class='btn btn-success'> Edit</a>-->
                              </td>
                            </tr>
                        ";
                    } 
                 ?>   
                                
						    </tbody>
                            
					</table>
                </div>
            </div>
        </div>
        </div>   
    </div>
         <!-- /block -->     
    </div>
<?php //include('footer.php'); ?>
</div>
<?php include('../includes/script.php'); ?>
</body>

</html>
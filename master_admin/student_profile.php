<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php
if (isset($_POST['details_studentProfile_btn'])) {

  $studentID = $_POST['details_studentProfile_btn'];
  $_SESSION['current_student'] = $_POST['details_studentProfile_btn'];
  $_SESSION['s_name'] = $_POST['s_name'];
  $studentName = $_SESSION['s_name'];
  $school_name = $_SESSION['school_name'];
  $class_name = $_SESSION['c_name'];
  
}
if (isset($_SESSION['current_student'])) {
  $studentID = $_SESSION['current_student'];
  $school_name = $_SESSION['school_name'];
  $class_name = $_SESSION['c_name'];
  $studentName = $_SESSION['s_name'];
}

?>

<body>
  <?php include('../includes/navbar.php'); ?>
  <div class="container-fluid">
    <div class="row-fluid">
      <?php //include('subject_sidebar.php'); 
      ?>

      <div class="span9" id="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
                <div class='alert alert-danger alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4><i class='icon fa fa-warning'></i> Error!</h4>
                  " . $_SESSION['error'] . "
                </div>
              ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
                <div class='alert alert-success alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4><i class='icon fa fa-check'></i> Success!</h4>
                  " . $_SESSION['success'] . "
                </div>
              ";
          unset($_SESSION['success']);
        }
        if (isset($studentID)) {
          $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare(
            "SELECT sls_students.*, sls_subjects.id AS subjectID, sls_subjects.subject_name, 
            (SELECT COUNT(id) FROM sls_chapters WHERE sls_subjects.id = sls_chapters.subject_id) AS total_chapters 
            FROM sls_students 
            LEFT JOIN sls_subjects 
            ON sls_students.classID = sls_subjects.class_id 
            LEFT JOIN sls_chapters 
            ON sls_chapters.subject_id = sls_subjects.id 
            WHERE sls_students.id=$studentID
            GROUP BY sls_subjects.id
              
              ");
          $stmt->execute();
          $rows = $stmt->fetchAll();
        ?>
        <div class="row-fluid"><br>
          <a href="students.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Back to Students</a>
          <!-- <a href="add_questions.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Question</a> -->
          <!-- block -->
          <div id="block_bg" class="block">
            <div class="navbar navbar-inner block-header">
              <?php echo $school_name . " > " ; echo $class_name. " > "; echo $studentName ?>
              <!-- <div class="muted pull-left">Subjects List</div> -->
            </div>
            <div class="block-content /*collapse in*/">
              <div class="span12">
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">

                  <!-- <a  id="delete_school" class="btn btn-danger" name="delete_school"><i class="icon-trash icon-large"></i>Delete</a> -->
                  <?php // include('delete_modal.php'); 
                  ?>
                  <thead>
                    <tr>
                      <th>Subject Name</th>
                      
                       <th>Chapters</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <?php
                    
                     
                      foreach ($rows as $row) {
                        $id = $row['id'];
                        $subjectName = $row['subject_name'];
                        // $chpaterName = $row['chapter_name'];
                        $total_chapters = $row['total_chapters'];
                        if($total_chapters == 0){
                          // $total_chapters = "<span class='badge bg-danger text-white ms-2'>0</span> Chapters &nbsp";
                          $total_chapters_text = "<button  type='submit' class='btn btn-warning' value='".$row['subjectID']."' name='std_profile_chapter_btn'> $total_chapters</button>";
                        }
                        else{
                          // $total_chapters = "<span class='badge bg-success text-white ms-2'>$total_chapters </span>  Chapters";
                          $total_chapters_text = "<button  type='submit' class='btn btn-primary' value='".$row['subjectID']."' name='std_profile_chapter_btn'> $total_chapters</button>";
                        }
                        echo " 
                          <tr>
                             
                            <td>$subjectName</td>

                            <td>
                              <form class='d-inline-block mb-0' action='student_chapter.php' method='POST'>
                                <input type='hidden' name='sbjName' value='$subjectName'> 
                                <input type='hidden' name='stdID' value=" .$row['id']. ">                                 
                                $total_chapters_text
                              </form>
                            </td>
                           
                                 
                          </tr>           
                                        
                                    
                        ";
                      }
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
    <?php //include('footer.php'); 
    ?>
  </div>
  <?php include('../includes/script.php'); ?>
</body>

</html>
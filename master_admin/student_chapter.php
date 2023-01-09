<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php
if (isset($_POST['std_profile_chapter_btn'])) {

    $current_std_chapter = $_POST['std_profile_chapter_btn'];
    $_SESSION['current_std_chapter'] = $_POST['std_profile_chapter_btn'];
    // $stdID = $_POST['stdID'];
    // $_SESSION['stdID'] = $_POST['stdID'];
    $studentName = $_SESSION['s_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['class_name'];
    $subject_name = $_SESSION['subject_name'];
    $chapter_name = $_SESSION['chapter_name'];
    $studentID = $_SESSION['current_student'];
  
}
if (isset($_SESSION['current_std_chapter'])) {
    $current_std_chapter = $_SESSION['current_std_chapter'];
    // $stdID = $_SESSION['stdID'];
    $subject_name = $_SESSION['subject_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['class_name'];
    $chapter_name = $_SESSION['chapter_name'];
    $studentName = $_SESSION['s_name'];
    $studentID = $_SESSION['current_student'];
//   $currenChapter_name = $_SESSION['s_name'];
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
        ?>
        <div class="row-fluid"><br>
          <a href="student_profile.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Back to Subjects</a>
          <!-- <a href="add_questions.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Question</a> -->
          <!-- block -->
          <div id="block_bg" class="block">
            <div class="navbar navbar-inner block-header">
              <?php echo $school_name . " > " ; echo $class_name. " > "; echo $studentName." > "  ; echo $subject_name?>
              <!-- <div class="muted pull-left">Subjects List</div> -->
            </div>
            <div class="block-content /*collapse in*/">
              <div class="span12">
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">

                  <!-- <a  id="delete_school" class="btn btn-danger" name="delete_school"><i class="icon-trash icon-large"></i>Delete</a> -->
                  <?php // include('delete_modal.php'); 
                  ?>
                  <!-- <thead>
                    <tr>
                      <th width=20%>Student Name</th>
                      <th></th>
                       <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead> -->
                  <tbody>
                    <div>
                        Chapters Name: 
                    </div>
                    <?php
                    if (isset($current_std_chapter)) {
                      $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $stmt = $conn->prepare("SELECT * FROM sls_chapters WHERE subject_id=$current_std_chapter");
                      $stmt->execute();
                      $rows = $stmt->fetchAll();
                      foreach ($rows as $row) {
                        
                        // $id = $row['id'];
                         
                        echo "  
                            <div>
                                ".$row['chapter_name']." 
                                <form action='student_question.php' method='POST'>
                                    <button   type='submit' class='btn btn-primary' value=".$row['id']." name='std_question_btn'>Questions</button>
                                </form> 
                            </div>          
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
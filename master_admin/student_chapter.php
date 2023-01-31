<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php
if (isset($_POST['std_profile_chapter_btn'])) {

    $current_std_chapter = $_POST['std_profile_chapter_btn'];
    $_SESSION['current_std_chapter'] = $_POST['std_profile_chapter_btn'];
    $stdID = $_POST['stdID'];
    $_SESSION['stdID'] = $_POST['stdID'];
    $sbjName = $_POST['sbjName'];
    $_SESSION['sbjName'] = $_POST['sbjName'];
    $studentName = $_SESSION['s_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['c_name'];
    // $subject_name = $_SESSION['subject_name'];
    // $studentID = $_SESSION['current_student'];
  
}
if (isset($_SESSION['current_std_chapter'])) {
    $current_std_chapter = $_SESSION['current_std_chapter'];
    $stdID = $_SESSION['stdID'];
    $sbjName = $_SESSION['sbjName'];
    // $subject_name = $_SESSION['subject_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['c_name'];
    $studentName = $_SESSION['s_name'];
    // $studentID = $_SESSION['current_student'];
    // $currenChapter_name = $_SESSION['s_name'];
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
        if (isset($current_std_chapter)) {
          $conn = new PDO('mysql:host=localhost;dbname=sls', 'root', '');
            $sql = 'SELECT * FROM sls_teachers';
            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $teachers_rows = $stmt->fetchAll();
            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
            }
            $teachers_selection =
                "<select name='teacher' class='custom-select'>";
            $teachers_selection =
                $teachers_selection .
                "<option value='-1'>Select Teacher</option>";
            foreach ($teachers_rows as $teacher_record) {
                $teachers_selection =
                    $teachers_selection .
                    "<option value='" .
                    $teacher_record['id'] .
                    "'>" .
                    $teacher_record['teacher_name'] .
                    '</option>';
            }
            $teachers_selection = $teachers_selection . '</select>';
            $stmt = $conn->prepare(
                  "SELECT sls_chapters.*, COUNT(sls_questions.id) AS total_questions 
                  FROM sls_chapters LEFT JOIN sls_questions 
                  ON sls_chapters.id = sls_questions.chapter_id 
                  WHERE sls_chapters.subject_id = $current_std_chapter 
                  GROUP BY sls_chapters.id;
                  "
            );
            $stmt->execute();
            $rows = $stmt->fetchAll();
        ?>
        <div class="row-fluid"><br>
          <a href="student_profile.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Back to Subjects</a>
          <!-- <a href="add_questions.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Question</a> -->
          <!-- block -->
          <div id="block_bg" class="block">
            <div class="navbar navbar-inner block-header">
              <?php echo $school_name . " > " ; echo $class_name. " > "; echo $studentName." > "  ; echo $sbjName?>
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
                      <th >Chapter Number</th>
                      <th >Chapter Name</th>
                      <th>Questions</th>
                      <th>Previous Exams</th>
                      
                      
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <div>
                        Chapters Name: 
                    </div> -->
                    <?php
                    // if (isset($current_std_chapter)) {
                    //   $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                    //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //   $stmt = $conn->prepare("SELECT * FROM sls_chapters WHERE subject_id=$current_std_chapter");
                      
                      foreach ($rows as $row) {
                        $id = $row['id'];
                        $chapterNumber = $row['chapter_number'];
                        $chapterName = $row['chapter_name'];
                        $total_questions = $row['total_questions'];
                        if($total_questions == 0){
                          // $total_questions = "<span class='badge bg-danger text-white ms-2'>0</span> Questions &nbsp";
                          $total_questions_text = "<button  type='submit' class='btn btn-warning' value='$id' name='std_question_btn'> $total_questions</button>";
                        }
                        else{
                          // $total_questions = "<span class='badge bg-success text-white ms-2'>$total_questions </span>  Questions";
                          $total_questions_text = "<button  type='submit' class='btn btn-primary' value='$id' name='std_question_btn'> $total_questions</button>";
                        }
                        echo "
                          <tr>
                            <td>
                              $chapterNumber
                            </td>
                            <td>
                              $chapterName
                            </td>
                            <td> 
                              <form class='d-inline-block mb-0' action='student_question.php' method='POST'>
                                <input type='hidden' name='chpName' value='$chapterName'>                                  
                                $total_questions_text
                              </form> 
                            </td>
                            <td>
                              <form class='d-inline-block mb-0' action='results_by_chpater.php' method='POST'>
                                <input type='hidden' name='chpName' value=" .$row['chapter_name']. ">
                                <button   type='submit' class='btn btn-primary' value='".$row['id']."' name='resultByChapter_btn'>Preveious Exams results</button>
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
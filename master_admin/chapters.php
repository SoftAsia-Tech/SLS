<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php
if (isset($_POST['details_subject_btn'])) {

  $subject_chapters_id = $_POST['details_subject_btn'];
  $_SESSION['current_subject'] = $_POST['details_subject_btn'];
  $_SESSION['subject_name'] = $_POST['subject_name'];
  $school_name = $_SESSION['school_name'];
  $class_name = $_SESSION['c_name'];
  $subject_name = $_POST['subject_name'];
  
}
if (isset($_SESSION['current_subject'])) {
  $subject_chapters_id = $_SESSION['current_subject'];
  $subject_name = $_SESSION['subject_name'];
  $school_name = $_SESSION['school_name'];
  $class_name = $_SESSION['c_name'];
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
        if (isset($subject_chapters_id)) {
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
                  WHERE sls_chapters.subject_id = $subject_chapters_id 
                  GROUP BY sls_chapters.id;
                  "
            );
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
          <a href="subjects.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Back to Subjects</a>
          <a href="add_chapters.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Chapters</a>
          <!-- block -->
          <div id="block_bg" class="block">
            <div class="navbar navbar-inner block-header">
              <?php echo $school_name." > ".$class_name." > ".$subject_name; ?>
              <!-- <div class="muted pull-left">Subjects List</div> -->
            </div>
            <div class="block-content /*collapse in*/">
              <div class="span12">
                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">

                  <!-- <a  id="delete_school" class="btn btn-danger" name="delete_school"><i class="icon-trash icon-large"></i>Delete</a> -->
                  <?php 
                    // include('delete_modal.php'); 
                  ?>
                  <thead>
                    <tr>

                      <th width="20%">Chapter Number</th>
                      <th>Chapter Name</th>
                      <th>Questions</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php
                    
                      // $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                      // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      // $stmt = $conn->prepare("SELECT * FROM sls_chapters WHERE subject_id=$subject_chapters_id");
                      // $stmt->execute();
                      // $rows = $stmt->fetchAll();
                      foreach ($rows as $row) {
                        $id = $row['id'];
                        $chapterNumber = $row['chapter_number'];
                        $chapterName = $row['chapter_name'];
                        $total_questions = $row['total_questions'];
                        if($total_questions == 0){
                          // $total_questions = "<span class='badge bg-danger text-white ms-2'>0</span> Questions &nbsp";
                          $total_questions_text = "<button  type='submit' class='btn btn-warning' value='$id' name='questions_chapterwise_btn'> $total_questions</button>";
                        }
                        else{
                          // $total_questions = "<span class='badge bg-success text-white ms-2'>$total_questions </span>  Questions";
                          $total_questions_text = "<button  type='submit' class='btn btn-primary' value='$id' name='questions_chapterwise_btn'> $total_questions</button>";
                        }
                        echo " 
                            <tr> 
                                <td> $chapterNumber</td>
                                <td> $chapterName</td>
                                
                                <td>
                                <form class='d-inline-block mb-0' action='questions.php' method='POST'>
                                  <input type='hidden' name='chapter_name' value='$chapterName'>                                  
                                  $total_questions_text
                                </form>
                                 
                                </td>
                                
                                <td> 
                                  
                                     <form class='d-inline-block mb-0'action='delete_chapter.php' method='POST'>       
                                        <button  type='submit' class='btn btn-danger' value=" . $row['id'] . " name='delete_chapter'><i class='bi bi-trash'></i></button>  
                                    </form>
                                    <form class='d-inline-block mb-0'action='edit_chapters.php' method='POST'>
                                        <button  type='submit' class='btn btn-success' value=" . $row['id'] . " name='edit_chapter'><i class='bi bi-pencil-square'></i></button>  
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
<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php
// if (isset($_POST['std_question_btn'])) {

//     $current_std_question = $_POST['std_question_btn'];
//     $_SESSION['current_std_question'] = $_POST['std_question_btn'];
//     // $_SESSION['s_name'] = $_POST['s_name'];
//     $studentName = $_SESSION['s_name'];
//     $school_name = $_SESSION['school_name'];
//     $class_name = $_SESSION['class_name'];
//     $subject_name = $_SESSION['subject_name'];
//     $chapter_name = $_SESSION['chapter_name'];
//     $studentID = $_SESSION['current_student'];
// }
// if (isset($_SESSION['current_std_question'])) {
//     $current_std_question = $_SESSION['current_std_question'];
//     $subject_name = $_SESSION['subject_name'];
//     $school_name = $_SESSION['school_name'];
//     $class_name = $_SESSION['class_name'];
//     $chapter_name = $_SESSION['chapter_name'];
//     $studentName = $_SESSION['s_name'];
//     $studentID = $_SESSION['current_student'];
//     $last_id = $_SESSION['current_examid'];
//     // $currenChapter_name = $_SESSION['s_name'];
// }

// if (isset($_SESSION['current_examid'])) {
//     $last_id = $_SESSION['current_examid'];
// }


if (isset($_POST['submit_answers'])) {
    $quastions_ids = $_POST['submit_answers'];
    $quastions_ids_array = explode(' ', $quastions_ids);
    array_shift($quastions_ids_array);
  
    // $quesionid = $_POST['questionid'];
    $studentID = $_SESSION['current_student'];
    $current_std_question = $_SESSION['current_std_question'];
    $chapterID = $current_std_question;
    $time = date('d-m-y h:i:s');
    // $studentAnswer = $_POST['answer'];
    // date_default_timezone_set('Pakistan/Islamabad');
    // $time = getdate();
    $conn = $pdo->open();
    $stmt = $conn->prepare("INSERT INTO sls_exams (student_id, chapter_id, exam_time	) VALUES (:student_id, :chapter_id, :exam_time)");
    $stmt->execute(['student_id' => $studentID, 'chapter_id' => $chapterID, 'exam_time'=>$time]);
    $last_id = $conn->lastInsertId();
    
    // $conn->lastInsertId();
    try {
      foreach ($quastions_ids_array as $quastion_id) {
        $current_ans = 'answer_' . $quastion_id;
        $answer = $_POST[$current_ans];
  
        $stmt = $conn->prepare("INSERT INTO sls_results (question_id, exam_id, student_answer) VALUES (:question_id, :exam_id, :student_answer)");
        $stmt->execute(['question_id' => $quastion_id, 'exam_id' => $last_id, 'student_answer' => $answer]);
      }
      
  
    } catch (PDOException $e) {
      $_SESSION['error'] = $e->getMessage();
    }
    
    $studentName = $_SESSION['s_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['class_name'];
    $subject_name = $_SESSION['subject_name'];
    $chapter_name = $_SESSION['chapter_name'];
    $studentID = $_SESSION['current_student'];
    // $last_id = $_SESSION['current_examid'];
    
    $pdo->close();
  }
  if (isset($_SESSION['submit_answers'])) {
    // $last_id = $_SESSION['current_examid'];
    $studentName = $_SESSION['s_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['class_name'];
    $subject_name = $_SESSION['subject_name'];
    $chapter_name = $_SESSION['chapter_name'];
    $studentID = $_SESSION['current_student'];
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
                    <a href="student_question.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Back to Exams</a>
                    <!-- <a href="add_questions.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Question</a> -->
                    <!-- block -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <?php echo $school_name . " > ";
                            echo $class_name . " > ";
                            echo $studentName . " > ";
                            echo $subject_name . " > ";
                            echo $chapter_name
                            ?>
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
                                          
                                            <th>Question</th>
                                            <th>Student Answer</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                <tbody>
                               <!-- <div>
                                Question: 
                                </div> -->
                                <!-- <form action='save_question_ans.php' method='POST'> -->
                                    <?php
                                    // if (isset($last_id)) {
                                        $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $stmt = $conn->prepare("SELECT sls_questions.id AS question_ID, sls_questions.chapter_id, sls_questions.question, sls_results.id AS results_ID, sls_results.exam_id, sls_results.student_answer FROM sls_questions INNER JOIN sls_results  ON sls_questions.id=sls_results.question_id WHERE exam_id=$last_id");
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll();
                                        // $total_quastions =  count($rows);
                                        // $quations_ids = "";
                                        foreach ($rows as $row) {                                                    
                                            // $id = $row['id'];
                                            // $str_id = strval($id);
                                            //  $quations_ids = $quations_ids.' '. $str_id ;
                                            echo "
                                             

                                            <tr>
                                                <td>
                                                    " . $row['question'] . " <br>
                                                    
                                                </td>
                                                <td>
                                                    
                                                    " . $row['student_answer'] . " <br>
                                                </td>
                                            </tr>  
                                             
                                            ";
                                                }
                                            // }
                                            ?>
                                            <!-- <button type='submit' class='btn btn-primary' value='<?php //echo $quations_ids; ?>' name='submit_answers'>Save</button> -->
                                        <!-- </form> -->
                                        <?php  //} 
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
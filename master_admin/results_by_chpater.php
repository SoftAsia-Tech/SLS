<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php

if (isset($_POST['resultByChapter_btn'])) {
    $chapterId = $_POST['resultByChapter_btn'];
    $_SESSION['current_chapterId'] = $_POST['resultByChapter_btn'];
    $chpName = $_POST['chpName'];
    $_SESSION['chpName'] = $_POST['chpName'];
    $studentName = $_SESSION['s_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['c_name'];
    $stdID = $_SESSION['stdID'];
    // $chpName = $_SESSION['chpName'];
    $sbjName = $_SESSION['sbjName'];

  }
if (isset($_SESSION['current_chapterId'])) {
    $chapterId = $_SESSION['current_chapterId'];
    $studentName = $_SESSION['s_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['c_name'];
    $stdID = $_SESSION['stdID'];
    $chpName = $_SESSION['chpName'];
    $sbjName = $_SESSION['sbjName'];
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
                    <a href="student_chapter.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Back to Chapters</a>
                    <!-- <a href="add_questions.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Question</a> -->
                    <!-- block -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <?php echo $school_name . " > ";
                            echo $class_name . " > ";
                            echo $studentName . " > ";
                            echo $sbjName . " > ";
                            echo $chpName . " > ";
                            echo "Previous Results";
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
                                            <th width=20%>Exam No</th>
                                            
                                            <th>Question</th>
                                            <th>Student Answer</th>
                                            <th width=20%>Exam Time</th>
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
                                        $stmt = $conn->prepare("SELECT sls_exams.id AS examid, sls_exams.student_id, sls_exams.chapter_id AS examChapterid, sls_exams.exam_time, sls_results.id AS resultsid, sls_results.exam_id, sls_results.question_id,sls_results.student_answer, sls_questions.id AS questionid, sls_questions.question FROM sls_exams INNER JOIN sls_results ON sls_exams.id=sls_results.exam_id INNER JOIN sls_questions ON sls_results.question_id=sls_questions.id WHERE student_id=$stdID AND sls_exams.chapter_id=$chapterId ORDER BY sls_exams.id");
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
                                                ".$row['examid']."<br>
                                                
                                                </td>
                                               
                                                
                                                <td>
                                                    ".$row['question']."
                                                </td>
                                                <td>
                                                    ".$row['student_answer']."
                                                </td>
                                                 <td>
                                                ".$row['exam_time']."
                                                </td>
                                                <td>
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
                                        <!-- <div class='container shadow '>
                                            <div class='row'>
                                              <div class='col-sm'>
                                                One of three columns
                                              </div>
                                              <div class='col-sm'>
                                                One of three columns
                                              </div>
                                              <div class='col-sm'>
                                                One of three columns
                                              </div>
                                            </div>
                                        </div> -->
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
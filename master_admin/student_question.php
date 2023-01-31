<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php
if (isset($_POST['std_question_btn'])) {

    $current_std_question = $_POST['std_question_btn'];
    $_SESSION['current_std_question'] = $_POST['std_question_btn'];
    $chpName = $_POST['chpName'];
    $_SESSION['chpName'] = $_POST['chpName'];
    // $sbjName = $_POST['sbjName'];
    // $_SESSION['sbjName'] = $_POST['sbjName'];
    // $_SESSION['s_name'] = $_POST['s_name'];
    // $cahpterID = $_SESSION['current_chapter'];
    $stdID = $_SESSION['stdID'];
    $sbjName = $_SESSION['sbjName'];
    $studentName = $_SESSION['s_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['c_name'];
    // $subject_name = $_SESSION['subject_name'];
    // $chapter_name = $_SESSION['chapter_name'];
    // $studentID = $_SESSION['current_student'];
}
if (isset($_SESSION['current_std_question'])) {
    $current_std_question = $_SESSION['current_std_question'];
    $stdID = $_SESSION['stdID'];
    $chpName = $_SESSION['chpName'];
    $sbjName = $_SESSION['sbjName'];
    $chapterID = $current_std_question;
    // $subject_name = $_SESSION['subject_name'];
    $school_name = $_SESSION['school_name'];
    $class_name = $_SESSION['c_name'];
    // $chapter_name = $_SESSION['chapter_name'];
    $studentName = $_SESSION['s_name'];
    // $studentID = $_SESSION['current_student'];
    // $cahpterID = $_SESSION['current_chapter'];
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
                            echo $chpName
                            ?>
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
                                        <!-- <div>
                            Question: 
                        </div> -->
                                        <form action='student_result.php' method='POST'>
                                            <?php
                                            if (isset($current_std_question)) {
                                                $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                $stmt = $conn->prepare("SELECT * FROM sls_questions WHERE chapter_id=$current_std_question");
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();
                                                $total_quastions =  count($rows);
                                                $quations_ids = "";
                                                foreach ($rows as $row) {                                                    
                                                    $id = $row['id'];
                                                    $str_id = strval($id);
                                                     $quations_ids = $quations_ids.' '. $str_id ;

                                                    echo "
                                <div>

                                </div> 
                                
                                <div>
                                <b>" . $row['question_number'] . ". " . $row['question'] . "</b> <br>
                                    <input type='hidden' value='question_" . $row['id'] . "' name='question_" . $row['id'] . "'>
                                   (a) <input type='radio'  checked='checked' value='a' name='answer_" . $row['id'] . "'> <label for='ans1'>" . $row['option1'] . "</label> <br>
                                   (b) <input type='radio'  value='b' name='answer_" . $row['id'] . "'> <label for='ans2'>" . $row['option2'] . "</label><br>
                                   (c) <input type='radio'  value='c' name='answer_" . $row['id'] . "'> <label for='ans3'>" . $row['option3'] . "</label><br>
                                   (d) <input type='radio'  value='d' name='answer_" . $row['id'] . "'> <label for='ans4'>" . $row['option4'] . "</label>

                                </div>  
                                             
                            ";
                                                }
                                            }
                                            ?>
                                            <button type='submit' class='btn btn-primary' value='<?php echo $quations_ids; ?>' name='submit_answers'>Save</button>
                                        </form>
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
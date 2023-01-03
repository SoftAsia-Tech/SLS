<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php
if (isset($_POST['questions_chapterwise_btn'])) {

  $chapter_question_id = $_POST['questions_chapterwise_btn'];
  $_SESSION['current_chapter'] = $_POST['questions_chapterwise_btn'];
  $_SESSION['chapter_name'] = $_POST['chapter_name'];
  $school_name = $_SESSION['school_name'];
  $class_name = $_SESSION['class_name'];
  $subject_name = $_SESSION['subject_name'];
  $chapter_name = $_POST['chapter_name'];
  
}
if (isset($_SESSION['current_chapter'])) {
  $chapter_question_id = $_SESSION['current_chapter'];
  $subject_name = $_SESSION['subject_name'];
  $school_name = $_SESSION['school_name'];
  $class_name = $_SESSION['class_name'];
  $chapter_name = $_SESSION['chapter_name'];
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
          <a href="chapters.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Back to Chapters</a>
          <a href="add_questions.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Question</a>
          <!-- block -->
          <div id="block_bg" class="block">
            <div class="navbar navbar-inner block-header">
              <?php echo $school_name . " > " ; echo $class_name . " > " ; echo $subject_name . " > " ; echo $chapter_name; ?>
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

                      <th width=20%>Question Number</th>
                      <th>Qusetion</th>
                      <!-- <th>Email</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php
                    if (isset($chapter_question_id)) {
                      $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $stmt = $conn->prepare("SELECT * FROM sls_questions WHERE chapter_id=$chapter_question_id");
                      $stmt->execute();
                      $rows = $stmt->fetchAll();
                      foreach ($rows as $row) {
                        // foreach($stmt as
                        // $subject_query = mysqli_query($conn,"select * from subject")or die(mysqli_error());
                        // $sql = "SELECT id, firstname, lastname FROM MyGuests";
                        // $result = mysqli_query($conn, $sql);
                        // while($row = mysqli_fetch_array($subject_query)){
                        $id = $row['id'];
                        // var_dump( $id); 
                        echo " 
                                    <tr> 
                                        <td width=20%>" . $row['question_number'] . "</td>
                                        <td>
                                        " . $row['question'] . "<br>
                                        <input type='radio'> </input>" . $row['option1'] . "<br>
                                        <input type='radio'> </input>" . $row['option2'] . "<br>
                                        <input type='radio'> </input>" . $row['option3'] . "<br>
                                        <input type='radio'> </input>" . $row['option4'] . "<br>
                                        </td>
                                        
                                        <td> 
                                           <!--<form action='questions.php' method='POST'>
                                              <button  type='submit' class='btn btn-primary' value=" . $row['id'] . " name='questions_chapterwise_btn'>Questions</button>
                                            </form>-->
                                             <form action='delete_question.php' method='POST'>       
                                                <button  type='submit' class='btn btn-danger' value=" . $row['id'] . " name='delete_question'>Delete</button>  
                                            </form>
                                            <form action='edit_question.php' method='POST'>
                                                <button  type='submit' class='btn btn-success' value=" . $row['id'] . " name='edit_question'>Edit</button>  
                                            </form>
                                            <!--<a href='edit_school.php?=" . $row['id'] . "' class='btn btn-success'> Edit</a>-->
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
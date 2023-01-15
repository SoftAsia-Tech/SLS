<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php
if (isset($_POST['details_subject_btn'])) {

  $subject_chapters_id = $_POST['details_subject_btn'];
  $_SESSION['current_subject'] = $_POST['details_subject_btn'];
  $_SESSION['subject_name'] = $_POST['subject_name'];
  $school_name = $_SESSION['school_name'];
  $class_name = $_SESSION['class_name'];
  $subject_name = $_POST['subject_name'];
  
}
if (isset($_SESSION['current_subject'])) {
  $subject_chapters_id = $_SESSION['current_subject'];
  $subject_name = $_SESSION['subject_name'];
  $school_name = $_SESSION['school_name'];
  $class_name = $_SESSION['class_name'];
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
                      <!-- <th>Email</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php
                    if (isset($subject_chapters_id)) {
                      $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $stmt = $conn->prepare("SELECT * FROM sls_chapters WHERE subject_id=$subject_chapters_id");
                      $stmt->execute();
                      $rows = $stmt->fetchAll();
                      foreach ($rows as $row) {
                        $id = $row['id'];
                        echo " 
                                    <tr> 
                                        <td width=20%>" . $row['chapter_number'] . "</td>
                                        <td>" . $row['chapter_name'] . "</td>
                                        
                                        <td> 
                                           <form action='questions.php' method='POST'>
                                              <input type='hidden' name='chapter_name' value=" . $row['chapter_name'] . ">
                                              <button  type='submit' class='btn btn-primary' value=" . $row['id'] . " name='questions_chapterwise_btn'>Questions</button>
                                            </form>
                                             <form action='delete_chapter.php' method='POST'>       
                                                <button  type='submit' class='btn btn-danger' value=" . $row['id'] . " name='delete_chapter'>Delete</button>  
                                            </form>
                                            <form action='edit_chapters.php' method='POST'>
                                                <button  type='submit' class='btn btn-success' value=" . $row['id'] . " name='edit_chapter'>Edit</button>  
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
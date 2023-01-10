<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>
<?php
if (isset($_POST['details_class_btn'])) {

  $class_subject_id = $_POST['details_class_btn'];
  $_SESSION['current_class'] = $_POST['details_class_btn'];
  $_SESSION['class_name'] = $_POST['class_name'];
  $school_name = $_SESSION['school_name'];
  $class_name = $_POST['class_name'];
  
}
if (isset($_SESSION['current_class'])) {
  $class_subject_id = $_SESSION['current_class'];
  $class_name = $_SESSION['class_name'];
  $school_name = $_SESSION['school_name'];
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
          <a href="classes.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Back to Classes</a>
          <a href="add_subjects.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Subjects</a>
          <!-- block -->
          <div id="block_bg" class="block">
            <div class="navbar navbar-inner block-header">
              <?php echo "".$school_name. " > ".$class_name; ?>
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
                      <!-- <th>Email</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php
                    if (isset($class_subject_id)) {
                      $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $stmt = $conn->prepare("SELECT * FROM sls_subjects WHERE class_id=$class_subject_id");
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
                                        <td>" . $row['subject_name'] . "</td>
                                        
                                        <td> 
                                            <form action='chapters.php' method='POST'>
                                              <input type='hidden' name='subject_name' value=" . $row['subject_name'] . ">
                                              <button  type='submit' class='btn btn-primary' value=" . $row['id'] . " name='details_subject_btn'>Chaptes</button>
                                            </form> 
                                             
                                             <form action='delete_subject.php' method='POST'>       
                                                <button  type='submit' class='btn btn-danger' value=" . $row['id'] . " name='delete_subject'>Delete</button>  
                                            </form>
                                            <form action='edit_subject.php' method='POST'>
                                            <button  type='submit' class='btn btn-success' value=" . $row['id'] . " name='edit_subject'>Edit</button>  
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
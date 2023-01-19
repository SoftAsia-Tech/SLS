<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>

<?php
if (isset($_POST['details_class_btn'])) {
    $school_class_id = $_POST['details_class_btn'];
    $_SESSION['current_school'] = $_POST['details_class_btn'];
    $_SESSION['school_name'] = $_POST['school_name'];
    $school_name = $_POST['school_name'];
}
if (isset($_SESSION['current_school'])) {
    $school_class_id = $_SESSION['current_school'];
    $school_name = $_SESSION['school_name'];
}
$conn = new PDO('mysql:host=localhost;dbname=sls', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare('SELECT * FROM sls_teachers');
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
    $teacherid = $row['id'];
    $_SESSION['teacherid'] = $row['id'];
    $teachername = $row['teacher_name'];
    $_SESSION['teacher_name'] = $row['teacher_name'];
}
?>

<body>
    <?php include('../includes/navbar.php'); ?>

    <?php
    // if(isset($_POST['details_school_btn'])){
    //     $_SESSION['current_school'] = $_POST['details_school_btn'];

    // }
    ?>
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
                if (isset($school_class_id)) {
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
                        "SELECT sls_classes.*, sls_teachers.teacher_name, 
                        (SELECT COUNT(id) FROM sls_subjects WHERE sls_subjects.class_id = sls_classes.id) AS total_subjects, 
                        (SELECT COUNT(id) FROM sls_students WHERE sls_students.classID = sls_classes.id) AS total_students
                        FROM sls_classes
                        LEFT JOIN sls_teachers
                        ON sls_classes.teacher_id = sls_teachers.id
                        WHERE sls_classes.school_id = $school_class_id
                        GROUP BY sls_classes.id;
                        "
                    );
                    // $std_query = (
                    //     "SELECT sls_classes.*, COUNT(sls_students.id) AS total_students
                    //     FROM sls_classes
                    //     LEFT JOIN sls_students
                    //     ON sls_classes.id = sls_students.classID
                    //     WHERE sls_classes.school_id = $school_class_id
                    //     GROUP BY sls_classes.id
                    //     "
                    // );
                    $old_query = "SELECT sls_classes.*, sls_teachers.teacher_name
                    FROM sls_classes
                    LEFT JOIN sls_teachers
                    ON sls_classes.teacher_id = sls_teachers.id
                    WHERE sls_classes.school_id = $school_class_id;
                    ";

                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                ?>
                <div class="row-fluid"><br>
                    <a href="schools.php" value="" class="btn btn-info"> Back to Schools</a>
                    <a href="add_classes.php" value="" class="btn btn-info"> Add Classes</a>
                    <!-- block -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <?php echo $school_name; ?>
                            <!-- <div class="muted pull-left">Class List</div> -->
                        </div>
                        <div class="block-content /*collapse in*/">
                            <div class="span12">
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                                    <thead>
                                        <tr>
                                            <th>Class Name</th>
                                            <th>Teacher Detail</th>
                                            <th>Subjects</th>
                                            <th>Students</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        // if (isset($school_class_id)) {
                                        //     $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                                        //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        //     $stmt = $conn->prepare("SELECT * FROM sls_classes WHERE school_id=$school_class_id");
                                        //     $stmt->execute();
                                        //     $rows = $stmt->fetchAll();
                                            foreach ($rows as $row) {
                                                $id = $row['id'];
                                                $class_name = $row['c_name'];
                                                $total_subjects = $row['total_subjects'];
                                                $total_students = $row['total_students'];
                                                
                                                if($total_subjects == 0){
                                                    $total_subjects = "<span class='badge bg-danger text-white ms-2'>0</span> Subjects &nbsp";
                                                    $total_subjects_text = "<button  type='submit' class='btn btn-warning' value='$id' name='details_class_btn'> $total_subjects</button>";
                                                  }
                                                  else{
                                                    $total_subjects = "<span class='badge bg-success text-white ms-2'>$total_subjects </span>  Subjects";
                                                    $total_subjects_text = "<button  type='submit' class='btn btn-primary' value='$id' name='details_class_btn'> $total_subjects</button>";
                                                  }

                                                if($total_students == 0){
                                                    $total_students = "<span class='badge bg-danger text-white ms-2'>0</span> Students &nbsp";
                                                    $total_students_text = "<button  type='submit' class='btn btn-warning' value='$id' name='details_class_btn12'> $total_students</button>";
                                                  }
                                                  else{
                                                    $total_students = "<span class='badge bg-success text-white ms-2'>$total_students </span>  Students";
                                                    $total_students_text = "<button  type='submit' class='btn btn-primary' value='$id' name='details_class_btn12'> $total_students</button>";
                                                  }
                                                  $teacher_details = "<form class='form-inline mb-0'  action='edit_class.php' method='POST'>
                                                      <button type='submit' class='d-inline-block btn btn-warning' value='$id' name='edit_class'>Add Teacher</button>
                                                    </form>";
                                                  if (!is_null($row['teacher_name'])) {
                                                      $teacher_details = $row['teacher_name'];
                                                  }
                                                echo " 
                                            <tr> 
                                                    <td>$class_name</td>
                                                    <td>$teacher_details</td>
                                                    <td>
                                                    <form class='d-inline-block mb-0' action='subjects.php' method='POST'>
                                                        <input type='hidden' name='c_name' value='$class_name'>                                  
                                                        $total_subjects_text
                                                    </form>
                                                    </td>
                                                    <td>
                                                    <form class='d-inline-block mb-0' action='students.php' method='POST'>
                                                        <input type='hidden' name='c_name' value='$class_name'>                                  
                                                        $total_students_text
                                                    </form>
                                                    </td>                                                    
                                                    <td>
                                                    <form class='d-inline-block mb-0' action='delete_class.php' method='POST'>       
                                                        <button  type='submit' class='btn btn-danger' value=" . $row['id'] . " name='delete_class'><i class='bi bi-trash'></i></button>  
                                                    </form>

                                                    <form class='d-inline-block mb-0' action='edit_class.php' method='POST'>
                                                        <button  type='submit' class='btn btn-success' value=" . $row['id'] . " name='edit_class'><i class='bi bi-pencil-square'></i></button>  
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
<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>

<?php
if (isset($_POST['details_school_btn'])) {
    $school_class_id = $_POST['details_school_btn'];
    $_SESSION['current_school'] = $_POST['details_school_btn'];
    $_SESSION['school_name'] = $_POST['school_name'];
    $school_name = $_POST['school_name'];
}
if (isset($_SESSION['current_school'])) {
    $school_class_id = $_SESSION['current_school'];
    $school_name = $_SESSION['school_name'];
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
                                            <th>Section</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        if (isset($school_class_id)) {
                                            $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $stmt = $conn->prepare("SELECT * FROM sls_classes WHERE school_id=$school_class_id");
                                            $stmt->execute();
                                            $rows = $stmt->fetchAll();
                                            foreach ($rows as $row) {

                                                $id = $row['id'];

                                                echo " 
                                            <tr> 
                                                    <td>" . $row['c_name'] . "</td>
                                                    <td>" . $row['c_section'] . "</td>
                                                    <td width='30'>
                                                    </td>
                                                    <td> 
                                                        <form action='subjects.php' method='POST'>

                                                            <input type='hidden' name='class_name' value=" . $row['c_name'] . ">
                                                            <button  type='submit' class='btn btn-primary' value=" . $row['id'] . " name='details_class_btn'>Subjects</button>
                                                        </form>
                                                        <form action='students.php' method='POST'>
                                                        
                                                            <input type='hidden' name='class_name1' value=" . $row['c_name'] . ">
                                                            <button  type='submit' class='btn btn-primary' value=" . $row['id'] . " name='details_class_btn1'>Students</button>
                                                        </form>
                                                         <form action='delete_class.php' method='POST'>       
                                                            <button  type='submit' class='btn btn-danger' value=" . $row['id'] . " name='delete_class'>Delete</button>  
                                                        </form>

                                                        <form action='edit_class.php' method='POST'>
                                                            <button  type='submit' class='btn btn-success' value=" . $row['id'] . " name='edit_school'>Edit</button>  
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
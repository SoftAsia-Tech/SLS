<?php include('../includes/header.php'); ?>
<?php include('../includes/session.php'); ?>

<body>
<?php include('../includes/navbar.php'); ?>
<div class="container-fluid">
    <div class="row-fluid">
		<?php //include('subject_sidebar.php'); ?>

        <div class="span9" id="content">
            <?php
            if(isset($_SESSION['error'])){
              echo "
                <div class='alert alert-danger alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4><i class='icon fa fa-warning'></i> Error!</h4>
                  ".$_SESSION['error']."
                </div>
              ";
              unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])){
              echo "
                <div class='alert alert-success alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4><i class='icon fa fa-check'></i> Success!</h4>
                  ".$_SESSION['success']."
                </div>
              ";
              unset($_SESSION['success']);
            }
            ?>
            <div class="row-fluid"><br>
		    <a href="add_schools.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Schools</a>
            <!-- block -->
            <div id="block_bg" class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Schools List</div>
                </div>
                <div class="block-content /*collapse in*/">
                    <div class="span12">
                        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                        
                            <!-- <a  id="delete_school" class="btn btn-danger" name="delete_school"><i class="icon-trash icon-large"></i>Delete</a> -->
                            <?php // include('delete_modal.php'); ?>
							<thead>
							  <tr>
								
								<th>School Name</th>
								<th>Email</th>
								<th>Action</th>
							   </tr>
							</thead>
							<tbody>
								<?php
                    $conn = new PDO("mysql:host=localhost;dbname=sls", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT * FROM sls_schools");
                    $stmt->execute();
                    $rows = $stmt-> fetchAll();
                    foreach($rows as $row){
                    // foreach($stmt as
                        // $subject_query = mysqli_query($conn,"select * from subject")or die(mysqli_error());
                        // $sql = "SELECT id, firstname, lastname FROM MyGuests";
                        // $result = mysqli_query($conn, $sql);
                        // while($row = mysqli_fetch_array($subject_query)){
                        $id = $row['id'];
                        // var_dump( $id); 
                        echo " 
                            <tr> 
                                    <td>".$row['firstname']."</td>
                                    <td>".$row['email']."</td>
                                    <td width='30'>
                                    </td>
                                    <td> 
                                        <form action='classes.php' method='POST'>
                                          <input type='hidden' name='school_name' value=".$row['firstname'].">
                                          <button  type='submit' class='btn btn-primary' value=". $row['id']." name='details_school_btn'>Classes</button>  
                                        </form>
                                        <form action='delete_school.php' method='POST'>       
                                            <button  type='submit' class='btn btn-danger' value=". $row['id']." name='delete_school'>Delete</button>  
                                        </form>
                                        <form action='edit_school.php' method='POST'>
                                        <button  type='submit' class='btn btn-success' value=". $row['id']." name='edit_school'>Edit</button>  
                                        </form>
                                        <!--<a href='edit_school.php?=".$row['id']."' class='btn btn-success'> Edit</a>-->
                                    </td>
                            </tr>
                        ";
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
<?php //include('footer.php'); ?>
</div>
<?php include('../includes/script.php'); ?>
</body>

</html>
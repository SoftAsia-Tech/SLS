<?php include 'includes/session.php';?>
<?php include 'includes/header.php';?>
<?php
  
  if(isset($_SESSION['master_admin'])){
    header('location: master_admin/madmin_dashboard.php');
  }
  if(isset($_SESSION['student'])){
    header('location: student/student_dashboard.php');
  }
  if(isset($_SESSION['teacher'])){
    // header('location: index.php');
    header('location:  teacher/teacher_dashboard.php');
  }
  if(isset($_SESSION['school'])){
    // header('location: index.php');
    header('location:  school/school_dashboard.php');
  }
  if(isset($_SESSION['principal'])){
    // header('location: index.php');
    header('location:  principal/principal_dashboard.php');
  }
  if(isset($_SESSION['parent'])){
    // header('location: index.php');
    header('location:  parent/parent_dashboard.php');
  }
?>
<body>
<?php
      if(isset($_SESSION['error'])){
        echo"
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
<section class=" gradient-custom">
  <div class="container py-5 ">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5 ">
        <div class="card card-custom-bg text-white" style="border-radius: 1rem;">
          <div class="card-body p-5">
            <div class="mb-md-5 mt-md-4 pb-5">
              <h3 class=" mb-2  text-center text-primary">Smart Learning System</h3>
              <p class="text-dark mb-5 fw-bold text-center">Login</p>
              <form action="login.php" method="POST">
                <div class="form-outline form-white mb-4">
                  <label class="form-label text-dark" for="typeEmailX" >Email</label>
                  <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" />
                  <label class="form-label text-dark" for="typePasswordX">Password</label>
                  <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg"/><hr>
                  <p class=""><a class="text-primary" href="#!">Forgot password?</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary btn-lg px-5" name="login" type="submit">Login</button></p>
                  <p class="mb-0 text-dark">Don't have an account? <a href="register.php" class="text-primary">Register</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
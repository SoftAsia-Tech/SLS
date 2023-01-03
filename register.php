
<?php include 'includes/header.php';?>
<body class=" gradient-custom">
<section >
  <div class="container py-5 ">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5 ">
        <div class="card card-custom-bg text-white" style="border-radius: 1rem;">
          <div class="card-body ">
            <div class="mb-md-5 mt-md-4 ">

              <h3 class="mb-2  text-center text-primary">Smart Learning System</h3>
              <p class="text-dark mb-5 fw-bold text-center"></p>
              <form action="register.php" method="POST">
                <div class="form-outline form-white mb-4">
                    <a href="student_signup.php" class="btn btn-primary btn-block">Register as Student</a>
                    <a href="principal_signup.php" class="btn btn-primary btn-block">Register as Principal</a>
                    <a href="teacher_signup.php" class="btn btn-primary btn-block">Register as Teacher</a>
                    <!-- <a href="school_signup.php" class="btn btn-primary btn-block">Register as School</a> -->
                    <a href="parent_signup.php" class="btn btn-primary btn-block">Register as Parent</a>
                    <!-- <button class="btn btn-primary btn-block btn-lg px-5">Register as Student</button> -->
                    
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
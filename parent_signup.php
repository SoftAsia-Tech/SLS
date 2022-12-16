
<?php include 'includes/header.php';?>
<section class=" gradient-custom">
  <div class="container py-5 ">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5 ">
        <div class="card card-custom-bg text-white" style="border-radius: 1rem;">
          <div class="card-body ">
            <div class="mb-md-5 mt-md-4 ">

              <h3 class=" mb-2  text-center text-primary">Smart Learning System</h3>
              <p class="text-dark mb-5 fw-bold text-center">Parent Registeration</p>
              <form action="parent_registeration.php" method="POST">
                <div class="form-outline form-white mb-4">
                  <input type="hidden" name="id" class="form-control form-control-lg"/>
                  <label class="form-label text-dark" for="typefirstnameX" >First Name</label>
                  <input type="text" name="firstname" id="typefirstnameX" class="form-control form-control-lg"/>
                  <label class="form-label text-dark" for="typelastnameX" >Last Name</label>
                  <input type="text" name="lastname" id="typelastnameX" class="form-control form-control-lg" />
                  <label class="form-label text-dark" for="typeEmailX" >Email</label>
                  <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg"/>
                  <label class="form-label text-dark" for="typePasswordX">Password</label>
                  <input type="password"  name="password" id="typePasswordX" class="form-control form-control-lg"/><hr>
                  <input id="radio1" name="role" type="radio" checked="checked" value="parent" ><label for=radio1> .</label><br>
                  <button class="btn btn-primary btn-lg px-5" type="submit" name="signup">Sign Up</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
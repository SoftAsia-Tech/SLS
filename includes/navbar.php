<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white" href="index.php">Smart Learning System</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        
      </li>
      <li class="nav-item">
       
      </li>
      <li class="nav-item">
        
      </li>
      
    </ul>
    <?php
            if(isset($_SESSION['student'])){
              $image = (!empty($student['image'])) ? '../images/'.$student['image'] : '../images/profile.jpeg';
              echo '
              
              <a href="logout.php" class="btn btn-primary">Logout</a>
              
              <a href="#" class="" >
                <img src="'.$image.'" class="user-image img-circle" width="40" height="40">
              </a>
              
              ';
            }
            else{
              echo "
              <a href='signin.php' class='btn btn-primary'>Log In</a>
              <a href='register.php' class='btn btn-primary'>Join Us</a>
              ";
            }
          ?>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white" href="index.php">Smart Learning System</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link" href="#">Link</a> -->
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link disabled" href="#">Disabled</a> -->
      </li>
      <?php
            if(isset($_SESSION['student'])){
              $image = (!empty($student['image'])) ? 'images/'.$student['image'] : 'images/profile.jpeg';
              echo '
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="'.$image.'" class="user-image" alt="User Image">
                    <span class="hidden-xs">'.$user['firstname'].' </span>
                  </a>
                </li>
              ';
            }
            else{
              echo "
              <a href='signin.php' class='btn btn-primary'>Log In</a>
              <a href='register.php' class='btn btn-primary'>Join Us</a>
              ";
            }
          ?>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
    </form> -->
  </div>
</nav>
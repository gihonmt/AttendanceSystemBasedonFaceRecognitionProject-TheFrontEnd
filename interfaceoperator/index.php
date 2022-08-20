<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">

    <title>Login Operator</title>
  </head>
  <body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
      <div class="container">
        <div class="card loginop-card">
          <div class="row no-gutters">
            <div class="col-md-6">
              <div class="card-body">
                <div class="loginop-logo">
                  <img src="image/logologin.svg" alt="logo" class="logo">
                </div>
                <p class="loginop-card-description1">Sign In</p>
                <p class="loginop-card-description2">Sign in to continue to our aplication</p>
                <?php
                  if(isset($_GET['error'])){
                    if($_GET['error']=="username"){
                      echo "<div class='error'>Failed to login! Username did not match.</div>";
                    } else {
                      echo "<div class='error'>Failed to login! Password did not match.</div>";
                    }
                  }
                ?>
                <form class="form-signin" method="POST" action="validasi_login.php">
                  <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <div class="input-group">
                      <input type="text" name="username" class="form-control" placeholder="Username">
                      <span class="input-group-append">
                        <div class="input-group-text bg-transparent border-0"><i class="fa fa-user"></i></div>
                      </span>
                    </div>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" placeholder="Password">
                      <span class="input-group-append">
                        <div class="input-group-text bg-transparent border-0"><i class="fa fa-lock"></i></div>
                      </span>
                    </div>
                  </div>
                  <input name="signin" id="signin" class="btn btn-block login-btn mb-4" type="submit" value="Sign In">
                </form>
              </div>
            </div>
            <div class="col-md-6">
              <img src="image/loginop.jpg" alt="style" class="loginop-card-img">
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  </body>
</html>
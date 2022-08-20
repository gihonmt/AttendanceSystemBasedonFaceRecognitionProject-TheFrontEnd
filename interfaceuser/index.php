<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="CSS/style.css">

        <title>Login User</title>
    </head>
    <body>
        <div class="container-loginuser">
            <div class="forms-container">
                <form class="form-login" method="POST" action="validasi_login.php">
                    <div class="loginuser-logo">
                        <img src="image/logologin.svg" alt="logo" class="logo">
                    </div>
                    <?php
                        if(isset($_GET['error'])){
                            if($_GET['error']=="username"){
                                echo "<div class='error'>Failed to login! Username did not match.</div>";
                            } else {
                                echo "<div class='error'>Failed to login! Password did not match.</div>";
                            }
                        }
                    ?>
                    <div class="form-group">
                        <label for="username" class="sr-only">Username</label>
                        <div class="input-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password" class="sr-only">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                        </div>
                    </div>
                    <input name="login" id="login" class="login-btn" type="submit" value="Login">
                </form>

                <form class="form-help" method="POST" action="help.php">
                    <p class="loginuser-card-description">Have a problem? Click here!</p>
                    <input name="help" id="help" class="help-btn" type="submit" value="Help">
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>
</html>

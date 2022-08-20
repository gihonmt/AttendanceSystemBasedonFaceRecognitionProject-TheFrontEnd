<?php
    session_start();
    if (empty($_SESSION['ID'])){
        echo "<script>alert('You must login first to access this page, thank you.');document.location='index.php'</script>";
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="CSS/profile.css">

        <title>Profile</title>
    </head>
    <body>
        <div class="container-loginuser">
            <div class="forms-container">
                <div class="header-profile">
                    <form action="homepage.php" method="POST">
                      <div class="back-button">
                        <input type="submit" id="back" name="submit" alt="back" value="">
                      </div>
                    </form>
                    <?php $text = '../interfaceoperator/operator/';
                        $text .= $_SESSION['Foto']; ?>
                    <img src="<?php echo $text ?>" style="width:109px;height:109px;margin-bottom:20px;border-radius: 100%; border: 3px solid #05555A;">
                    <p class="profile-name"><?= $_SESSION['Nama'] ?></p>
                    <div class="form-profile-division">
                        <p class="profile-division"><?= $_SESSION['Divisi'] ?></p>
                    </div>
                </div>
                <div class="profile-box">
                    <p class="profile-type">Name</p>
                    <p class="type-info"><?= $_SESSION['Nama'] ?></p>
                    <p class="profile-type">Username</p>
                    <p class="type-info"><?= $_SESSION['ID'] ?></p>
                    <p class="profile-type">Gender</p>
                    <p class="type-info"><?= $_SESSION['Jenis_Kelamin'] ?></p>
                    <p class="profile-type">Division</p>
                    <p class="type-info"><?= $_SESSION['Divisi'] ?></p>
                    <p class="profile-type">Address</p>
                    <p class="type-info"><?= $_SESSION['Alamat'] ?></p>
                    <form class="form-logout" method="POST" action="logout.php">
                        <input name="logout" id="logout" class="logout-btn" type="submit" value="Logout">
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>
</html>

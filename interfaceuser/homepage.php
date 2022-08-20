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
        <link rel="stylesheet" href="CSS/homepage.css">

        <title>Homepage</title>
    </head>
    <body>
        <div class="container-loginuser">
            <div class="forms-container">
                <div class="header-homepage">
                    <p class="header-homepage-description">HOMEPAGE</p>
                </div>
                <a href="profile.php" style="color:#fff; text-decoration:none;">
                    <div class="profile-button">
                        <div class="row no-gutters">
                            <div class="col-6">
                                <?php $text = '../interfaceoperator/operator/';
                                        $text .= $_SESSION['Foto']; ?> 
                                <img src="<?php echo $text ?>" style="width:79px;height:79px;border-radius: 100%; border: 3px solid #05555A; margin-top: 35.5px; margin-left: 17px;">
                            </div>
                            <div class="col-6">
                                <div class="homepage-name">
                                    <p class="homepage-name-description">Welcome, <?= $_SESSION['Nama'] ?>!</p>
                                </div>
                                <div class="homepage-division">
                                    <p class="homepage-division-description"><?= $_SESSION['Divisi'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="registration.php" style="color:#fff; text-decoration:none;">
                    <div class="registration-button"></div>
                </a>
                <a href="backup_presensi.php" style="color:#fff; text-decoration:none;">
                    <div class="backup-button"></div>
                </a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>
</html>

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
        <link rel="stylesheet" href="CSS/style_registration.css">

        <title>Face Registration</title>
    </head>
    <body onload = "configure();">
        <div class="container-registration">
            <div class="forms-container">
                <div class="row no-gutters">
                  <div class="col-2">
                    <form action="registration5.php" method="POST">
                      <div class="back-button">
                        <input type="submit" id="back" name="submit" alt="back" value="">
                      </div>
                    </form>
                  </div>
                  <div class="col-10">
                    <div class="header-registration">
                        <p class="header-registration-description">FACE REGISTRATION</p>
                    </div>
                  </div>
                </div>
                <div class="container">
                  <p class="face-position">Wajah Menghadap ke Depan Dengan Masker</p>
                  <p class="instruksi">Tekan Capture lalu Save</p>
                  <p class="instruksi">(Capture bisa dilakukan berulang-ulang untuk melihat hasil foto sebelum di Save)</p>
                  <p class="contoh">Contoh :</p>
                  <img src="image/S__14721054.jpg" style="width:100px;height:120px;margin-bottom:20px;">
                  <div id="my_camera"></div>
                  <br> <button type="button" onclick = "previewSnap();">CAPTURE</button> <br>
                  <div id="result" ></div>
                  <br> <button1 type="button" onclick = "saveSnap();">SAVE</button1> <br>
                  <a href="registration7.php"> <button2 type="button">NEXT &#x2192;</button> </a>
                </div>
                <script type="text/javascript" src="assets/webcam.min.js"></script>
                <script type="text/javascript">
                  function configure(){
                    Webcam.set({
                      width: 380,
                      height: 505,
                      image_format: 'jpeg',
                      jpeg_quality: 100
                    });

                    Webcam.attach('#my_camera');
                  }

                  function previewSnap(){
                    Webcam.snap(function(data_uri){
                      document.getElementById('result').innerHTML = '<img id = "webcam" src = "'+data_uri+'"style="height: 200px; width: 150px; margin-bottom: 20px;">';
                      document.getElementById('finalresult').innerHTML = '<img id = "webcam" src = "'+data_uri+'">';
                    });

                    Webcam.reset();
                  }

                  function saveSnap(){
                    var base64image = document.getElementById("webcam").src;
                    Webcam.upload(base64image,'function.php',function(code,text){
                      alert('Save Successfully');
                      document.location.href = "registration7.php"
                    });
                  }
                  </script>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>
</html>

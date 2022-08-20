<?php
session_start();
if (empty($_SESSION['usernameop'])) {
    echo "<script>alert('You must login first to access this page, thank you.');document.location='../index.php'</script>";
}
?>

<center><br><br><br><br><br><br><br><br>
    <img src="images/logoTA.png" width="450px" height="100px"> <br>
    <font Size="6" face="Helvetica">Sistem Presensi Berbasis Rekognisi Wajah</font> <br>
    <font Size="6">Institut Teknologi Bandung</font>
</center>
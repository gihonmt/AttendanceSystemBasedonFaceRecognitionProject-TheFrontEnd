<?php

session_start();
unset($_SESSION['ID']);
unset($_SESSION['Nama']);
unset($_SESSION['Divisi']);
unset($_SESSION['Jenis_Kelamin']);
unset($_SESSION['Alamat']);
unset($_SESSION['Foto']);

session_destroy();
header('location:index.php');
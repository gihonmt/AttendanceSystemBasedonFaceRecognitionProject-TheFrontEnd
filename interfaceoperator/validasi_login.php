<?php

//Untuk konek ke database
include "config.php";

$pass = md5($_POST['password']);
$username = mysqli_escape_string($koneksi, $_POST['username']);
$password = mysqli_escape_string($koneksi, $pass);

//Cek username terdaftar apa tidak
$cek_user = mysqli_query($koneksi, "SELECT * FROM penggunaop2 WHERE idop = '$username' ");
$user_valid = mysqli_fetch_array($cek_user);

//Validasi username terdaftar
if ($user_valid) {
    //Username terdaftar
    //Cek password
    if ($password == $user_valid['passwordop']) {
        //Password benar
        //Buat session
        session_start();
        $_SESSION['usernameop'] = $user_valid['usernameop'];
        $_SESSION['imageop'] = $user_valid['imagesop'];
        header('location:operator/index.php');
    } else {
        header("location:index.php?error=password");
    }
} else {
    header("location:index.php?error=username");
}
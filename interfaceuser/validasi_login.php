<?php

//Untuk konek ke database
include "konek_database.php";

$pass = md5($_POST['password']);
$username = mysqli_escape_string($konek_database, $_POST['username']);
$password = mysqli_escape_string($konek_database, $pass);

//Cek username terdaftar apa tidak
$cek_user = mysqli_query($konek_database, "SELECT * FROM penggunapresensi2 WHERE ID = '$username' ");
$user_valid = mysqli_fetch_array($cek_user);

//Validasi username terdaftar
if ($user_valid) {
    //Username terdaftar
    //Cek password
    if ($password == $user_valid['Passwordp']) {
        //Password benar
        //Buat session
        session_start();
        $_SESSION['ID'] = $user_valid['ID'];
        $_SESSION['Nama'] = $user_valid['Nama'];
        $_SESSION['Divisi'] = $user_valid['Divisi'];
        $_SESSION['Jenis_Kelamin'] = $user_valid['Jenis_Kelamin'];
        $_SESSION['Alamat'] = $user_valid['Alamat'];
        $_SESSION['Foto'] = $user_valid['Foto'];

        header('location:homepage.php');
    } else {
        header("location:index.php?error=password");
    }
} else {
    header("location:index.php?error=username");
}
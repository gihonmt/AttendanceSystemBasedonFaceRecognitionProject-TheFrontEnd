<?php
session_start();
include "validasi_login.php";
$conn = mysqli_connect("localhost", "root", "", "registration");

if(isset($_FILES["webcam"]["tmp_name"])){
  $tmpName = $_FILES["webcam"]["tmp_name"];
  date_default_timezone_set("Asia/Bangkok");
  $imageName = date("Y.m.d") . " - " . date("H.i.s") . ' .jpeg';
  $ID = $_SESSION['ID'];
  $nama_folder = "registration/$ID/";
  if(is_dir($name_folder) == false){
    mkdir($nama_folder);
  }
  move_uploaded_file($tmpName, "registration/$ID/" . $imageName);
}
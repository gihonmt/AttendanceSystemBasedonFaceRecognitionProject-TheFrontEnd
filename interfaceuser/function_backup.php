<?php
session_start();
include "validasi_login.php";
$conn = mysqli_connect("localhost", "root", "", "facepresence");

if(isset($_FILES["webcam"]["tmp_name"])){
  $tmpName = $_FILES["webcam"]["tmp_name"];
  date_default_timezone_set("Asia/Bangkok");

  $ID = $_SESSION['ID'];
  $Nama = $_SESSION['Nama'];
  $Divisi = $_SESSION['Divisi'];
  $date = date("Y_m_d") . "_" . date("H_i_s");
  $imageName = '../interfaceoperator/operator/gambar_backup/'.$date . '.jpeg';
  move_uploaded_file($tmpName, $imageName);

  // $nama = $_SESSION['Nama'];
  // $imageName = $nama . ' .jpeg';
  // move_uploaded_file($tmpName,'backup_presensi/' . $imageName);

  // $date = date("Y/m/d") . " & " . date("H:i:s");
  // $query = "INSERT INTO backup VALUES('','$date','$imageName')";

  $sql = mysqli_query($conn, "INSERT INTO backuppresensi1(ID, Nama, Divisi, Foto_Selfie) VALUES('$ID', '$Nama', '$Divisi', '$imageName')") or die(mysqli_error($conn));
  mysqli_query($conn, $query);
}
?>
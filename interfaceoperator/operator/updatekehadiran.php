<!-- Source code untuk melakukan penambahan data kehadiran jika hari sudah berganti -->

<?php
//include file config.php
include('config.php');

date_default_timezone_set('Asia/Jakarta');
$datenow = date("Y-m-d");
// echo $datenow;

$query=mysqli_query($koneksi, "SELECT * FROM kehadiran2 WHERE Tanggal='$datenow'") or die(mysqli_error($koneksi));
$row=mysqli_num_rows($query);
if($row == 0){
    $nambah=mysqli_query($koneksi, "INSERT INTO kehadiran2 (ID, Nama, Divisi) SELECT ID, Nama, Divisi FROM penggunapresensi2") or die(mysqli_error($koneksi));
}
?>
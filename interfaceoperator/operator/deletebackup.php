<!-- Source code untuk menghapus data backup pengguna presensi -->

<?php
session_start();
if (empty($_SESSION['usernameop'])) {
	echo "<script>alert('You must login first to access this page, thank you.');document.location='../index.php'</script>";
}
?>

<?php
//include file config.php
include('config.php');

//jika benar mendapatkan GET id dari URL
if (isset($_GET['ID'])) {
	//membuat variabel $id yang menyimpan nilai dari $_GET['id']
	$ID = $_GET['ID'];
	$Fotolama = $_GET['Foto'];
	$Fotolama2 = str_replace("../", "", $Fotolama);
	$Fotolama3 = "../" . $Fotolama2;

	//melakukan query ke database, dengan cara SELECT data yang memiliki id yang sama dengan variabel $id
	$cek = mysqli_query($koneksi, "SELECT * FROM backuppresensi1 WHERE ID='$ID' AND Foto_Selfie = '$Fotolama3'") or die(mysqli_error($koneksi));

	//jika query menghasilkan nilai > 0 maka eksekusi script di bawah
	if (mysqli_num_rows($cek) > 0) {
		//query ke database DELETE untuk menghapus data dengan kondisi id=$id
		$del = mysqli_query($koneksi, "DELETE FROM backuppresensi1 WHERE ID='$ID' AND Foto_Selfie = '$Fotolama3'") or die(mysqli_error($koneksi));
		unlink($Fotolama);
		if ($del) {
			echo '<script>alert("Berhasil menghapus data."); document.location="index.php?page=tampil_backup";</script>';
		} else {
			echo '<script>alert("Gagal menghapus data."); document.location="index.php?page=tampil_backup";</script>';
		}
	} else {
		echo '<script>alert("ID tidak ditemukan di database."); document.location="index.php?page=tampil_backup";</script>';
	}
} else {
	echo '<script>alert("ID tidak ditemukan di database."); document.location="index.php?page=tampil_backup";</script>';
}

?>
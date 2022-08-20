<!-- Source code untuk menambahkan data pengguna presensi -->

<?php
session_start();
if (empty($_SESSION['usernameop'])) {
	echo "<script>alert('You must login first to access this page, thank you.');document.location='../index.php'</script>";
}
?>

<?php
// memasukkan file config.php
include('config.php');
?>

<center>
	<font size="6">Tambah Data Pengguna</font>
</center>
<hr>

<?php
// jika ada data yang di submit
if (isset($_POST['submit'])) {
	$ID				= $_POST['ID'];
	$Nama			= $_POST['Nama'];
	$Password		= md5($_POST['Password']);
	$Jenis_Kelamin	= $_POST['Jenis_Kelamin'];
	$Divisi			= $_POST['Divisi'];
	$Alamat			= $_POST['Alamat'];
	$Email			= $_POST['Email'];
	$Foto			= $_FILES['Foto'];

	// Cek foto yang dimasukkan
	$fotoName 		= $_FILES['Foto']['name'];
	$fotoTmpName 	= $_FILES['Foto']['tmp_name'];
	$fotoSize 		= $_FILES['Foto']['size'];
	$fotoError 		= $_FILES['Foto']['error'];
	$fotoType 		= $_FILES['Foto']['type'];

	$fotoExt = explode('.', $fotoName);
	$fotoActualExt = strtolower(end($fotoExt));

	$allowed = array('jpg', 'jpeg', 'png');

	// Jika foto sesuai extention yang diperbolehkan
	if (in_array($fotoActualExt, $allowed)) {
		if ($fotoError == 0) { // jika tidak ada error
			if ($fotoSize < 1000000) { // jika file dibawah batas ukuran
				// Menyimpan Foto
				$zname_clean = preg_replace('/\s*/', '', $Nama);
				// convert the string to all lowercase
				$zname_clean = strtolower($zname_clean);
				$fotoDestination = 'gambar_identitas/' . $zname_clean . "." . $fotoActualExt;
				move_uploaded_file($fotoTmpName, $fotoDestination);
			} else {
				echo '<div class="alert alert-warning">your file too big</div>';
			}
		} else {
			echo '<div class="alert alert-warning">your file uploading error</div>';
		}
	} else {
		echo '<div class="alert alert-warning">cannot upload this file type</div>';
	}

	// Mengecek tidak ada data pengguna baru dalam database 			
	$cek = mysqli_query($koneksi, "SELECT * FROM penggunapresensi2 WHERE ID='$ID'") or die(mysqli_error($koneksi));

	// jika query diatas menghasilkan nilai sebesar 0 maka menjalankan script di bawah if...
	if (mysqli_num_rows($cek) == 0) {
		// Memasukkan data pengguna baru kedalam database
		$sql = mysqli_query($koneksi, "INSERT INTO penggunapresensi2(ID, Nama, Passwordp, Jenis_Kelamin, Divisi, Alamat, Email, Foto) VALUES('$ID', '$Nama', '$Password', '$Jenis_Kelamin', '$Divisi', '$Alamat', '$Email', '$fotoDestination')") or die(mysqli_error($koneksi));

		// Feedback penyimpanan data baru
		if ($sql) {
			echo '<script>alert("Berhasil menambahkan data."); document.location="index.php?page=tampil_pengguna";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
		}
	} else {
		echo '<div class="alert alert-warning">Gagal, ID sudah terdaftar.</div>';
	}

	date_default_timezone_set('Asia/Jakarta');
 	$datenow = date("Y-m-d");
	// echo $datenow;

	$query=mysqli_query($koneksi, "SELECT * FROM kehadiran2 WHERE Tanggal='$datenow' AND ID='$ID'") or die(mysqli_error($koneksi));
	$row=mysqli_num_rows($query);
	if($row == 0){
		$nambah=mysqli_query($koneksi, "INSERT INTO kehadiran2 (ID, Nama, Divisi) VALUES('$ID', '$Nama', '$Divisi')") or die(mysqli_error($koneksi));
	}
}
?>

<form action="index.php?page=tambah_pengguna" method="post" enctype="multipart/form-data">
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">ID</label>
		<div class="col-md-6 col-sm-6 ">
			<input type="text" name="ID" class="form-control" size="4" required>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Pengguna</label>
		<div class="col-md-6 col-sm-6">
			<input type="text" name="Nama" class="form-control" required>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Password</label>
		<div class="col-md-6 col-sm-6">
			<input type="password" name="Password" class="form-control" required>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
		<div class="col-md-6 col-sm-6 ">
			<div class="btn-group" data-toggle="buttons">
				<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
					<input type="radio" class="join-btn" name="Jenis_Kelamin" value="Laki-Laki" required>Laki-Laki
				</label>
				<label class="btn btn-primary " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
					<input type="radio" class="join-btn" name="Jenis_Kelamin" value="Perempuan" required>Perempuan
				</label>
			</div>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Divisi</label>
		<div class="col-md-6 col-sm-6">
			<select name="Divisi" class="form-control" required>
				<option value="">Pilih Divisi</option>
				<option value="Human Resources Management">Human Resources Management</option>
				<option value="Human Resources Development">Human Resources Development</option>
				<option value="Resources and Development">Resources and Development</option>
				<option value="Management">Management</option>
				<option value="Product Management">Product Management</option>
				<option value="Marketing">Marketing</option>
			</select>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Alamat</label>
		<div class="col-md-6 col-sm-6">
			<input type="text" name="Alamat" class="form-control" required>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
		<div class="col-md-6 col-sm-6">
			<input type="email" name="Email" class="form-control" required>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Foto</label>
		<div class="col-md-6 col-sm-6">
			<input type="file" name="Foto">
		</div>
	</div>
	<div class="item form-group">
		<div class="col-md-6 col-sm-6 offset-md-3">
			<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
		</div>
	</div>
</form>
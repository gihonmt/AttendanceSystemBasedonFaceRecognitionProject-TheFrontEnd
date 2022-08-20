<!-- Source code untuk mengedit data pengguna presensi -->

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

<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Edit Data Pengguna</font>
	</center>
	<hr>

	<?php
	//jika sudah mendapatkan parameter GET ID data yang akan diedit dari URL
	if (isset($_GET['ID'])) {
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$ID = $_GET['ID'];

		//query ke database SELECT tabel pengguna presensi berdasarkan id = $id
		$select = mysqli_query($koneksi, "SELECT * FROM penggunapresensi2 WHERE ID='$ID'") or die(mysqli_error($koneksi));

		//jika hasil query = 0 maka muncul pesan error
		if (mysqli_num_rows($select) == 0) {
			echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
			exit();
			//jika hasil query > 0
		} else {
			//membuat variabel $data dan menyimpan data row dari query
			$data = mysqli_fetch_assoc($select);
		}
	}
	?>

	<?php
	//jika tombol simpan di tekan/klik
	if (isset($_POST['submit'])) {
		$Nama			= $_POST['Nama'];
		$Jenis_Kelamin	= $_POST['Jenis_Kelamin'];
		$Divisi			= $_POST['Divisi'];
		$Alamat			= $_POST['Alamat'];
		$Email			= $_POST['Email'];
		$FotoLama 		= $_POST['Foto_old'];

		// cek ada gambar baru atau tidak
		if ($_FILES['Foto']['size'] != 0) {
			unlink($FotoLama);

			$fotoName = $_FILES['Foto']['name'];
			$fotoTmpName = $_FILES['Foto']['tmp_name'];
			$fotoSize = $_FILES['Foto']['size'];
			$fotoError = $_FILES['Foto']['error'];
			$fotoType = $_FILES['Foto']['type'];

			$fotoExt = explode('.', $fotoName);
			$fotoActualExt = strtolower(end($fotoExt));

			$allowed = array('jpg', 'jpeg', 'png');

			// Jika foto sesuai dengan sesuai extention yang diperbolehkan
			if (in_array($fotoActualExt, $allowed)) {
				if ($fotoError == 0) {
					if ($fotoSize < 10000000) {
						$fotoDestination = 'gambar_identitas/' . $fotoName;
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

			// update data baru dengan foto baru
			$sql = mysqli_query($koneksi, "UPDATE penggunapresensi2 SET Nama='$Nama', Jenis_Kelamin='$Jenis_Kelamin', Divisi='$Divisi', Alamat='$Alamat', Foto='$fotoDestination' WHERE ID='$ID'") or die(mysqli_error($koneksi));
		} else {
			// update data baru tanpa foto baru
			$sql = mysqli_query($koneksi, "UPDATE penggunapresensi2 SET Nama='$Nama', Jenis_Kelamin='$Jenis_Kelamin', Divisi='$Divisi', Alamat='$Alamat' WHERE ID='$ID'") or die(mysqli_error($koneksi));
		}

		// feedback update data
		if ($sql) {
			echo '<script>alert("Berhasil menyimpan data."); document.location="index.php?page=tampil_pengguna";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
		}
	}
	?>

	<form action="index.php?page=edit_pengguna&ID=<?php echo $ID; ?>" method="post" enctype="multipart/form-data">
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">ID</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="ID" class="form-control" size="4" value="<?php echo $data['ID']; ?>" readonly required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Pengguna</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="Nama" class="form-control" value="<?php echo $data['Nama']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
			<div class="col-md-6 col-sm-6 ">
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						<input type="radio" class="join-btn" name="Jenis_Kelamin" value="Laki-Laki" <?php if ($data['Jenis_Kelamin'] == 'Laki-Laki') {
																										echo 'checked';
																									} ?> required>Laki-Laki
					</label>
					<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						<input type="radio" class="join-btn" name="Jenis_Kelamin" value="Perempuan" <?php if ($data['Jenis_Kelamin'] == 'Perempuan') {
																										echo 'checked';
																									} ?> required>Perempuan
					</label>
				</div>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Divisi</label>
			<div class="col-md-6 col-sm-6">
				<select name="Divisi" class="form-control" required>
					<option value="">Pilih Divisi</option>
					<option value="Human Resources Management" <?php if ($data['Divisi'] == 'Human Resources Management') {
																	echo 'selected';
																} ?>>Human Resources Management</option>
					<option value="Human Resources Development" <?php if ($data['Divisi'] == 'Human Resources Development') {
																	echo 'selected';
																} ?>>Human Resources Development</option>
					<option value="Resources and Development" <?php if ($data['Divisi'] == 'Resources and Development') {
																	echo 'selected';
																} ?>>Resources and Development</option>
					<option value="Management" <?php if ($data['Divisi'] == 'Management') {
													echo 'selected';
												} ?>>Management</option>
					<option value="Product Management" <?php if ($data['Divisi'] == 'Product Management') {
															echo 'selected';
														} ?>>Product Management</option>
					<option value="Marketing" <?php if ($data['Divisi'] == 'Marketing') {
															echo 'selected';
														} ?>>Marketing</option>
				</select>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Alamat</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="Alamat" class="form-control" value="<?php echo $data['Alamat']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
			<div class="col-md-6 col-sm-6">
				<input type="email" name="Email" class="form-control" value="<?php echo $data['Email']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Foto</label>
			<div class="col-md-6 col-sm-6">
				<input type="file" name="Foto">
				<input type="hidden" name="Foto_old" value="<?php echo $data['Foto']; ?>">
			</div>
		</div>
		<div class="item form-group">
			<div class="col-md-6 col-sm-6 offset-md-3">
				<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
				<a href="index.php?page=tampil_pengguna" class="btn btn-warning">Kembali</a>
			</div>
		</div>
	</form>
</div>
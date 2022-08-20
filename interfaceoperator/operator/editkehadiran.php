<!-- Source code untuk mengedit data kehadiran pengguna presensi -->

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
		<font size="6">Edit Data Kehadiran</font>
	</center>
	<hr>

	<?php
	//jika sudah mendapatkan parameter GET id dari URL
	if (isset($_GET['ID'])) {
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$ID = $_GET['ID'];
		$Tanggal = $_GET['Tanggal'];

		//query ke database SELECT tabel kehadiran berdasarkan id = $id
		$select = mysqli_query($koneksi, "SELECT * FROM kehadiran2 WHERE ID='$ID' AND Tanggal='$Tanggal'") or die(mysqli_error($koneksi));

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
		$Nama	= $_POST['Nama'];
		$Divisi	= $_POST['Divisi'];
		// $Tanggal = $_POST['Tanggal'];
		$Jam_Masuk = $_POST['Jam_Masuk'];
		$Status	= $_POST['Status'];
		$Keterangan	= $_POST['Keterangan'];

		// melakukan update data kehadiran kedalam database
		$sql = mysqli_query($koneksi, "UPDATE kehadiran2 SET Nama='$Nama', Divisi='$Divisi', Jam_Masuk='$Jam_Masuk', Status='$Status', Keterangan='$Keterangan' WHERE ID='$ID' AND Tanggal='$Tanggal'") or die(mysqli_error($koneksi));

		if ($sql) {
			echo '<script>alert("Berhasil menyimpan data."); document.location="index.php?page=tampil_kehadiran";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
		}
	}
	?>

	<form action="index.php?page=edit_kehadiran1&ID=<?php echo $ID; ?>&Tanggal=<?php echo $Tanggal; ?>" method="post">
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
					<option value="Marketing" <?php if ($data['Divisi'] == 'Marketing') {
													echo 'selected';
												} ?>>Management</option>
					<option value="Product Management" <?php if ($data['Divisi'] == 'Product Management') {
															echo 'selected';
														} ?>>Product Management</option>
				</select>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="Tanggal" class="form-control" value="<?php echo $data['Tanggal']; ?>" readonly required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Jam Masuk</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="Jam_Masuk" class="form-control" value="<?php echo $data['Jam_Masuk']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
			<div class="col-md-6 col-sm-6">
				<select name="Status" class="form-control" required>
					<option value="">Pilih Status</option>
					<option value="Hadir" <?php if ($data['Status'] == 'Hadir') {
												echo 'selected';
											} ?>>Hadir</option>
					<option value="Tidak Hadir" <?php if ($data['Status'] == 'Tidak Hadir') {
													echo 'selected';
												} ?>>Tidak Hadir</option>
					<option value="Yang Lain" <?php if ($data['Status'] == 'Yang Lain') {
													echo 'selected';
												} ?>>Yang Lain</option>
				</select>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="Keterangan" class="form-control" value="<?php echo $data['Keterangan']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<div class="col-md-6 col-sm-6 offset-md-3">
				<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
				<a href="index.php?page=tampil_kehadiran2" class="btn btn-warning">Kembali</a>
			</div>
		</div>
	</form>
</div>
<?php
session_start();
if (empty($_SESSION['usernameop'])) {
	echo "<script>alert('You must login first to access this page, thank you.');document.location='../index.php'</script>";
}
?>

<?php
include('config.php');
if (isset($_POST['search'])) {
	$date1 = date("Y-m-d", strtotime($_POST['date1']));
	// $date2 = date("Y-m-d", strtotime($_POST['date2']));
	// $query=mysqli_query($conn, "SELECT * FROM `tbl_order` WHERE date(`order_date`) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
	$query = mysqli_query($koneksi, "SELECT * FROM backuppresensi1 WHERE Tanggal='$date1' ") or die(mysqli_error($koneksi));
	$row = mysqli_num_rows($query);
	if ($row > 0) {
		$no = 1;
		while ($data = mysqli_fetch_array($query)) {
			//menampilkan data perulangan
			echo '
					<tr>
					 <td>' . $no . '</td>
					 <td>' . $data['ID'] . '</td>
					 <td>' . $data['Nama'] . '</td>
					 <td>' . $data['Divisi'] . '</td>
					 <td>' . $data['Tanggal'] . '</td>
					 <td>' . $data['Jam_Masuk'] . '</td>
					 <td><center><img src="../' . $data['Foto_Selfie'] . '" height = "100"></center></td>
					 <td>
					  <a href="deletebackup.php?ID=' . $data['ID'] . '&Foto=../' . $data['Foto_Selfie'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><span class="glyphicon glyphicon-trash"></span></a>
					 </td>
					</tr>
					';
			$no++;
		}
		//jika query menghasilkan nilai 0
	} else {
		echo '
				   <tr>
					<td colspan="8"><center>No Matching Records Found</center></td>
				   </tr>
				   ';
	}
} else {
	$query = mysqli_query($koneksi, "SELECT * FROM `backuppresensi1`") or die(mysqli_error($koneksi));
	$row = mysqli_num_rows($query);
	if ($row > 0) {
		$no = 1;
		while ($data = mysqli_fetch_array($query)) {
			echo '
					<tr>
					 <td>' . $no . '</td>
					 <td>' . $data['ID'] . '</td>
					 <td>' . $data['Nama'] . '</td>
					 <td>' . $data['Divisi'] . '</td>
					 <td>' . $data['Tanggal'] . '</td>
					 <td>' . $data['Jam_Masuk'] . '</td>
					 <td><center><img src="../' . $data['Foto_Selfie'] . '" height = "100"></center></td>
					 <td>
					  <a href="deletebackup.php?ID=' . $data['ID'] . '&Foto=../' . $data['Foto_Selfie'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><span class="glyphicon glyphicon-trash"></span></a>
					 </td>
					</tr>
					';
			$no++;
		}
		//jika query menghasilkan nilai 0
	} else {
		echo '
				   <tr>
					<td colspan="8"><center>No Matching Records Found</center></td>
				   </tr>
				   ';
	}
}
?>

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
	$query = mysqli_query($koneksi, "SELECT * FROM kehadiran2 WHERE Tanggal='$date1' ") or die(mysqli_error($koneksi));
	$row = mysqli_num_rows($query);
	if ($row > 0) {
		$no = 1;
		while ($fetch = mysqli_fetch_array($query)) {
?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $fetch['ID'] ?></td>
				<td><?php echo $fetch['Nama'] ?></td>
				<td><?php echo $fetch['Divisi'] ?></td>
				<td><?php echo $fetch['Tanggal'] ?></td>
				<td><?php echo $fetch['Jam_Masuk'] ?></td>
				<td><?php echo $fetch['Status'] ?></td>
				<td><?php echo $fetch['Keterangan'] ?></td>
				<td>
					<a href="index.php?page=edit_kehadiran1&ID=<?php echo $fetch['ID'] ?>&Tanggal=<?php echo $fetch['Tanggal'] ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
				</td>
			</tr>
			<?php $no++; ?>
		<?php
		}
	} else {
		echo '
    			<tr>
    				<td colspan = "9"><center>No Matching Records Found</center></td>
    			</tr>';
	}
} else {
	$query = mysqli_query($koneksi, "SELECT * FROM `kehadiran2`") or die(mysqli_error($koneksi));
	$row = mysqli_num_rows($query);
	if ($row > 0) {
		$no = 1;
		while ($fetch = mysqli_fetch_array($query)) {
		?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $fetch['ID'] ?></td>
				<td><?php echo $fetch['Nama'] ?></td>
				<td><?php echo $fetch['Divisi'] ?></td>
				<td><?php echo $fetch['Tanggal'] ?></td>
				<td><?php echo $fetch['Jam_Masuk'] ?></td>
				<td><?php echo $fetch['Status'] ?></td>
				<td><?php echo $fetch['Keterangan'] ?></td>
				<td>
					<a href="index.php?page=edit_kehadiran1&ID=<?php echo $fetch['ID'] ?>&Tanggal=<?php echo $fetch['Tanggal'] ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
				</td>
			</tr>
			<?php $no++; ?>
<?php
		}
	} else {
		echo '
    			<tr>
    				<td colspan = "9"><center>No Matching Records Found</center></td>
    			</tr>';
	}
}
?>
<!-- Source code untuk menampilkan data pengguna presensi -->
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

<!-- page content -->
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <font size="6">Data Pengguna</font>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <!-- tombol tambah data -->
            <div class="col-md-12">
              <a href="index.php?page=tambah_pengguna" class="text-right">
                <button class="btn btn-info right">Tambah Data</button>
              </a>
            </div>

            <div class="card-box table-responsive">
              <table id="datatable" class="table table-striped jambo_table bulk_action table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>
                      <center>No.</center>
                    </th>
                    <th>
                      <center>ID</center>
                    </th>
                    <th>
                      <center>Nama Pengguna</center>
                    </th>
                    <th>
                      <center>Jenis Kelamin</center>
                    </th>
                    <th>
                      <center>Divisi</center>
                    </th>
                    <th>
                      <center>Alamat</center>
                    </th>
                    <th>
                      <center>Foto</center>
                    </th>
                    <th>
                      <center>Aksi</center>
                    </th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  //query ke database SELECT tabel pengguna presensi urut berdasarkan id yang paling besar
                  $sql = mysqli_query($koneksi, "SELECT * FROM penggunapresensi2 ORDER BY ID ASC") or die(mysqli_error($koneksi));

                  //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                  if (mysqli_num_rows($sql) > 0) {
                    //membuat variabel $no untuk menyimpan nomor urut
                    $no = 1;

                    //melakukan perulangan while dengan dari dari query $sql
                    while ($data = mysqli_fetch_assoc($sql)) {
                      //menampilkan data perulangan
                      echo '
                            <tr>
                              <td>' . $no . '</td>
                              <td>' . $data['ID'] . '</td>
                              <td>' . $data['Nama'] . '</td>
                              <td>' . $data['Jenis_Kelamin'] . '</td>
                              <td>' . $data['Divisi'] . '</td>
                              <td>' . $data['Alamat'] . '</td>
                              <td><center><img src="' . $data['Foto'] . '" height = "100"></center></td>
                              <td>
                                <center><a href="index.php?page=edit_pengguna&ID=' . $data['ID'] . '" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a></center>
                                <center><a href="delete.php?ID=' . $data['ID'] . '&Foto=' . $data['Foto'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><span class="glyphicon glyphicon-trash"></span></a></center>
                                <center><a href="sendemail.php?ID=' . $data['ID'] . '&Email=' . $data['Email'] . '&Nama=' . $data['Nama'] . '" class="btn btn-success btn-sm" onclick="return confirm(\'Yakin ingin mengirim Email ke pengguna?\')"><span class="glyphicon glyphicon-envelope"></span></a></center>
                              </td>
                            </tr>
                            ';
                      $no++;
                    }

                    //jika query menghasilkan nilai 
                  } else {
                    echo '
                          <tr>
                            <td colspan="6">Tidak ada data.</td>
                          </tr>
                          ';
                  }
                  ?>
                <tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /page content -->
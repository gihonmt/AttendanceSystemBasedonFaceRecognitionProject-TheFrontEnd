<!-- Source code untuk menampilkan data kehadiran pengguna presensi -->

<?php
session_start();
if (empty($_SESSION['usernameop'])) {
    echo "<script>alert('You must login first to access this page, thank you.');document.location='../index.php'</script>";
}
?>

<!-- page content -->
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <font size="6">Data Kehadiran</font>
            <div class="clearfix"></div>
        </div>

        <!-- pemilihan tanggal -->
        <form class="form-inline" method="POST" action="">
            <label class="mr-1">Date:</label>
            <input type="date" class="form-control mr-2" placeholder="dd-mm-yyyy" name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
            <button class="btn btn-info" name="search"><span class="glyphicon glyphicon-search"></span></button> <a href="index.php?page=tampil_kehadiran" type="button" class="btn btn-success"><span class="glyphicon glyphicon-refresh"><span></a>
        </form>

        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
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
                                        <center>Divisi</center>
                                    </th>
                                    <th>
                                        <center>Tanggal</center>
                                    </th>
                                    <th>
                                        <center>Jam Masuk</center>
                                    </th>
                                    <th>
                                        <center>Status</center>
                                    </th>
                                    <th>
                                        <center>Keterangan</center>
                                    </th>
                                    <th>
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include 'filterdatakehadiran.php'
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
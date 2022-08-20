<!-- <head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head> -->

<!-- page content -->
<div class="row" style="display: inline-block; padding-left: 170px;">
    <div class="top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
            <div class="tile-stats" style="border-radius: 10px; background: url('kehadiran.jpg');">
                <div class="icon"><i class="fa fa-calendar-o" style="font-size: 50px; padding-left: 10px; padding-bottom: 5px;"></i></div>
                <div class="count">
                    <?php
                    $con = new mysqli('localhost', 'root', '', 'facepresence');
                    $query = $con->query("SELECT COUNT(CASE WHEN status = 'Hadir' THEN 1 END)*100/COUNT(*) as cnt, date(tanggal) as tgl FROM kehadiran2 WHERE tanggal = CURDATE()");
                    foreach ($query as $data) {
                        $kehadiranhariini = $data['cnt'];
                    }
                    echo number_format((float)$kehadiranhariini, 2, '.', '') . "%";
                    ?>
                </div>
                <h3 style="color: #0057FF;">Kehadiran Hari Ini</h3>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
            <div class="tile-stats" style="border-radius: 10px; background: url('jumlahkaryawan.jpg');">
                <div class="icon"><i class="fa fa-users" style="font-size: 50px; padding-left: 10px; padding-bottom: 5px;"></i></div>
                <div class="count">
                    <?php
                    $con = new mysqli('localhost', 'root', '', 'facepresence');
                    $query = $con->query("SELECT COUNT(*) as cnt, date(tanggal) as tgl FROM kehadiran2 WHERE tanggal = CURDATE()");
                    foreach ($query as $data) {
                        $jumlahkaryawan = $data['cnt'];
                    }
                    echo $jumlahkaryawan;
                    ?>
                </div>
                <h3 style="color: #18AC2F;">Jumlah Karyawan</h3>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
            <div class="tile-stats" style="height: 137px; border-radius: 10px; background: url('izinsakit.jpg');">
                <div class="icon"><i class="fa fa-hospital-o" style="font-size: 50px; padding-left: 10px; padding-bottom: 5px;"></i></div>
                <div class="count">
                    <?php
                    $con = new mysqli('localhost', 'root', '', 'facepresence');
                    $query = $con->query("SELECT COUNT(CASE WHEN (status = 'Tidak Hadir' AND (keterangan = 'Izin' OR keterangan = 'Sakit')) THEN 1 END) as cnt, date(tanggal) as tgl FROM kehadiran2 WHERE tanggal = CURDATE()");
                    foreach ($query as $data) {
                        $izinsakit = $data['cnt'];
                    }
                    echo $izinsakit;
                    ?>
                </div>
                <h3 style="color: #FF9900;">Izin/Sakit</h3>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
            <div class="tile-stats" style="border-radius: 10px; background: url('tanpaketerangan.jpg');">
                <div class="icon"><i class="fa fa-question-circle" style="font-size: 50px; padding-left: 10px; padding-bottom: 5px;"></i></div>
                <div class="count">
                    <?php
                    $con = new mysqli('localhost', 'root', '', 'facepresence');
                    $query = $con->query("SELECT COUNT(CASE WHEN (status = 'Tidak Hadir' AND keterangan = '-') THEN 1 END) as cnt, date(tanggal) as tgl FROM kehadiran2 WHERE tanggal = CURDATE()");
                    foreach ($query as $data) {
                        $izinsakit = $data['cnt'];
                    }
                    echo $izinsakit;
                    ?>
                </div>
                <h3 style="color: #FF0000;">Tanpa Keterangan</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Grafik Kehadiran</h2>
                <div class="filter" style="margin-right: 10px;">
                    <form action="index.php?page=dashboard" method="post" enctype="multipart/form-data">
                        <div class="col-md-5">
                            <label class="mr-1">From Date:</label>
                            <input type="date" name="From" id="From" class="form-control" placeholder="From Date" />
                        </div>
                        <div class="col-md-5">
                            <label class="mr-1">To Date:</label>
                            <input type="date" name="to" id="to" class="form-control" placeholder="To Date" />
                        </div>
                        <div class="col-md-2">
                            <label class="mr-1">Find:</label>
                            <input type="submit" name="range" id="range" value="Apply" class="btn btn-success" />
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- <div style="width: 73%; margin-left: auto; margin-right: auto;">
                <canvas id="lineChart"></canvas>
            </div> -->
            <div style="width: 75%; margin-left: auto; margin-right: auto;">
                <canvas id="canvas"></canvas>
            </div>
            <?php
            if (isset($_POST['From']) && isset($_POST['to'])) {
                $firstdate = $_POST['From'];
                $lastdate = $_POST['to'];

                $con = new mysqli('localhost', 'root', '', 'facepresence');
                $query = $con->query("SELECT COUNT(CASE WHEN Status = 'Hadir' THEN 1 END)*100/COUNT(*) as cnt, date(Tanggal) as tgl FROM kehadiran2 WHERE Tanggal BETWEEN '$firstdate' AND '$lastdate' GROUP BY Tanggal");
                foreach ($query as $data) {
                    $jumlah[] = $data['cnt'];
                    $tanggal_hadir[] = $data['tgl'];
                }
            } else {
                $con = new mysqli('localhost', 'root', '', 'facepresence');
                $query = $con->query("SELECT COUNT(CASE WHEN Status = 'Hadir' THEN 1 END)*100/COUNT(*) as cnt, date(Tanggal) as tgl FROM kehadiran2 WHERE Tanggal BETWEEN DATE_SUB(CURDATE(),INTERVAL 30 DAY) AND CURDATE() GROUP BY Tanggal");
                foreach ($query as $data) {
                    $jumlah[] = $data['cnt'];
                    $tanggal_hadir[] = $data['tgl'];
                }
            }
            ?>

            <script>
                const labels = <?php echo json_encode($tanggal_hadir) ?>;

                var randomScalingFactor = function() {
                    return Math.round(Math.random() * 100);
                    //return 0;
                };
                var randomColorFactor = function() {
                    return Math.round(Math.random() * 255);
                };
                var randomColor = function(opacity) {
                    return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
                };

                var config = {
                    type: 'line',
                    data: {
                        // labels: ["January", "February", "March", "April", "May", "June", "July"],
                        labels: labels,
                        datasets: [{
                            label: "Persentase Jumlah Kehadiran",
                            //data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
                            data: <?php echo json_encode($jumlah) ?>,
                            fill: false,
                            lineTension: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: "Persentase Jumlah Kehadiran"
                        },
                        tooltips: {
                            mode: 'label',
                            callbacks: {
                                // beforeTitle: function() {
                                //     return '...beforeTitle';
                                // },
                                // afterTitle: function() {
                                //     return '...afterTitle';
                                // },
                                // beforeBody: function() {
                                //     return '...beforeBody';
                                // },
                                // afterBody: function() {
                                //     return '...afterBody';
                                // },
                                // beforeFooter: function() {
                                //     return '...beforeFooter';
                                // },
                                // footer: function() {
                                //     return 'Footer';
                                // },
                                // afterFooter: function() {
                                //     return '...afterFooter';
                                // },
                            }
                        },
                        hover: {
                            mode: 'dataset'
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    show: true,
                                    labelString: 'Date'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    show: true,
                                    labelString: 'Jumlah Kehadiran'
                                },
                                ticks: {
                                    suggestedMin: 0,
                                    // suggestedMax: 100,
                                }
                            }]
                        }
                    }
                };

                $.each(config.data.datasets, function(i, dataset) {
                    dataset.borderColor = randomColor(0.4);
                    dataset.backgroundColor = randomColor(0.5);
                    dataset.pointBorderColor = randomColor(0.7);
                    dataset.pointBackgroundColor = randomColor(0.5);
                    dataset.pointBorderWidth = 1;
                });

                window.onload = function() {
                    var ctx = document.getElementById("canvas").getContext("2d");
                    window.myLine = new Chart(ctx, config);
                };
            </script>
        </div>
    </div>
</div>
<!-- /page content -->

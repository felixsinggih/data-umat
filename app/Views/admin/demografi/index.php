<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi') ?>

<?php
$jmlKeluargaValue = array();
$jmlKeluargaLabel = array();
foreach ($jmlKeluarga as $data) :
    array_push($jmlKeluargaValue, $data['total']);
    array_push($jmlKeluargaLabel, $data['nama']);
endforeach;
$totalJmlKeluarga = array_sum($jmlKeluargaValue);

$jmlUmatValue = array();
$jmlUmatLabel = array();
foreach ($jmlUmat as $data) :
    array_push($jmlUmatValue, $data['total']);
    array_push($jmlUmatLabel, $data['nama']);
endforeach;
$totalJmlUmat = array_sum($jmlUmatValue);

$totalUmur = $demoUmur[0]['dua_belas'] + $demoUmur[0]['delapan_belas'] + $demoUmur[0]['dua_lima'] + $demoUmur[0]['tiga_lima'] + $demoUmur[0]['empat_lima'] + $demoUmur[0]['lima_lima'] + $demoUmur[0]['enam_lima'] + $demoUmur[0]['enam_lima_keatas'];
($demoUmur[0]['tidak_diketahui'] != 0) ? $totalUmur = $totalUmur + $demoUmur[0]['tidak_diketahui'] : '';

if ($keyword) $keywordName = $lingkungan[array_search($keyword, array_column($lingkungan, 'id_lingkungan'))]['nama'];

$jmlDarahValue = array();
$jmlDarahLabel = array();
foreach ($demoDarah as $data) :
    if ($data['gol_darah'] != null) array_push($jmlDarahValue, $data['total']);
    if ($data['gol_darah'] != null) array_push($jmlDarahLabel, $data['gol_darah']);
endforeach;
$totalJmlDarah = array_sum($jmlDarahValue);
if ($totalJmlDarah != $totalJmlUmat) {
    $sisaDarah = $totalJmlUmat - $totalJmlDarah;
    array_push($jmlDarahValue, $sisaDarah);
    array_push($jmlDarahLabel, 'Tidak Diketahui');
    $totalJmlDarah = $totalJmlUmat;
}

$jmlPekerjaanValue = array();
$jmlPekerjaanLabel = array();
foreach ($demoPekerjaan as $data) :
    array_push($jmlPekerjaanValue, $data['total']);
    ($data['nama'] == 'Buruh harian lepas (Sopir, Tukang, Ojol, dll)') ? array_push($jmlPekerjaanLabel, 'Buruh') : array_push($jmlPekerjaanLabel, $data['nama']);
endforeach;
$totalJmlPekerjaan = array_sum($jmlPekerjaanValue);

$jmlPendidikanValue = array();
$jmlPendidikanLabel = array();
foreach ($demoPendidikan as $data) :
    array_push($jmlPendidikanValue, $data['total']);
    array_push($jmlPendidikanLabel, $data['nama']);
endforeach;
$totalJmlPendidikan = array_sum($jmlPendidikanValue);

$jmlSekolahValue = array();
$jmlSekolahLabel = array();
foreach ($demoSekolah as $data) :
    array_push($jmlSekolahValue, $data['total']);
    array_push($jmlSekolahLabel, $data['nama']);
endforeach;
$totalJmlSekolah = array_sum($jmlSekolahValue);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"><i class="fas fa-filter"></i> Filter</h3>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/admin/demografi" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="keyword" class="col-lg-3 col-form-label">Lingkungan / Stasi</label>
                        <div class="col-lg-9">
                            <select class="custom-select" id="keyword" name="keyword">
                                <?php if ($keyword) : ?>
                                    <option value="<?= $keyword ?>"><?= $keywordName ?></option>
                                <?php else : ?>
                                    <option value="" selected disabled>Pilih Lingkungan / Stasi</option>
                                <?php endif; ?>
                                <option value="">Semua Lingkungan / Stasi</option>
                                <?php foreach ($lingkungan as $data) : ?>
                                    <option value="<?= $data['id_lingkungan'] ?>"><?= $data['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <?php if ($keyword) echo 'Jumlah Keluarga Lingkungan / Stasi ' . $keywordName;
                        else echo 'Jumlah Keluarga Berdasarkan Lingkungan / Stasi'; ?>
                    </h3>
                </div>
            </div>
            <div class="card-body pb-0">
                <?php if (empty($jmlKeluarga)) : ?>
                    <p class="lead">Data tidak tersedia.</p>
                <?php else : ?>
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"><?= ribuan($totalJmlKeluarga) ?></span>
                            <span>Total Keluarga</span>
                        </p>
                    </div>
                    <!-- /.d-flex  -->
                    <div class="position-relative mb-4">
                        <canvas id="chartLingkungan" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card demografi jumlah keluarga -->

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <?php if ($keyword) echo 'Jumlah Umat Lingkungan / Stasi ' . $keywordName;
                        else echo 'Jumlah Umat Berdasarkan Lingkungan / Stasi'; ?>
                    </h3>
                </div>
            </div>
            <div class="card-body pb-0">
                <?php if (empty($jmlUmat)) : ?>
                    <p class="lead">Data tidak tersedia.</p>
                <?php else : ?>
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"><?= ribuan($totalJmlUmat) ?></span>
                            <span>Total Umat</span>
                        </p>
                    </div>
                    <!-- /.d-flex  -->
                    <div class="position-relative mb-4">
                        <canvas id="chartUmat" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card demografi jumlah umat -->

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <?php if ($keyword) echo 'Demografi Umur Lingkungan / Stasi ' . $keywordName;
                        else echo 'Demografi Umur'; ?>
                    </h3>
                </div>
            </div>
            <div class="card-body pb-0">
                <?php if (empty($demoUmur[0]['dua_belas']) && empty($demoUmur[0]['delapan_belas']) && empty($demoUmur[0]['dua_lima']) && empty($demoUmur[0]['tiga_lima']) && empty($demoUmur[0]['empat_lima']) && empty($demoUmur[0]['lima_lima']) && empty($demoUmur[0]['enam_lima']) && empty($demoUmur[0]['enam_lima_keatas'])) : ?>
                    <p class="lead">Data tidak tersedia.</p>
                <?php else : ?>
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"><?= ribuan($totalUmur) ?></span>
                            <span>Total Data</span>
                        </p>
                    </div>
                    <!-- /.d-flex  -->
                    <div class="position-relative mb-4">
                        <canvas id="chartUmur" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card demografi umur -->

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <?php if ($keyword) echo 'Demografi Golongan Darah Lingkungan / Stasi ' . $keywordName;
                        else echo 'Demografi Golongan Darah'; ?>
                    </h3>
                </div>
            </div>
            <div class="card-body pb-0">
                <?php if (empty($demoDarah)) : ?>
                    <p class="lead">Data tidak tersedia.</p>
                <?php else : ?>
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"><?= ribuan($totalJmlDarah) ?></span>
                            <span>Total Data</span>
                        </p>
                    </div>
                    <!-- /.d-flex  -->
                    <div class="position-relative mb-4">
                        <canvas id="chartDarah" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card demografi golongan darah -->

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <?php if ($keyword) echo 'Demografi Pekerjaan Lingkungan / Stasi ' . $keywordName;
                        else echo 'Demografi Pekerjaan'; ?>
                    </h3>
                </div>
            </div>
            <div class="card-body pb-0">
                <?php if (empty($demoPekerjaan)) : ?>
                    <p class="lead">Data tidak tersedia.</p>
                <?php else : ?>
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"><?= ribuan($totalJmlPekerjaan) ?></span>
                            <span>Total Data</span>
                        </p>
                    </div>
                    <!-- /.d-flex  -->
                    <div class="position-relative mb-4">
                        <canvas id="chartKerja" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card demografi pekerjaan -->

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <?php if ($keyword) echo 'Demografi Pendidikan Terakhir Lingkungan / Stasi ' . $keywordName;
                        else echo 'Demografi Pendidikan Terakhir'; ?>
                    </h3>
                </div>
            </div>
            <div class="card-body pb-0">
                <?php if (empty($demoPendidikan)) : ?>
                    <p class="lead">Data tidak tersedia.</p>
                <?php else : ?>
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"><?= ribuan($totalJmlPendidikan) ?></span>
                            <span>Total Data</span>
                        </p>
                    </div>
                    <!-- /.d-flex  -->
                    <div class="position-relative mb-4">
                        <canvas id="chartPendidikan" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card demografi pendidikan -->

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <?php if ($keyword) echo 'Demografi Umat Yang Masih Bersekolah Lingkungan / Stasi ' . $keywordName;
                        else echo 'Demografi Umat Yang Masih Bersekolah'; ?>
                    </h3>
                </div>
            </div>
            <div class="card-body pb-0">
                <?php if (empty($demoSekolah)) : ?>
                    <p class="lead">Data tidak tersedia.</p>
                <?php else : ?>
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg"><?= ribuan($totalJmlSekolah) ?></span>
                            <span>Total Data</span>
                        </p>
                    </div>
                    <!-- /.d-flex  -->
                    <div class="position-relative mb-4">
                        <canvas id="chartSekolah" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card demografi sekolah -->

    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- ChartJS -->
<script src="/adminlte/plugins/chart.js/Chart.min.js"></script>

<script>
    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }

    // ** CHART KELUARGA
    var chartL = document.getElementById("chartLingkungan").getContext('2d');
    var chartLingkungan = new Chart(chartL, {
        type: 'bar',
        data: {
            labels: <?= json_encode($jmlKeluargaLabel) ?>,
            datasets: [{
                label: 'Jumlah Keluarga',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 236, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: <?= json_encode($jmlKeluargaValue) ?>
            }, ]
        },
        options: barChartOptions
    });

    // ** CHART UMAT
    var chartU = document.getElementById("chartUmat").getContext('2d');
    var chartUmat = new Chart(chartU, {
        type: 'bar',
        data: {
            labels: <?= json_encode($jmlUmatLabel) ?>,
            datasets: [{
                label: 'Jumlah Umat',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: <?= json_encode($jmlUmatValue) ?>
            }, ]
        },
        options: barChartOptions
    });

    // ** CHART UMUR
    if (<?= $demoUmur[0]['tidak_diketahui'] ?> == "0") {
        var dataUmurLabel = ['0-12 Tahun',
            '13-18 Tahun',
            '19-25 Tahun',
            '25-35 Tahun',
            '35-45 Tahun',
            '45-55 Tahun',
            '55-65 Tahun',
            '65+ Tahun'
        ];

        var dataUmurValue = [<?= $demoUmur[0]['dua_belas'] ?>,
            <?= $demoUmur[0]['delapan_belas'] ?>,
            <?= $demoUmur[0]['dua_lima'] ?>,
            <?= $demoUmur[0]['tiga_lima'] ?>,
            <?= $demoUmur[0]['empat_lima'] ?>,
            <?= $demoUmur[0]['lima_lima'] ?>,
            <?= $demoUmur[0]['enam_lima'] ?>,
            <?= $demoUmur[0]['enam_lima_keatas'] ?>
        ];
    } else {
        var dataUmurLabel = ['0-12 Tahun',
            '13-18 Tahun',
            '19-25 Tahun',
            '25-35 Tahun',
            '35-45 Tahun',
            '45-55 Tahun',
            '55-65 Tahun',
            '65+ Tahun',
            'Tidak Diketahui'
        ];

        var dataUmurValue = [<?= $demoUmur[0]['dua_belas'] ?>,
            <?= $demoUmur[0]['delapan_belas'] ?>,
            <?= $demoUmur[0]['dua_lima'] ?>,
            <?= $demoUmur[0]['tiga_lima'] ?>,
            <?= $demoUmur[0]['empat_lima'] ?>,
            <?= $demoUmur[0]['lima_lima'] ?>,
            <?= $demoUmur[0]['enam_lima'] ?>,
            <?= $demoUmur[0]['enam_lima_keatas'] ?>,
            <?= $demoUmur[0]['tidak_diketahui'] ?>
        ];
    }
    var umur = document.getElementById("chartUmur").getContext('2d');
    var chartUmur = new Chart(umur, {
        type: 'bar',
        data: {
            labels: dataUmurLabel,
            datasets: [{
                label: 'Umur',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: dataUmurValue
            }, ]
        },
        options: barChartOptions
    });

    // ** CHART DARAH 
    var chartD = document.getElementById("chartDarah").getContext('2d');
    var chartDarah = new Chart(chartD, {
        type: 'bar',
        data: {
            labels: <?= json_encode($jmlDarahLabel) ?>,
            datasets: [{
                label: 'Jumlah Umat',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: <?= json_encode($jmlDarahValue) ?>
            }, ]
        },
        options: barChartOptions
    });

    // ** CHART PEKERJAAN 
    var chartK = document.getElementById("chartKerja").getContext('2d');
    var chartKerja = new Chart(chartK, {
        type: 'bar',
        data: {
            labels: <?= json_encode($jmlPekerjaanLabel) ?>,
            datasets: [{
                label: 'Jumlah Umat',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: <?= json_encode($jmlPekerjaanValue) ?>
            }, ]
        },
        options: barChartOptions
    });

    // ** CHART PENDIDIKAN 
    var chartP = document.getElementById("chartPendidikan").getContext('2d');
    var chartPendidikan = new Chart(chartP, {
        type: 'bar',
        data: {
            labels: <?= json_encode($jmlPendidikanLabel) ?>,
            datasets: [{
                label: 'Jumlah Umat',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: <?= json_encode($jmlPendidikanValue) ?>
            }, ]
        },
        options: barChartOptions
    });

    // ** CHART SEKOLAH
    var chartS = document.getElementById("chartSekolah").getContext('2d');
    var chartSekolah = new Chart(chartS, {
        type: 'bar',
        data: {
            labels: <?= json_encode($jmlSekolahLabel) ?>,
            datasets: [{
                label: 'Jumlah Umat',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: <?= json_encode($jmlSekolahValue) ?>
            }, ]
        },
        options: barChartOptions
    });
</script>
<?= $this->endSection(); ?>
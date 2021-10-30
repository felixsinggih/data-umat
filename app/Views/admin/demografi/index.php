<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?php
$jmlLingkunganByLingkungan = array();
$namaLingkunganByLingkungan = array();
foreach ($jmlKeluarga as $data) :
    array_push($jmlLingkunganByLingkungan, $data['total']);
    array_push($namaLingkunganByLingkungan, $data['nama']);
endforeach;

$jmlUmatByLingkungan = array();
$namaUmatByLingkungan = array();
foreach ($jmlUmat as $data) :
    array_push($jmlUmatByLingkungan, $data['total']);
    array_push($namaUmatByLingkungan, $data['nama']);
endforeach;
?>
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Jumlah Keluarga Berdasarkan Lingkungan / Stasi</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="chartLingkungan" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
                <p class="lead">Total Keluarga <?= array_sum($jmlLingkunganByLingkungan) ?></p>
            </div>
        </div>
        <!-- /.card -->

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Jumlah Umat Berdasarkan Lingkungan / Stasi</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="chartUmat" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
                <p class="lead">Total Umat <?= array_sum($jmlUmatByLingkungan) ?></p>
            </div>
        </div>
        <!-- /.card -->

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Demografi Berdasarkan Umur</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="chartUmur" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
                <p class="lead">Total Umat <?= $dibawah13['jumlah'] + $dibawah19['jumlah'] + $dibawah25['jumlah'] + $dibawah35['jumlah'] + $dibawah45['jumlah'] + $dibawah55['jumlah'] + $dibawah65['jumlah'] + $diatas65['jumlah'] ?></p>
            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- ChartJS -->
<script src="/adminlte/plugins/chart.js/Chart.min.js"></script>

<script>
    var chartL = document.getElementById("chartLingkungan").getContext('2d');
    var chartLingkungan = new Chart(chartL, {
        type: 'bar',
        data: {
            labels: <?= json_encode($namaLingkunganByLingkungan) ?>,
            datasets: [{
                label: 'Jumlah Keluarga',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 236, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: <?= json_encode($jmlLingkunganByLingkungan) ?>
            }, ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }
    });

    var chartU = document.getElementById("chartUmat").getContext('2d');
    var chartUmat = new Chart(chartU, {
        type: 'bar',
        data: {
            labels: <?= json_encode($namaUmatByLingkungan) ?>,
            datasets: [{
                label: 'Jumlah Umat',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: <?= json_encode($jmlUmatByLingkungan) ?>
            }, ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }
    });

    var umur = document.getElementById("chartUmur").getContext('2d');
    var chartUmur = new Chart(umur, {
        type: 'bar',
        data: {
            labels: ['0-12 Tahun', '13-18 Tahun', '19-24 Tahun', '25-34 Tahun', '35-44 Tahun', '45-54 Tahun', '55-64 Tahun', '65+ Tahun'],
            datasets: [{
                label: 'Umur',
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: false,
                pointColor: '#36a2eb',
                pointStrokeColor: 'rgba(54, 162, 235, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data: [<?= json_encode($dibawah13['jumlah']) ?>, <?= json_encode($dibawah19['jumlah']) ?>, <?= json_encode($dibawah25['jumlah']) ?>, <?= json_encode($dibawah35['jumlah']) ?>, <?= json_encode($dibawah45['jumlah']) ?>, <?= json_encode($dibawah55['jumlah']) ?>, <?= json_encode($dibawah65['jumlah']) ?>, <?= json_encode($diatas65['jumlah']) ?>]
            }, ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }
    });
</script>
<?= $this->endSection(); ?>
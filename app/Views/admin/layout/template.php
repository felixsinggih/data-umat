<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paroki St. Stephanus Cilacap | <?= $title ?></title>
    <link href="/upload/img/<?= session()->get('logoParoki') ?>" rel="shortcut icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <!-- DatePicker -->
    <script src="/datepicker/js/jquery-1.10.2.js"></script>
    <link href="/datepicker/css/bootstrap-datepicker.css" rel="stylesheet" media="screen">
    <link href="/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <!-- DataTables -->
    <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- jQuery-UI -->
    <link rel="stylesheet" href="/adminlte/plugins/jquery-ui/jquery-ui.min.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css"> -->

    <script>
        $(function() {
            $.datepicker.setDefaults({
                monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                // showButtonPanel: true,
                // currentText: "Hari Ini",
                // closeText: "Close",
                nextText: "Berikutnya",
                prevText: "Sebelum",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: "yy-mm-dd",
                yearRange: "-100:+100",
                changeYear: true,
            });
            $("#tgl1").datepicker();
            $("#tgl2").datepicker();
            $("#tgl3").datepicker();
            $("#tgl4").datepicker();
        });
    </script>

    <style>
        .lead {
            font-size: 1rem;
            font-style: italic;
            margin-top: 5px;
        }

        .lead-table {
            font-size: 1rem;
            font-weight: 500;
            font-style: italic;
            margin-left: 0px;
            padding-bottom: 0px;
        }

        a {
            margin-bottom: 2px;
            margin-top: 2px;
        }

        button {
            margin-bottom: 2px;
            margin-top: 2px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include('admin/layout/navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= (session()->get('role') == 'Paroki') ? base_url('/admin') : base_url('lingkungan') ?>" class="brand-link">
                <img src="/upload/img/<?= session()->get('logoParoki') ?>" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Paroki Cilacap</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user  -->
                <?= $this->include('admin/layout/user') ?>

                <!-- SidebarSearch Form -->
                <?= $this->include('admin/layout/sidebar_search') ?>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <?= $this->include('admin/layout/sidebar') ?>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-12">
                            <h1><?= $title ?></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?php if (session()->getflashdata('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getflashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getflashdata('failed')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getflashdata('failed'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Content -->
                    <?= $this->renderSection('content') ?>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2021 <a href="/">Paroki St. Stephanus Cilacap</a>.</strong>
            <!-- <strong>Copyright &copy; 2021 <a href="/">NamaWeb</a>.</strong> All rights reserved. -->
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/adminlte/dist/js/demo.js"></script>
    <!-- DatePicker -->
    <script src="/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/datepicker/js/bootstrap-datetimepicker.js"></script>
    <!-- DataTables -->
    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- jQuery-UI -->
    <script src="/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script> -->

    <script>
        $(function() {
            $('#dataTable1').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });

        function previewFileName() {
            const excel = document.querySelector('#excel_file');
            const excelLabel = document.querySelector('.custom-file-label');
            excelLabel.textContent = excel.files[0].name;
        }
    </script>
</body>

</html>
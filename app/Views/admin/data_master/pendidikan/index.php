<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <div class="card">
        <div class="card-body">
            <table id="dataTable1" class="table table-bordered table-hover table-striped">
                <thead align="center">
                    <tr>
                        <td style="width: 15%">ID</td>
                        <td>Nama Pendidikan</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (25 * ($currentPage - 1));
                    foreach ($pendidikan as $data) : ?>
                        <tr align="center">
                            <td><?= $data['id_pendidikan'] ?></td>
                            <td align="left"><?= $data['nama'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="lead">Menampilkan halaman <?= $pager->getCurrentPage('pendidikan') ?> dari <?= $pager->getPageCount('pendidikan') ?></p>
        </div>
        <!-- /.card-body -->
        <div class="card-footer pb-0">
            <div class="float-right">
                <?= $pager->links('pendidikan', 'paging'); ?>
            </div>
        </div>
        <!-- /.card-footer-->
    </div>
</row>

<?= $this->endSection() ?>
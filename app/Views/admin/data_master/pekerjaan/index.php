<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <div class="card">
        <div class="card-body">
            <table id="dataTable1" class="table table-bordered table-hover table-striped">
                <thead align="center">
                    <tr>
                        <td style="width: 15%">ID</td>
                        <td>Nama Pekerjaan</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (25 * ($currentPage - 1));
                    foreach ($pekerjaan as $data) : ?>
                        <tr align="center">
                            <td><?= $data['id_pekerjaan'] ?></td>
                            <td align="left"><?= $data['nama'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="lead">Menampilkan halaman <?= $pager->getCurrentPage('pekerjaan') ?> dari <?= $pager->getPageCount('pekerjaan') ?></p>
        </div>
        <!-- /.card-body -->
        <div class="card-footer pb-0">
            <div class="float-right">
                <?= $pager->links('pekerjaan', 'paging'); ?>
            </div>
        </div>
        <!-- /.card-footer-->
    </div>
</row>

<?= $this->endSection() ?>
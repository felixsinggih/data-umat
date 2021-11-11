<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <div class="card">
        <div class="card-body pb-0">
            <div class="form-group">
                <a href="/admin/kategorial/add" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Baru</a>
            </div>
            <div class="form-group">
                <table id="dataTable1" class="table table-bordered table-hover table-striped">
                    <thead align="center">
                        <tr>
                            <td style="width: 15%">ID</td>
                            <td>Nama Kelompok Kategorial</td>
                            <td style="width: 100px;">Edit</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (25 * ($currentPage - 1));
                        foreach ($kategorial as $data) : ?>
                            <tr align="center">
                                <td><?= $data['id_kategorial'] ?></td>
                                <td align="left"><?= $data['nama'] ?></td>
                                <td>
                                    <a href="/admin/kategorial/edit/<?= $data['id_kategorial'] ?>" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i> Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="lead">Menampilkan halaman <?= $pager->getCurrentPage('kategorial') ?> dari <?= $pager->getPageCount('kategorial') ?></p>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer pb-0">
            <div class="float-right">
                <?= $pager->links('kategorial', 'paging'); ?>
            </div>
        </div>
        <!-- /.card-footer-->
    </div>
</row>

<?= $this->endSection() ?>
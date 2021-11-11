<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <div class="card">
        <div class="card-body pb-0">
            <div class="form-group">
                <form action="/admin/keluarga" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="te*t" class="form-control" placeholder="Pencarian berdasarkan NO KK / NIK Kepala Keluarga / Nama Kepala Keluarga" name="keyword" value="<?= $keyword; ?>" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-group">
                <a href="/admin/keluarga/add" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                <table id="dataTable1" class="table table-bordered table-hover table-striped">
                    <thead align="center">
                        <tr>
                            <td>NO</td>
                            <td>NO KK</td>
                            <td>NIK</td>
                            <td>Kepala Keluarga</td>
                            <td>Lingkungan/Stasi</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (25 * ($currentPage - 1));
                        foreach ($keluarga as $data) : ?>
                            <tr align="center">
                                <td><?= $i ?></td>
                                <td><?= $data['no_kk'] ?></td>
                                <td><?= $data["nik"] ?></td>
                                <td align="left"><?= $data['nama_lengkap'] ?></td>
                                <td align="left"><?= $data['nama'] ?></td>
                                <td>
                                    <a href="/admin/keluarga/<?= $data['id_keluarga'] ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <p class="lead">Menampilkan halaman <?= $pager->getCurrentPage('keluarga') ?> dari <?= $pager->getPageCount('keluarga') ?></p>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer pb-0">
            <div class="float-right">
                <?= $pager->links('keluarga', 'paging'); ?>
            </div>
        </div>
        <!-- /.card-footer-->
    </div>
</row>

<?= $this->endSection() ?>
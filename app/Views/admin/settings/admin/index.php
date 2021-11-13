<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <div class="card">
        <div class="card-body pb-0">
            <div class="form-group">
                <a href="/admin/paroki/add" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Baru</a>
            </div>
            <div class="form-group">
                <table id="dataTable1" class="table table-bordered table-hover table-striped">
                    <thead align="center">
                        <tr>
                            <td style="width: 10%">NO</td>
                            <td>Nama</td>
                            <td>Username</td>
                            <td style="width: 100px;">Level</td>
                            <td>Lingkungan/ Stasi</td>
                            <td style="width: 110px;">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (25 * ($currentPage - 1));
                        foreach ($admin as $data) : ?>
                            <tr align="center">
                                <td><?= $i ?></td>
                                <td align="left"><?= $data['name'] ?></td>
                                <td align="left"><?= $data['username'] ?></td>
                                <td><?= $data['role'] ?></td>
                                <td><?= ($data['nama'] == null) ? '-' : $data['nama'] ?></td>
                                <td>
                                    <a href="/admin/paroki/<?= $data['uid'] ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="/admin/paroki/edit/<?= $data['uid'] ?>" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="/admin/paroki/delete/<?= $data['uid'] ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data tersebut?');"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
                <p class="lead">Menampilkan halaman <?= $pager->getCurrentPage('admin') ?> dari <?= $pager->getPageCount('admin') ?></p>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer pb-0">
            <div class="float-right">
                <?= $pager->links('admin', 'paging'); ?>
            </div>
        </div>
        <!-- /.card-footer-->
    </div>
</row>

<?= $this->endSection() ?>
<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/layout/fungsi') ?>

<row>
    <div class="card">
        <div class="card-body pb-0">
            <div class="form-group">
                <a href="/admin/paroki" class="btn btn-secondary"><i class="fas fa-undo"></i> Kembali</a>
                <a href="/admin/paroki/edit/<?= $admin['uid'] ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Edit</a>
                <form action="/admin/paroki/delete/<?= $admin['uid'] ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data tersebut?');"><i class="fas fa-trash-alt"></i> Hapus</button>
                </form>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <p class="col-sm-10 col-form-label"><?= $admin['name'] ?></p>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <p class="col-sm-10 col-form-label"><?= ($admin['email'] == '') ? '-' : $data['email'] ?></p>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <p class="col-sm-10 col-form-label"><?= $admin['username'] ?></p>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <p class="col-sm-10 col-form-label"><?= $admin['status'] ?></p>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level Admin</label>
                <p class="col-sm-10 col-form-label"><?= $admin['role'] ?></p>
            </div>
            <?php if ($admin['role'] == 'Lingkungan') : ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lingkungan / Stasi</label>
                    <p class="col-sm-10 col-form-label"><?= $admin['nama'] ?></p>
                </div>
            <?php endif; ?>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Last Update</label>
                <p class="col-sm-10 col-form-label"><?= datetime($admin['updated_at']) ?></p>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</row>

<?= $this->endSection() ?>
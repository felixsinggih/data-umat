<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <div class="card">
        <div class="card-body">
            <form action="/user/password/update" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" id="uid" name="uid" value="<?= $user['uid'] ?>">
                <input type="hidden" id="username" name="username" value="<?= $user['username'] ?>">
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password Saat ni</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?><?= (session()->getflashdata('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                            <?= session()->getflashdata('password'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="newPassword" class="col-sm-3 col-form-label">Password Baru</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control <?= ($validation->hasError('newPassword')) ? 'is-invalid' : ''; ?>" id="newPassword" name="newPassword">
                        <div class="invalid-feedback">
                            <?= $validation->getError('newPassword'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirmPassword" class="col-sm-3 col-form-label">Ketik Ulang Password Baru</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control <?= ($validation->hasError('confirmPassword')) ? 'is-invalid' : ''; ?>" id="confirmPassword" name="confirmPassword">
                        <div class="invalid-feedback">
                            <?= $validation->getError('confirmPassword'); ?>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menyimpan data tersebut?');">Simpan Perubahan</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
</row>

<?= $this->endSection() ?>
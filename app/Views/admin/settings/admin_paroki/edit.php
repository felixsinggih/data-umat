<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <form action="/admin/paroki/update/<?= $admin['uid'] ?>" method="post">
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" value="<?= $admin['username'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= (old('name')) ? old('name') : $admin['name'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= (old('email')) ? old('email') : $admin['email'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="custom-select <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" name="status">
                            <option value="<?= (old('status')) ? old('status') : $admin['status'] ?>">
                                <?= (old('status')) ? old('status') : $admin['status'] ?>
                            </option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                        <i>Hanya diisi bila ingin mereset password!</i>
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menyimpan data tersebut?');">Simpan</button>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </form>
</row>

<?= $this->endSection() ?>
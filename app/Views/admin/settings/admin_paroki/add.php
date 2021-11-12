<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <form action="/admin/paroki/save" method="post">
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= old('name'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="custom-select <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" name="status">
                            <?php if (empty(old('status'))) { ?>
                                <option value="" selected disabled>Pilih Status</option>
                            <?php } else { ?>
                                <option value="<?= old('status') ?>">
                                    <?php if (old('status') == "") echo 'Pilih Status';
                                    else echo old('status'); ?>
                                </option>
                            <?php } ?>
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status'); ?>
                        </div>
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
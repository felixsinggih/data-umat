<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <form action="/lingkungan/keluarga/update/<?= $keluarga['id_keluarga'] ?>" method="post">
        <?= csrf_field(); ?>

        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lingkungan / Stasi</label>
                    <div class="col-sm-9">
                        <label class="col-form-label"><?= $lingkungan['nama'] ?></label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_kk" class="col-sm-3 col-form-label">Nomor Kartu Keluarga</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?><?= (session()->getflashdata('kk')) ? 'is-invalid' : ''; ?>" id="no_kk" name="no_kk" value="<?= (old('no_kk')) ? old('no_kk') : $keluarga['no_kk'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_kk'); ?>
                            <?= session()->getflashdata('kk'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $keluarga['alamat'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rt_rw" class="col-sm-3 col-form-label">RT / RW</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('rt_rw')) ? 'is-invalid' : ''; ?>" id="rt_rw" name="rt_rw" value="<?= (old('rt_rw')) ? old('rt_rw') : $keluarga['rt_rw'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('rt_rw'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelurahan" class="col-sm-3 col-form-label">Kelurahan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('kelurahan')) ? 'is-invalid' : ''; ?>" id="kelurahan" name="kelurahan" value="<?= (old('kelurahan')) ? old('kelurahan') : $keluarga['kelurahan'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kelurahan'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" name="kecamatan" value="<?= (old('kecamatan')) ? old('kecamatan') : $keluarga['kecamatan'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kecamatan'); ?>
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
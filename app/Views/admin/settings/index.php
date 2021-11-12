<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <div class="card">
        <div class="card-body">
            <form action="/admin/setting/update" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" id="id_paroki" name="id_paroki" value="<?= $paroki['id_paroki'] ?>">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Paroki</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $paroki['nama'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" value="<?= (old('telp')) ? old('telp') : $paroki['telp'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('telp'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= (old('email')) ? old('email') : $paroki['email'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" name="alamat" rows="3"><?= (old('alamat')) ? old('alamat') : $paroki['alamat'] ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="logoLama" value="<?= $paroki['logo']; ?>">
                <div class="form-group row">
                    <label for="logo" class="col-sm-2 col-form-label">logo</label>
                    <div class="col-sm-2">
                        <img src="/upload/img/<?= $paroki['logo']; ?>" class="img-thumnail img-preview" width="100%">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('logo')) ? 'is-invalid' : ''; ?>" id="logo" name="logo" onchange="previewImage()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('logo'); ?>
                            </div>
                            <label class="custom-file-label" for="logo"><?= $paroki['logo']; ?></label>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menyimpan data tersebut?');">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
</row>

<script>
    function previewImage() {
        const logo = document.querySelector('#logo');
        const logoLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        logoLabel.textContent = logo.files[0].name;

        const fileLogo = new FileReader();
        fileLogo.readAsDataURL(logo.files[0]);

        fileLogo.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?= $this->endSection() ?>
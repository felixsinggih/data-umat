<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <form action="/admin/keluarga/save" method="post">
        <?= csrf_field(); ?>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Kaluarga</h3>
            </div>
            <div class="card-body pb-0">
                <div class="form-group row">
                    <label for="id_lingkungan" class="col-sm-3 col-form-label">Lingkungan / Stasi</label>
                    <div class="col-sm-9">
                        <select class="custom-select <?= ($validation->hasError('id_lingkungan')) ? 'is-invalid' : ''; ?>" id="id_lingkungan" name="id_lingkungan">
                            <option value="" selected disabled>Pilih Lingkungan / Stasi</option>
                            <?php foreach ($lingkungan as $data) : ?>
                                <option value="<?= $data['id_lingkungan'] ?>"><?= $data['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_lingkungan'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_kk" class="col-sm-3 col-form-label">Nomor Kartu Keluarga</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" id="no_kk" name="no_kk" value="<?= old('no_kk'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_kk'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rt_rw" class="col-sm-3 col-form-label">RT / RW</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('rt_rw')) ? 'is-invalid' : ''; ?>" id="rt_rw" name="rt_rw" value="<?= old('rt_rw'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('rt_rw'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelurahan" class="col-sm-3 col-form-label">Kelurahan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('kelurahan')) ? 'is-invalid' : ''; ?>" id="kelurahan" name="kelurahan" value="<?= old('kelurahan'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kelurahan'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" name="kecamatan" value="<?= old('kecamatan'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kecamatan'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Kepala Keluarga</h3>
            </div>
            <div class="card-body pb-0">
                <div class="form-group row">
                    <label for="nik" class="col-sm-3 col-form-label">Nomor Induk Kependudukan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= old('nik'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_baptis" class="col-sm-3 col-form-label">Nama Baptis</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_baptis')) ? 'is-invalid' : ''; ?>" id="nama_baptis" name="nama_baptis" value="<?= old('nama_baptis'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_baptis'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_lengkap'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_baptis" class="col-sm-3 col-form-label">Tempat Baptis</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('tempat_baptis')) ? 'is-invalid' : ''; ?>" id="tempat_baptis" name="tempat_baptis" value="<?= old('tempat_baptis'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_baptis'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_baptis" class="col-sm-3 col-form-label">Tanggal Baptis</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('tgl_baptis')) ? 'is-invalid' : ''; ?>" id="tgl1" name="tgl_baptis" placeholder="YYYY-MM-DD" value="<?= old('tgl_baptis'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_baptis'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_krisma" class="col-sm-3 col-form-label">Tempat Krisma</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('tempat_krisma')) ? 'is-invalid' : ''; ?>" id="tempat_krisma" name="tempat_krisma" value="<?= old('tempat_krisma'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_krisma'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_krisma" class="col-sm-3 col-form-label">Tanggal Krisma</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('tgl_krisma')) ? 'is-invalid' : ''; ?>" id="tgl2" name="tgl_krisma" placeholder="YYYY-MM-DD" value="<?= old('tgl_krisma'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_krisma'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_menikah" class="col-sm-3 col-form-label">Tempat Menikah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('tempat_menikah')) ? 'is-invalid' : ''; ?>" id="tempat_menikah" name="tempat_menikah" value="<?= old('tempat_menikah'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_menikah'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_menikah" class="col-sm-3 col-form-label">Tanggal Menikah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('tgl_menikah')) ? 'is-invalid' : ''; ?>" id="tgl3" name="tgl_menikah" placeholder="YYYY-MM-DD" value="<?= old('tgl_menikah'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_menikah'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jns_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select class="custom-select <?= ($validation->hasError('jns_kelamin')) ? 'is-invalid' : ''; ?>" id="jns_kelamin" name="jns_kelamin">
                            <?php if (empty(old('jns_kelamin'))) { ?>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <?php } else { ?>
                                <option value="<?= old('jns_kelamin') ?>">
                                    <?php if (old('jns_kelamin') == "") echo 'Pilih Jenis Kelamin';
                                    else echo old('jns_kelamin'); ?>
                                </option>
                            <?php } ?>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jns_kelamin'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gol_darah" class="col-sm-3 col-form-label">Golongan Darah</label>
                    <div class="col-sm-9">
                        <select class="custom-select <?= ($validation->hasError('gol_darah')) ? 'is-invalid' : ''; ?>" id="gol_darah" name="gol_darah">
                            <?php if (empty(old('gol_darah'))) { ?>
                                <option value="" selected disabled>Pilih Golongan Darah</option>
                            <?php } else { ?>
                                <option value="<?= old('gol_darah') ?>">
                                    <?php if (old('gol_darah') == "") echo 'Pilih Jenis Kelamin';
                                    else echo old('gol_darah'); ?>
                                </option>
                            <?php } ?>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('gol_darah'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" value="<?= old('tempat_lahir'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_lahir'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>" id="tgl4" name="tgl_lahir" placeholder="YYYY-MM-DD" value="<?= old('tgl_lahir'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_lahir'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status_keluarga" class="col-sm-3 col-form-label">Status Dalam Keluarga</label>
                    <div class="col-sm-9">
                        <select class="custom-select <?= ($validation->hasError('status_keluarga')) ? 'is-invalid' : ''; ?>" id="status_keluarga" name="status_keluarga">
                            <?php if (empty(old('status_keluarga'))) { ?>
                                <option value="" selected disabled>Pilih Status</option>
                            <?php } else { ?>
                                <option value="<?= old('status_keluarga') ?>">
                                    <?php if (old('status_keluarga') == "") echo 'Pilih Status';
                                    else echo old('status_keluarga'); ?>
                                </option>
                            <?php } ?>
                            <option value="Ayah">Ayah</option>
                            <option value="Ibu">Ibu</option>
                            <option value="Anak">Anak</option>
                            <option value="Keluarga Lain">Keluarga Lain</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status_keluarga'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ayah_kandung" class="col-sm-3 col-form-label">Nama Ayah Kandung</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('ayah_kandung')) ? 'is-invalid' : ''; ?>" id="ayah_kandung" name="ayah_kandung" value="<?= old('ayah_kandung'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('ayah_kandung'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ibu_kandung" class="col-sm-3 col-form-label">Nama Ibu Kandung</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('ibu_kandung')) ? 'is-invalid' : ''; ?>" id="ibu_kandung" name="ibu_kandung" value="<?= old('ibu_kandung'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('ibu_kandung'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_tinggal" class="col-sm-3 col-form-label">Tempat Tinggal Sekarang</label>
                    <div class="col-sm-9">
                        <select class="custom-select <?= ($validation->hasError('tempat_tinggal')) ? 'is-invalid' : ''; ?>" id="tempat_tinggal" name="tempat_tinggal">
                            <?php if (empty(old('tempat_tinggal'))) { ?>
                                <option value="" selected disabled>Pilih Tempat Tinggal</option>
                            <?php } else { ?>
                                <option value="<?= old('tempat_tinggal') ?>">
                                    <?php if (old('tempat_tinggal') == "") echo 'Pilih Status';
                                    else echo old('tempat_tinggal'); ?>
                                </option>
                            <?php } ?>
                            <option value="Di Kabupaten Cilacap">Di Kabupaten Cilacap</option>
                            <option value="Di Luar Kabupaten Cilacap">Di Luar Kabupaten Cilacap</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status_keluarga'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= ($validation->hasError('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" value="<?= old('telp'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('telp'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_pendidikan" class="col-sm-3 col-form-label">Pendidikan Terkahir</label>
                    <div class="col-sm-9">
                        <select class="custom-select <?= ($validation->hasError('id_pendidikan')) ? 'is-invalid' : ''; ?>" id="id_pendidikan" name="id_pendidikan">
                            <option value="" selected disabled>Pilih Pendidikan Terkahir</option>
                            <?php foreach ($pendidikan as $data) : ?>
                                <option value="<?= $data['id_pendidikan'] ?>"><?= $data['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_pendidikan'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                    <div class="col-sm-9">
                        <select class="custom-select <?= ($validation->hasError('id_pekerjaan')) ? 'is-invalid' : ''; ?>" id="id_pekerjaan" name="id_pekerjaan">
                            <option value="" selected disabled>Pilih Pekerjaan</option>
                            <?php foreach ($pekerjaan as $data) : ?>
                                <option value="<?= $data['id_pekerjaan'] ?>"><?= $data['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_pekerjaan'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menyimpan data tersebut?');">Simpan</button>
                </div>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </form>
</row>

<?= $this->endSection() ?>
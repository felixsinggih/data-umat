<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/layout/fungsi') ?>

<row>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Keluarga</h3>
        </div>
        <div class="card-body pb-0">
            <div class="form-group">
                <a href="/admin/keluarga/<?= $keluarga['id_keluarga'] ?>" class="btn btn-secondary"><i class="fas fa-undo"></i> Kembali</a>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Lingkungan / Stasi</label>
                        <p class="col-sm-8 col-form-label"><?= $lingkungan['nama'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nomor Kartu Keluarga</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['no_kk'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Alamat</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['alamat'] ?></p>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-lg-6 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">RT/RW</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['rt_rw'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Desa / Kelurahan</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['kelurahan'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kecamatan</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['kecamatan'] ?></p>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
    </div>

    <!-- /.card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Individu</h3>
        </div>
        <div class="card-body pb-0">
            <div class="form-group">
                <a href="/admin/anggota/edit/<?= $anggota['id_anggota'] ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Edit</a>
                <form action="/admin/anggota/delete/<?= $anggota['id_anggota'] ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data tersebut?');"><i class="fas fa-trash-alt"></i> Hapus</button>
                </form>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">NIK</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['nik'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Baptis</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['nama_baptis'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama lengkap</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['nama_lengkap'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Jenis Kelamin</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['jns_kelamin'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tempat lahir</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['tempat_lahir'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal Lahir</label>
                        <p class="col-sm-8 col-form-label"><?= (!empty($anggota['tgl_lahir'])) ? tanggalLengkap($anggota['tgl_lahir']) : '-' ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Golongan Darah</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['gol_darah'] ?></p>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-lg-6 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Status Dlm Keluarga</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['status_keluarga'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Ayah Kandung</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['ayah_kandung'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Ibu Kandung</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['ibu_kandung'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Domisili Sekarang</label>
                        <p class="col-sm-8 col-form-label"><?= $anggota['tempat_tinggal'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Telepon</label>
                        <p class="col-sm-8 col-form-label"><?= (!empty($anggota['telp'])) ? $anggota['telp'] : '-' ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Pendidikan terkahir</label>
                        <p class="col-sm-8 col-form-label"><?= (!empty($pendidikan)) ? $pendidikan['nama'] : '-' ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Pekerjaan</label>
                        <p class="col-sm-8 col-form-label"><?= (!empty($pekerjaan)) ? $pekerjaan['nama'] : '-' ?></p>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <?php if (!empty($anggota['pertanyaan'])) : ?>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Keterangan</label>
                            <p class="col-sm-8 col-form-label"><?= $anggota['pertanyaan'] ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- /.card  -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Gerejawi</h3>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tempat Baptis</label>
                        <p class="col-sm-8 col-form-label"><?= (!empty($anggota['tempat_baptis'])) ? $anggota['tempat_baptis'] : '-' ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal Baptis</label>
                        <p class="col-sm-8 col-form-label"><?= (!empty($anggota['tgl_baptis'])) ? tanggalLengkap($anggota['tgl_baptis']) : '-' ?></p>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-lg-6 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tempat Krisma</label>
                        <p class="col-sm-8 col-form-label"><?= (!empty($anggota['tempat_krisma'])) ? $anggota['tempat_krisma'] : '-' ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal Krisma</label>
                        <p class="col-sm-8 col-form-label"><?= (!empty($anggota['tgl_krisma'])) ? tanggalLengkap($anggota['tgl_krisma']) : '-' ?></p>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <?php if (!empty($pernikahan)) : ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pernikahan</h3>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tempat Menikah</label>
                            <p class="col-sm-8 col-form-label"><?= $pernikahan['tempat_menikah'] ?></p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Menikah</label>
                            <p class="col-sm-8 col-form-label"><?= (!empty($pernikahan['tgl_menikah'])) ? tanggalLengkap($pernikahan['tgl_menikah']) : '-' ?></p>
                        </div>
                    </div>
                </div>
                <!-- /.row  -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    <?php endif; ?>

    <?php if (!empty($aktivitas) || !empty($kategorial)) : ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kegiatan Masyarakat dan Gereja</h3>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <?php if (!empty($aktivitas)) : ?>
                        <div class="col-lg-6 col-md-12">
                            <label class="col-form-label">Aktivitas Kemasyarakatan</label>
                            <ul class="list-unstyled">
                                <?php foreach ($aktivitas as $data) : ?>
                                    <li><i class="fas fa-angle-right"></i> <?= $data['nama'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($kategorial)) : ?>
                        <div class="col-lg-6 col-md-12">
                            <label class="col-form-label">Kelompok Kategorial Gereja</label>
                            <ul class="list-unstyled">
                                <?php foreach ($kategorial as $data) : ?>
                                    <li><i class="fas fa-angle-right"></i> <?= $data['nama'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- /.row  -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    <?php endif; ?>

    <?php if (!empty($sekolah)) : ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Sekolah (bagi yang masih bersekolah)</h3>
            </div>
            <div class="card-body pb-0">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Satuan Pendidikan</label>
                    <p class="col-sm-9 col-form-label"><?= $sekolah['satuan_pendidikan'] ?></p>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Sekolah / Perguruan Tinggi</label>
                    <p class="col-sm-9 col-form-label"><?= $sekolah['nama'] ?></p>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kelas / Semester</label>
                    <p class="col-sm-9 col-form-label"><?= $sekolah['tingkat_pendidikan'] ?></p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    <?php endif; ?>
</row>

<?= $this->endSection() ?>
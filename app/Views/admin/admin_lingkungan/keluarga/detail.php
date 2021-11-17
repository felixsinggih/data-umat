<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/layout/fungsi') ?>
<row>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <a href="/lingkungan/keluarga" class="btn btn-secondary"><i class="fas fa-undo"></i> Kembali</a>
                <a href="/lingkungan/keluarga/edit/<?= $keluarga['id_keluarga'] ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Edit Data Keluarga</a>
                <a href="/lingkungan/anggota/add/<?= $keluarga['id_keluarga'] ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Anggota Keluarga</a>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kepala Keluaraga</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['no_kk'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kepala Keluaraga</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['nama_lengkap'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Lingkungan / Stasi</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['nama'] ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Alamat</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['alamat'] ?></p>
                    </div>
                </div>
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
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Telp</label>
                        <p class="col-sm-8 col-form-label"><?= $keluarga['telp'] ?></p>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-hover table-striped table-valign-middle table-responsive-lg">
                <thead align="center">
                    <tr>
                        <td rowspan="2" style="width: 50px;">No</td>
                        <td rowspan="2">Nama Lengkap</td>
                        <td rowspan="2">L/P</td>
                        <td colspan="2">KELAHIRAN</td>
                        <td rowspan="2" style="width: 100px;">Status Dalam Keluarga</td>
                        <td rowspan="2">Nama Orang Tua</td>
                        <td rowspan="2">Pendidikan</td>
                        <td rowspan="2" style="width: 130px;">Aksi</td>
                    </tr>
                    <tr>
                        <td>Tempat</td>
                        <td>Tanggal</td>
                    </tr>
                </thead>
                <tbody align="center">
                    <?php $i = 1;
                    foreach ($anggota as $data) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td align="left"><?= $data['nama_lengkap'] ?></td>
                            <td><?= ($data['jns_kelamin'] == 'Laki-laki') ? 'L' : 'P' ?></td>
                            <td><?= $data['tempat_lahir'] ?></td>
                            <td><?= (!empty($data['tgl_lahir'])) ? tanggal($data['tgl_lahir']) : '' ?></td>
                            <td><?= $data['status_keluarga'] ?></td>
                            <td align="left"><?= $data['ayah_kandung'] ?></td>
                            <td>
                                <?php if (!empty($data['satuan_pendidikan'])) :
                                    echo $data['satuan_pendidikan'];
                                else :
                                    if ($data['nama_pendidikan'] == 'Belum Sekolah') :
                                        echo 'BS';
                                    elseif ($data['nama_pendidikan'] == 'Tidak Sekolah') :
                                        echo 'TS';
                                    else :
                                        echo $data['nama_pendidikan'];
                                    endif;
                                endif ?>
                            </td>
                            <td>
                                <a href="/lingkungan/anggota/<?= $data['id_anggota'] ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <a href="/lingkungan/anggota/edit/<?= $data['id_anggota'] ?>" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                <form action="/lingkungan/anggota/delete/<?= $data['id_anggota'] ?>" method="post" class="d-inline">
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

            <br />

            <table class="table table-bordered table-hover table-striped table-valign-middle table-responsive-lg">
                <thead align="center">
                    <tr>
                        <td rowspan="2" style="width: 50px;">No</td>
                        <td colspan="2">BAPTIS</td>
                        <td colspan="2">KRISMA</td>
                        <td colspan="2">PERKAWINAN</td>
                        <td rowspan="2">Gol Darah</td>
                        <td rowspan="2">Pekerjaan</td>
                    </tr>
                    <tr>
                        <td>Tempat</td>
                        <td>Tanggal</td>
                        <td>Tempat</td>
                        <td>Tanggal</td>
                        <td>Tempat</td>
                        <td>Tanggal</td>
                    </tr>
                </thead>
                <tbody align="center">
                    <?php $q = 1;
                    foreach ($anggota as $data) : ?>
                        <tr>
                            <td><?= $q ?></td>
                            <td align="left"><?= $data['tempat_baptis'] ?></td>
                            <td><?= (!empty($data['tgl_baptis'])) ? tanggal($data['tgl_baptis']) : '' ?></td>
                            <td align="left"><?= $data['tempat_krisma'] ?></td>
                            <td><?= (!empty($data['tgl_krisma'])) ? tanggal($data['tgl_krisma']) : '' ?></td>
                            <td align="left"><?= $data['tempat_menikah'] ?></td>
                            <td><?= (!empty($data['tgl_menikah'])) ? tanggal($data['tgl_menikah']) : '' ?></td>
                            <td><?= $data['gol_darah'] ?></td>
                            <td><?= $data['nama_pekerjaan'] ?></td>
                        </tr>
                    <?php $q++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</row>

<?= $this->endSection() ?>
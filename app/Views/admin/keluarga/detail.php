<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/layout/fungsi') ?>

<row>
    <div class="card">
        <div class="card-body">
            <p>
                <a href="/admin/keluarga/print/<?= $keluarga['id_keluarga'] ?>" target="_blank" class="btn btn-danger"><i class="fas fa-print"></i> Cetak</a>
            </p>

            <table class="table table-hover">
                <tr>
                    <th>Nama Kepala Keluarga</th>
                    <td><?= $anggota[0]['nama_lengkap'] ?></td>
                    <th>Kecamatan</th>
                    <td><?= $keluarga['kecamatan'] ?></td>
                </tr>
                <tr>
                    <th>Lingkungan / Stasi</th>
                    <td><?= $lingkungan['nama'] ?></td>
                    <th>Nama Kepala Keluarga</th>
                    <td><?= $keluarga['alamat'] ?></td>
                </tr>
                <tr>
                    <th>Desa / Kelurahan</th>
                    <td><?= $keluarga['kelurahan'] ?></td>
                    <th>Telp</th>
                    <td><?= $anggota[0]['telp'] ?></td>
                </tr>
            </table>

            <br />

            <table class="table table-bordered table-hover table-striped table-valign-middle">
                <thead align="center">
                    <tr>
                        <td rowspan="2" style="width: 50px;">No</td>
                        <td rowspan="2">Nama Lengkap</td>
                        <td rowspan="2">L/P</td>
                        <td colspan="2">KELAHIRAN</td>
                        <td rowspan="2">Status</td>
                        <td rowspan="2" style="width: 100px;">Status Dalam Keluarga</td>
                        <td rowspan="2">Agama</td>
                        <td rowspan="2">Nama Orang Tua</td>
                        <td rowspan="2">Pendidikan</td>
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
                            <td><?= tanggal($data['tgl_lahir']) ?></td>
                            <td></td>
                            <td><?= $data['status_keluarga'] ?></td>
                            <td></td>
                            <td align="left"><?= $data['ayah_kandung'] ?></td>
                            <td><?= ($data['nama_pendidikan'] == 'Belum Sekolah') ? 'BS' : (($data['nama_pendidikan'] == 'Tidak Sekolah') ? 'TS' : $data['nama_pendidikan']) ?></td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>

            <br />

            <table class="table table-bordered table-hover table-striped table-valign-middle">
                <thead align="center">
                    <tr>
                        <td rowspan="2" style="width: 50px;">No</td>
                        <td colspan="2">BAPTIS</td>
                        <td colspan="2">KRISMA</td>
                        <td colspan="2">PERKAWINAN</td>
                        <td rowspan="2">Gol Darah</td>
                        <td rowspan="2">Status Gerejawi</td>
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
                            <td align="left"><?= (!empty($data['tempat_baptis'])) ? $data['tempat_baptis'] : '-' ?></td>
                            <td><?= (!empty($data['tgl_baptis'])) ? tanggal($data['tgl_baptis']) : '-' ?></td>
                            <td align="left"><?= (!empty($data['tempat_krisma'])) ? $data['tempat_krisma'] : '-' ?></td>
                            <td><?= (!empty($data['tgl_krisma'])) ? tanggal($data['tgl_krisma']) : '-' ?></td>
                            <td align="left"><?= (!empty($data['tempat_menikah'])) ? $data['tempat_menikah'] : '-' ?></td>
                            <td><?= (!empty($data['tgl_menikah'])) ? tanggal($data['tgl_menikah']) : '-' ?></td>
                            <td><?= $data['gol_darah'] ?></td>
                            <td><?= (!empty($data['nama_baptis'])) ? 'Baptis' : '-' ?></td>
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
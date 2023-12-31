<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- <link href="/logo-koperasi.ico" rel="shortcut icon"> -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 0.75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #ffffff;
        }

        table {
            border-collapse: collapse;
        }

        .table table {
            width: 100%;
        }

        .table tbody tr {
            vertical-align: baseline;
        }

        .table tbody th,
        td {
            padding: 5px;
        }

        h4 {
            font-family: inherit;
            display: inline-block;
            font-weight: 700;
            font-size: 1.75rem;
            border: none;
            margin: 0px;
            padding: 0px;
        }

        p {
            font-size: 1.5rem;
            line-height: 0;
            margin: 0px;
            padding: 0px;
            border: none;
        }

        img {
            width: 80px;
        }
    </style>

    <?php
    function tanggal($tanggal)
    {
        $bulan = array(
            1 => 'JAN',
            'FEB',
            'MAR',
            'APR',
            'MEI',
            'JUN',
            'JUL',
            'AGS',
            'SEP',
            'OKT',
            'NOV',
            'DES'
        );
        $p = explode('-', $tanggal);
        return $p[2] . ' ' . $bulan[(int)$p[1]] . ' ' . $p[0];
    }

    $image = FCPATH . 'upload/img/' . $paroki['logo'];
    ?>
</head>

<body>
    <table>
        <tr>
            <td><img src="data:image/png;base64,<?= base64_encode(file_get_contents($image)) ?>" alt=""></td>
            <td>
                <h4>DATA KELUARGA KATOLIK</h4><br />
                PAROKI St. STEPHANUS CILACAP
            </td>
        </tr>
    </table>
    <hr />
    <br />

    <div class="table">
        <table>
            <tbody align="left">
                <tr>
                    <th>Nomor Kartu Keluarga</th>
                    <td><?= $keluarga['no_kk'] ?></td>
                    <th>Alamat</th>
                    <td><?= $keluarga['alamat'] ?></td>
                    <th>Kecamatan</th>
                    <td><?= $keluarga['kecamatan'] ?></td>
                </tr>
                <tr>
                    <th>Nama Kepala Keluarga</th>
                    <td><?= $keluarga['nama_lengkap'] ?></td>
                    <th>RT/RW</th>
                    <td><?= $keluarga['rt_rw'] ?></td>
                    <th>Telp</th>
                    <td><?= $keluarga['telp'] ?></td>
                </tr>
                <tr>
                    <th>Lingkungan / Stasi</th>
                    <td><?= $keluarga['nama'] ?></td>
                    <th>Desa / Kelurahan</th>
                    <td><?= $keluarga['kelurahan'] ?></td>
                </tr>
            </tbody>
        </table>

        <br />

        <table border="1">
            <thead align="center">
                <tr>
                    <td rowspan="2" style="width: 50px;">No</td>
                    <td rowspan="2">Nama Lengkap</td>
                    <td rowspan="2">L/P</td>
                    <td colspan="2">KELAHIRAN</td>
                    <td rowspan="2" style="width: 100px;">Status Dalam Keluarga</td>
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
                        <td><?= $data['status_keluarga'] ?></td>
                        <td align="left"><?= $data['ayah_kandung'] ?></td>
                        <td><?php if (!empty($data['satuan_pendidikan'])) :
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
                    </tr>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>

        <br />

        <table border="1">
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
                        <td align="left"><?= (!empty($data['tempat_baptis'])) ? $data['tempat_baptis'] : '' ?></td>
                        <td><?= (!empty($data['tgl_baptis'])) ? tanggal($data['tgl_baptis']) : '' ?></td>
                        <td align="left"><?= (!empty($data['tempat_krisma'])) ? $data['tempat_krisma'] : '' ?></td>
                        <td><?= (!empty($data['tgl_krisma'])) ? tanggal($data['tgl_krisma']) : '' ?></td>
                        <td align="left"><?= (!empty($data['tempat_menikah'])) ? $data['tempat_menikah'] : '' ?></td>
                        <td><?= (!empty($data['tgl_menikah'])) ? tanggal($data['tgl_menikah']) : '' ?></td>
                        <td><?= $data['gol_darah'] ?></td>
                        <td><?= ($data['nama_baptis'] != null || $data['tgl_baptis'] != null) ? 'Baptis' : '' ?></td>
                        <td><?= $data['nama_pekerjaan'] ?></td>
                    </tr>
                <?php $q++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
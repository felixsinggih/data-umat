<?php

namespace app\Controllers\Admin;

use App\Controllers\Admin\Lingkungan;
use App\Controllers\Admin\Pendidikan;
use App\Controllers\Admin\Pekerjaan;

use App\Controllers\BaseController;

use App\Models\KeluargaModel;
use App\Models\AnggotaModel;
use App\Models\DetailPernikahanModel;
use App\Models\DetailPendidikanModel;
use App\Models\DetailPekerjaanModel;
use App\Models\DetailSekolahModel;

class Keluarga extends BaseController
{
    function __construct()
    {
        $this->lingkungan = new Lingkungan();
        $this->pendidikan = new Pendidikan();
        $this->pekerjaan = new Pekerjaan();
        $this->keluargaModel = new KeluargaModel();
        $this->anggotaModel = new AnggotaModel();
        $this->detPernikahanModel = new DetailPernikahanModel();
        $this->detPendidikanModel = new DetailPendidikanModel();
        $this->detPekerjaanModel = new DetailPekerjaanModel();
        $this->detSekolahModel = new DetailSekolahModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Keluarga',
            'validation' => \Config\Services::validation(),
            'act'   => ['keluarga', ''],
        ];
        return view('admin/keluarga/index', $data);
    }

    public function ex()
    {

        $data = [
            'title' => 'Export Data',
            'validation' => \Config\Services::validation(),
            'act'   => ['keluarga', ''],
        ];
        return view('admin/keluarga/export', $data);
    }

    public function export()
    {
        $fileExcel = $this->request->getFile('excel_file');
        $extension = $fileExcel->getClientExtension(); // ambil extension dari file excel
        if ('xls' == $extension) { // format excel 2007 ke bawah
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else { // format excel 2010 ke atas
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($fileExcel);
        $data = $spreadsheet->setActiveSheetIndex(1)->toArray();
        $keluraga = array();
        $pendidikan = array();
        $pekerjaan = array();
        foreach ($data as $idx => $row) :
            if ($idx < 1) continue;

            $idLingkungan = $this->lingkungan->cariLingkungan($row[0]);
            $idKeluarga = $this->keluargaModel->kodegenKeluarga($idLingkungan);

            $keluargaSatuan = [
                'id_lingkungan' => $idLingkungan,
                'id_keluarga' => $idKeluarga,
                'no_kk' => $row[1],
                'alamat' => $row[4], // ** jalan
                'rt_rw' => $row[5],
                'kelurahan' => $row[6],
                'kecamatan' => $row[3],
                // 'nik' => $row[7],
            ];
            array_push($keluraga, $keluargaSatuan);

            $this->keluargaModel->insert($keluargaSatuan);
        endforeach;

        $data = $spreadsheet->setActiveSheetIndex(2)->toArray();
        $ayah = array();
        $pernikahan = array();

        foreach ($data as $idx => $row) :
            if ($idx < 1) continue;

            $idKeluarga = $this->keluargaModel->where('no_kk', $row[0])->first();
            $idAnggota = $this->anggotaModel->kodegenAnggota($idKeluarga['id_keluarga']);

            $ayahSatuan = [
                'id_keluarga' => $idKeluarga['id_keluarga'],
                'id_anggota' => $idAnggota,
                // 'no_kk' => $row[0],
                'nik' => ($row[3] == null) ? null : $row[3],
                'nama_baptis' => ($row[1] == null) ? null : $row[1],
                'nama_lengkap' => ($row[2] == null) ? null : $row[2],
                'tempat_baptis' => ($row[4] == null) ? null : $row[4],
                'tgl_baptis' => ($row[5] == null) ? null : $row[5],
                'tempat_krisma' => ($row[6] == null) ? null : $row[6],
                'tgl_krisma' => ($row[7] == null) ? null : $row[7],
                'jns_kelamin' => ($row[22] == null) ? null : $row[22], // ** tambahan
                'gol_darah' => ($row[10] == null) ? null : $row[10],
                'tempat_lahir' => ($row[11] == null) ? null : $row[11],
                'tgl_lahir' => ($row[12] == null) ? null : $row[12],
                'status_keluarga' => ($row[23] == null) ? null : $row[23], // ** tambahan
                'ayah_kandung' => ($row[13] == null) ? null : $row[13],
                'ibu_kandung' => ($row[14] == null) ? null : $row[14],
                // 'id_pendidikan' => ($row[15] == null) ? null : $this->pendidikan->cariPendidikan($row[15]),
                // 'id_pekerjaan' => ($row[16] == null) ? null : $this->pekerjaan->cariPekerjaan($row[16]),
                'pertanyaan' => ($row[19] == null) ? null : $row[19],
                'tempat_tinggal' => ($row[20] == null) ? null : $row[20],
                'telp' => ($row[21] == null) ? null : $row[21],
            ];

            if (!empty($ayahSatuan['nik'])) {
                array_push($ayah, $ayahSatuan);
                $this->anggotaModel->insert($ayahSatuan);
            }

            $pernikahanAyah = [
                'id_anggota' => $idAnggota,
                'tempat_menikah' => ($row[8] == null) ? null : $row[8],
                'tgl_menikah' => ($row[9] == null) ? null : $row[9],
            ];

            if (!empty($pernikahanAyah['tempat_menikah']) || !empty($pernikahanAyah['tgl_menikah'])) {
                array_push($pernikahan, $pernikahanAyah);
            }

            if (!empty($row[3]) && !empty($row[15])) {
                array_push($pendidikan, [
                    'id_anggota' => $idAnggota,
                    'id_pendidikan' => $this->pendidikan->cariPendidikan($row[15])
                ]);
            }

            if (!empty($row[3]) && !empty($row[16])) {
                array_push($pekerjaan, [
                    'id_anggota' => $idAnggota,
                    'id_pekerjaan' => $this->pekerjaan->cariPekerjaan($row[16])
                ]);
            }
        endforeach;

        $data = $spreadsheet->setActiveSheetIndex(3)->toArray();
        $ibu = array();
        foreach ($data as $idx => $row) :
            if ($idx < 1) continue;

            $idKeluarga = $this->keluargaModel->where('no_kk', $row[0])->first();
            $idAnggota = $this->anggotaModel->kodegenAnggota($idKeluarga['id_keluarga']);

            $ibuSatuan = [
                'id_keluarga' => $idKeluarga['id_keluarga'],
                'id_anggota' => $idAnggota,
                // 'no_kk' => $row[0],
                'nik' => ($row[3] == null) ? null : $row[3],
                'nama_baptis' => ($row[1] == null) ? null : $row[1],
                'nama_lengkap' => ($row[2] == null) ? null : $row[2],
                'tempat_baptis' => ($row[4] == null) ? null : $row[4],
                'tgl_baptis' => ($row[5] == null) ? null : $row[5],
                'tempat_krisma' => ($row[6] == null) ? null : $row[6],
                'tgl_krisma' => ($row[7] == null) ? null : $row[7],
                'jns_kelamin' => ($row[22] == null) ? null : $row[22], // ** tambahan
                'gol_darah' => ($row[10] == null) ? null : $row[10],
                'tempat_lahir' => ($row[11] == null) ? null : $row[11],
                'tgl_lahir' => ($row[12] == null) ? null : $row[12],
                'status_keluarga' => ($row[23] == null) ? null : $row[23], // ** tambahan
                'ayah_kandung' => ($row[13] == null) ? null : $row[13],
                'ibu_kandung' => ($row[14] == null) ? null : $row[14],
                // 'id_pendidikan' => ($row[15] == null) ? null : $this->pendidikan->cariPendidikan($row[15]),
                // 'id_pekerjaan' => ($row[16] == null) ? null : $this->pekerjaan->cariPekerjaan($row[16]),
                'pertanyaan' => ($row[19] == null) ? null : $row[19],
                'tempat_tinggal' => ($row[20] == null) ? null : $row[20],
                'telp' => ($row[21] == null) ? null : $row[21],
            ];

            if (!empty($ibuSatuan['nik'])) {
                array_push($ibu, $ibuSatuan);
                $this->anggotaModel->insert($ibuSatuan);
            }

            $pernikahanIbu = [
                'id_anggota' => $idAnggota,
                'tempat_menikah' => ($row[8] == null) ? null : $row[8],
                'tgl_menikah' => ($row[9] == null) ? null : $row[9],
            ];

            if (!empty($pernikahanIbu['tempat_menikah']) || !empty($pernikahanIbu['tgl_menikah'])) {
                array_push($pernikahan, $pernikahanIbu);
            }

            if (!empty($row[3]) && !empty($row[15])) {
                array_push($pendidikan, [
                    'id_anggota' => $idAnggota,
                    'id_pendidikan' => $this->pendidikan->cariPendidikan($row[15])
                ]);
            }

            if (!empty($row[3]) && !empty($row[16])) {
                array_push($pekerjaan, [
                    'id_anggota' => $idAnggota,
                    'id_pekerjaan' => $this->pekerjaan->cariPekerjaan($row[16]),
                ]);
            }
        endforeach;

        $keluargaLain = array();
        $sekolah = array();
        for ($i = 4; $i < 8; $i++) {
            $data = $spreadsheet->setActiveSheetIndex($i)->toArray();

            foreach ($data as $idx => $row) :
                if ($idx < 1) continue;

                $idKeluarga = $this->keluargaModel->where('no_kk', $row[0])->first();
                $idAnggota = $this->anggotaModel->kodegenAnggota($idKeluarga['id_keluarga']);

                $keluargaLainSatuan = [
                    'id_keluarga' => $idKeluarga['id_keluarga'],
                    'id_anggota' => $idAnggota,
                    // 'no_kk' => $row[0],
                    'nik' => ($row[3] == null) ? null : $row[3],
                    'nama_baptis' => ($row[1] == null) ? null : $row[1],
                    'nama_lengkap' => ($row[2] == null) ? null : $row[2],
                    'tempat_baptis' => ($row[4] == null) ? null : $row[4],
                    'tgl_baptis' => ($row[5] == null) ? null : $row[5],
                    'tempat_krisma' => ($row[6] == null) ? null : $row[6],
                    'tgl_krisma' => ($row[7] == null) ? null : $row[7],
                    'jns_kelamin' => ($row[8] == null) ? null : $row[8], // ** tambahan
                    'gol_darah' => ($row[9] == null) ? null : $row[9],
                    'tempat_lahir' => ($row[10] == null) ? null : $row[10],
                    'tgl_lahir' => ($row[11] == null) ? null : $row[11],
                    'status_keluarga' => ($row[12] == null) ? null : $row[12], // ** tambahan
                    'ayah_kandung' => ($row[13] == null) ? null : $row[13],
                    'ibu_kandung' => ($row[14] == null) ? null : $row[14],
                    // 'id_pendidikan' => ($row[15] == null) ? null : $this->pendidikan->cariPendidikan($row[15]),
                    // 'id_pekerjaan' => ($row[16] == null) ? null : $this->pekerjaan->cariPekerjaan($row[16]),
                    'pertanyaan' => ($row[19] == null) ? null : $row[19],
                    'tempat_tinggal' => ($row[20] == null) ? null : $row[20],
                    'telp' => ($row[21] == null) ? null : $row[21],
                ];

                if (!empty($keluargaLainSatuan['nik'])) {
                    array_push($keluargaLain, $keluargaLainSatuan);
                    $this->anggotaModel->insert($keluargaLainSatuan);
                }

                if (!empty($row[3]) && !empty($row[15])) {
                    array_push($pendidikan, [
                        'id_anggota' => $idAnggota,
                        'id_pendidikan' => $this->pendidikan->cariPendidikan($row[15])
                    ]);
                }

                if (!empty($row[3]) && !empty($row[16])) {
                    array_push($pekerjaan, [
                        'id_anggota' => $idAnggota,
                        'id_pekerjaan' => $this->pekerjaan->cariPekerjaan($row[16])
                    ]);
                }

                $sekolahSatuan = [
                    'id_anggota' => $idAnggota,
                    'satuan_pendidikan' => ($row[22] == null) ? null : $row[22],
                    'nama' => ($row[23] == null) ? null : $row[23],
                    'tingkat_pendidikan' => ($row[24] == null) ? null : $row[24],
                ];

                if (!empty($sekolahSatuan['satuan_pendidikan'])) {
                    array_push($sekolah, $sekolahSatuan);
                }
            endforeach;
        }

        $this->detPernikahanModel->insertBatch($pernikahan);
        $this->detPendidikanModel->insertBatch($pendidikan);
        $this->detPekerjaanModel->insertBatch($pekerjaan);
        $this->detSekolahModel->insertBatch($sekolah);

        dd($data, $keluraga, $ayah, $ibu, $keluargaLain, $pernikahan, $pendidikan, $pekerjaan, $sekolah);
    }
}

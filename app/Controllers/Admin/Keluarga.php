<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\KeluargaModel;
use App\Models\LingkunganModel;
use App\Models\AnggotaModel;
use App\Models\PendidikanModel;
use App\Models\PekerjaanModel;
use App\Models\AktivitasModel;
use App\Models\KategorialModel;

use App\Models\DetailPernikahanModel;
use App\Models\DetailPendidikanModel;
use App\Models\DetailPekerjaanModel;
use App\Models\DetailSekolahModel;
use App\Models\DetailAktivitasModel;
use App\Models\DetailKategorialModel;

use Dompdf\Dompdf;

class Keluarga extends BaseController
{
    protected $keluargaModel;
    protected $lingkunganModel;
    protected $anggotaModel;
    protected $pendidikanModel;
    protected $pekerjaanModel;
    protected $aktivitasModel;
    protected $kategorialModel;
    protected $detPernikahanModel;
    protected $detPendidikanModel;
    protected $detPekerjaanModel;
    protected $detSekolahModel;
    protected $detAktivitasModel;
    protected $detKategorialModel;


    function __construct()
    {
        $this->keluargaModel = new KeluargaModel();
        $this->lingkunganModel = new LingkunganModel();
        $this->anggotaModel = new AnggotaModel();
        $this->pendidikanModel = new PendidikanModel();
        $this->pekerjaanModel = new PekerjaanModel();
        $this->aktivitasModel = new AktivitasModel();
        $this->kategorialModel = new KategorialModel();
        $this->detPernikahanModel = new DetailPernikahanModel();
        $this->detPendidikanModel = new DetailPendidikanModel();
        $this->detPekerjaanModel = new DetailPekerjaanModel();
        $this->detSekolahModel = new DetailSekolahModel();
        $this->detAktivitasModel = new DetailAktivitasModel();
        $this->detKategorialModel = new DetailKategorialModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_keluarga') ? $this->request->getVar('page_keluarga') : 1;
        $keyword = $this->request->getVar('keyword');
        $keluarga = $this->keluargaModel->viewAll($keyword);

        $data = [
            'title'     => 'Data Keluarga',
            'act'       => ['keluarga', 'lihat'],
            'keyword'   => $keyword,
            'keluarga'  => $keluarga->paginate(25, 'keluarga'),
            'pager'     => $this->keluargaModel->pager,
            'currentPage' => $currentpage
        ];
        return view('admin/keluarga/index', $data);
    }

    public function add()
    {
        $data = [
            'title'     => 'Tambah Data Keluarga',
            'lingkungan' => $this->lingkunganModel->findAll(),
            'pendidikan' => $this->pendidikanModel->findAll(),
            'pekerjaan' => $this->pekerjaanModel->findAll(),
            'aktivitas' => $this->aktivitasModel->findAll(),
            'kategorial' => $this->kategorialModel->findAll(),
            'act'       => ['keluarga', 'tambah'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/keluarga/add', $data);
    }

    public function addData()
    {
        if (!$this->validate([
            'id_lingkungan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lingkungan / Stasi wajib diisi!',
                ]
            ],
            'no_kk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor Kartu Keluarga wajib diisi!',
                    'numeric' => 'Nomor Kartu Keluarga hanya dapat diisi dengan angka!'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi!'
                ]
            ],
            'rt_rw' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'RT / RW wajib diisi!'
                ]
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelurahan wajib diisi!'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kecamatan wajib diisi!'
                ]
            ],
            'nik' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor Induk Kependudukan wajib diisi!',
                    'numeric' => 'Nomor Induk Kependudukan hanya dapat diisi dengan angka!'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi!'
                ]
            ],
            'jns_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin wajib diisi!'
                ]
            ],
            'status_keluarga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih status dalam keluarga!'
                ]
            ],
        ])) {
            return redirect()->to('/admin/keluarga/add')->withInput();
        }

        $idKeluarga = $this->keluargaModel->kodegenKeluarga($this->request->getVar('id_lingkungan'));
        $keluarga = [
            'id_lingkungan' => $this->request->getVar('id_lingkungan'),
            'id_keluarga'   => $idKeluarga,
            'no_kk'         => $this->request->getVar('no_kk'),
            'alamat'        => $this->request->getVar('alamat'),
            'rt_rw'         => $this->request->getVar('rt_rw'),
            'kelurahan'     => $this->request->getVar('kelurahan'),
            'kecamatan'     => $this->request->getVar('kecamatan'),
        ];

        $idAnggota = $this->anggotaModel->kodegenAnggota($idKeluarga);
        $anggota = [
            'id_keluarga'   => $idKeluarga,
            'id_anggota'    => $idAnggota,
            'nik'           => $this->request->getVar('nik'),
            'nama_baptis'   => $this->request->getVar('nama_baptis'),
            'nama_lengkap'  => $this->request->getVar('nama_lengkap'),
            'tempat_baptis' => $this->request->getVar('tempat_baptis'),
            'tgl_baptis'    => ($this->request->getVar('tgl_baptis') != '') ? $this->request->getVar('tgl_baptis') : null,
            'tempat_krisma' => $this->request->getVar('tempat_krisma'),
            'tgl_krisma'    => ($this->request->getVar('tgl_krisma') != '') ? $this->request->getVar('tgl_krisma') : null,
            'jns_kelamin'   => $this->request->getVar('jns_kelamin'),
            'gol_darah'     => $this->request->getVar('gol_darah'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'tgl_lahir'     => ($this->request->getVar('tgl_lahir') != '') ? $this->request->getVar('tgl_lahir') : null,
            'status_keluarga' => $this->request->getVar('status_keluarga'),
            'ayah_kandung'  => $this->request->getVar('ayah_kandung'),
            'ibu_kandung'   => $this->request->getVar('ibu_kandung'),
            'tempat_tinggal' => $this->request->getVar('tempat_tinggal'),
            'telp'          => $this->request->getVar('telp'),
            'is_head'       => 'Y'
        ];

        $pendidikan = [
            'id_anggota'    => $idAnggota,
            'id_pendidikan' => $this->request->getVar('id_pendidikan'),
        ];

        $pekerjaan = [
            'id_anggota'    => $idAnggota,
            'id_pekerjaan'  => $this->request->getVar('id_pekerjaan'),
        ];

        $pernikahan = [
            'id_anggota'    => $idAnggota,
            'tempat_menikah' => ($this->request->getVar('tempat_menikah') != '') ? $this->request->getVar('tempat_menikah') : null,
            'tgl_menikah'  => ($this->request->getVar('tgl_menikah') != '') ? $this->request->getVar('tgl_menikah') : null,
        ];

        $aktivitas = array();
        $aktivitasForm = $this->request->getPost('aktivitas');
        if (!empty($aktivitasForm)) {
            foreach ($aktivitasForm as $data) :
                array_push($aktivitas, [
                    'id_anggota' => $idAnggota,
                    'id_aktivitas' => $data
                ]);
            endforeach;
        }

        $kategorial = array();
        $kategorialForm = $this->request->getPost('kategorial');
        if (!empty($kategorialForm)) {
            foreach ($kategorialForm as $data) :
                array_push($kategorial, [
                    'id_anggota' => $idAnggota,
                    'id_kategorial' => $data
                ]);
            endforeach;
        }

        $this->db->transStart();
        $this->keluargaModel->insert($keluarga);
        $this->anggotaModel->insert($anggota);

        if (!empty($pendidikan['id_pendidikan'])) $this->detPendidikanModel->insert($pendidikan);

        if (!empty($pekerjaan['id_pekerjaan'])) $this->detPekerjaanModel->insert($pekerjaan);

        if (!empty($pernikahan['tempat_menikah']) || !empty($pernikahan['tgl_menikah'])) $this->detPernikahanModel->insert($pernikahan);

        if (!empty($aktivitasForm)) $this->detAktivitasModel->insertBatch($aktivitas);

        if (!empty($kategorialForm)) $this->detKategorialModel->insertBatch($kategorial);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data keluarga gagal disimpan.');
            return redirect()->to('/admin/keluarga/add')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data keluarga berhasil disimpan.');
            return redirect()->to('/admin/keluarga/' . $idKeluarga);
        }
    }

    public function edit($idKeluarga = false)
    {

        $keluarga = $this->keluargaModel->find($idKeluarga);
        if (empty($keluarga)) {
            session()->setflashdata('failed', 'Data tidak ditemukan.');
            return redirect()->to('/admin/keluarga');
        }

        $data = [
            'title'     => 'Edit Data Keluarga',
            'keluarga'  => $keluarga,
            'lingkungan' => $this->lingkunganModel->findAll(),
            'lingkunganKeluarga' => $this->lingkunganModel->find($keluarga['id_lingkungan']),
            'act'       => ['keluarga', 'lihat'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/keluarga/edit', $data);
    }

    public function editData($idKeluarga)
    {
        if (!$this->validate([
            'id_lingkungan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lingkungan / Stasi wajib diisi!',
                ]
            ],
            'no_kk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor Kartu Keluarga wajib diisi!',
                    'numeric' => 'Nomor Kartu Keluarga hanya dapat diisi dengan angka!'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi!'
                ]
            ],
            'rt_rw' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'RT / RW wajib diisi!'
                ]
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelurahan wajib diisi!'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kecamatan wajib diisi!'
                ]
            ],
        ])) {
            return redirect()->to('/admin/keluarga/edit/' . $idKeluarga)->withInput();
        }

        $data = $this->keluargaModel->find($idKeluarga);
        $keluarga = [
            'id_lingkungan' => $this->request->getVar('id_lingkungan'),
            'id_keluarga'   => $data['id_keluarga'],
            'no_kk'         => $this->request->getVar('no_kk'),
            'alamat'        => $this->request->getVar('alamat'),
            'rt_rw'         => $this->request->getVar('rt_rw'),
            'kelurahan'     => $this->request->getVar('kelurahan'),
            'kecamatan'     => $this->request->getVar('kecamatan'),
        ];

        $this->db->transStart();
        $this->keluargaModel->update($keluarga['id_keluarga'], $keluarga);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data keluarga gagal diubah.');
            return redirect()->to('/admin/keluarga/edit/' . $idKeluarga)->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data keluarga berhasil diubah.');
            return redirect()->to('/admin/keluarga/' . $idKeluarga);
        }
    }

    public function detail($idKeluarga = false)
    {

        $keluarga = $this->keluargaModel->find($idKeluarga);
        if (empty($keluarga)) {
            session()->setflashdata('failed', 'Data tidak ditemukan.');
            return redirect()->to('/admin/keluarga');
        }

        $data = [
            'title'     => 'Detail Keluarga',
            'keluarga'  => $keluarga,
            'lingkungan' =>  $this->lingkunganModel->find($keluarga['id_lingkungan']),
            'anggota'   => $this->anggotaModel->dataAnggota($idKeluarga),
            'act'       => ['keluarga', 'lihat'],
        ];
        return view('admin/keluarga/detail', $data);
    }

    public function print($idKeluarga = false)
    {
        $keluarga = $this->keluargaModel->find($idKeluarga);
        if (empty($keluarga)) {
            session()->setflashdata('failed', 'Data tidak ditemukan.');
            return redirect()->to('/admin/keluarga');
        }

        $data = [
            'title'    => "Laporan Barang Masuk ",
            'keluarga' => $keluarga,
            'lingkungan' =>  $this->lingkunganModel->find($keluarga['id_lingkungan']),
            'anggota' => $this->anggotaModel->dataAnggota($idKeluarga)->findAll(),
        ];

        $fileName = "KartuKeluargaKatolik_" . $keluarga['no_kk'] . ".pdf";
        $html = view('admin/keluarga/print', $data);
        $dompdf = new Dompdf();
        $dompdf->setPaper('legal', 'landscape');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream($fileName);
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
        $aktivitas = array();
        $kategorial = array();

        foreach ($data as $idx => $row) :
            if ($idx < 1) continue;

            $idLingkungan = $this->lingkunganModel->cariLingkunganExport($row[0]);
            $idKeluarga = $this->keluargaModel->kodegenKeluarga($idLingkungan);

            $keluargaSatuan = [
                'id_lingkungan' => $idLingkungan,
                'id_keluarga' => $idKeluarga,
                'no_kk' => $row[1],
                'alamat' => $row[4], // ** jalan
                'rt_rw' => $row[5],
                'kelurahan' => $row[6],
                'kecamatan' => $row[3],
            ];
            array_push($keluraga, $keluargaSatuan);

            $this->keluargaModel->insert($keluargaSatuan);
        endforeach;

        $data = $spreadsheet->setActiveSheetIndex(2)->toArray();
        $ayah = array();
        $pernikahan = array();

        foreach ($data as $idx => $row) :
            if ($idx < 1) continue;

            $nik = ($row[3] == null) ? null : $row[3];
            $nama = ($row[2] == null) ? null : $row[2];
            if (!empty($nik)) {
                if (trim($nik) != "-") {
                    $idKeluarga = $this->keluargaModel->where('no_kk', $row[0])->first();
                    $idAnggota = $this->anggotaModel->kodegenAnggota($idKeluarga['id_keluarga']);

                    $ayahSatuan = [
                        'id_keluarga' => $idKeluarga['id_keluarga'],
                        'id_anggota' => $idAnggota,
                        'nik' => $nik,
                        'nama_baptis' => ($row[1] == null) ? null : $row[1],
                        'nama_lengkap' => ($row[2] == null) ? null : $row[2],
                        'tempat_baptis' => ($row[4] == null) ? null : $row[4],
                        'tgl_baptis' => ($row[5] == null) ? null : (($row[5] == '1970/01/01') ? null : $row[5]),
                        'tempat_krisma' => ($row[6] == null) ? null : $row[6],
                        'tgl_krisma' => ($row[7] == null) ? null : (($row[7] == '1970/01/01') ? null : $row[7]),
                        'jns_kelamin' => ($row[22] == null) ? null : $row[22], // ** tambahan
                        'gol_darah' => ($row[10] == null) ? null : $row[10],
                        'tempat_lahir' => ($row[11] == null) ? null : (($row[11] == '1970/01/01') ? null : $row[11]),
                        'tgl_lahir' => ($row[12] == null) ? null : $row[12],
                        'status_keluarga' => ($row[23] == null) ? null : $row[23], // ** tambahan
                        'ayah_kandung' => ($row[13] == null) ? null : $row[13],
                        'ibu_kandung' => ($row[14] == null) ? null : $row[14],
                        'pertanyaan' => ($row[19] == null) ? null : $row[19],
                        'tempat_tinggal' => ($row[20] == null) ? null : $row[20],
                        'telp' => ($row[21] == null) ? null : $row[21],
                        'is_head' => (substr($idAnggota, -1) == '1') ? 'Y' : null
                    ];

                    array_push($ayah, $ayahSatuan);
                    $this->anggotaModel->insert($ayahSatuan);
                }
            }

            $pernikahanAyah = [
                'id_anggota' => $idAnggota,
                'tempat_menikah' => ($row[8] == null) ? null : $row[8],
                'tgl_menikah' => ($row[9] == null) ? null : (($row[9] == '1970/01/01') ? null : $row[9]),
            ];

            if (!empty($pernikahanAyah['tempat_menikah']) || !empty($pernikahanAyah['tgl_menikah'])) {
                array_push($pernikahan, $pernikahanAyah);
            }

            if (!empty($row[3]) && !empty($row[15])) {
                array_push($pendidikan, [
                    'id_anggota' => $idAnggota,
                    'id_pendidikan' => $this->pendidikanModel->cariPendidikanExport($row[15])
                ]);
            }

            if (!empty($row[3]) && !empty($row[16])) {
                array_push($pekerjaan, [
                    'id_anggota' => $idAnggota,
                    'id_pekerjaan' => $this->pekerjaanModel->cariPekerjaanExport($row[16])
                ]);
            }

            if (!empty($row[17])) {
                $dataAktivitas = explode(',', $row[17]);
                foreach ($dataAktivitas as $data) :
                    array_push($aktivitas, [
                        'id_anggota' => $idAnggota,
                        'id_aktivitas' => $this->aktivitasModel->cariAktivitasExport(trim($data))
                    ]);
                endforeach;
            }

            if (!empty($row[18])) {
                $dataKategorial = explode(',', $row[18]);
                foreach ($dataKategorial as $data) :
                    array_push($kategorial, [
                        'id_anggota' => $idAnggota,
                        'id_kategorial' => $this->kategorialModel->cariKategorialExport(trim($data))
                    ]);
                endforeach;
            }
        endforeach;

        $data = $spreadsheet->setActiveSheetIndex(3)->toArray();
        $ibu = array();
        foreach ($data as $idx => $row) :
            if ($idx < 1) continue;

            $nik = ($row[3] == null) ? null : $row[3];
            $nama = ($row[2] == null) ? null : $row[2];
            if (!empty($nik)) {
                if (trim($nik) != "-") {
                    $idKeluarga = $this->keluargaModel->where('no_kk', $row[0])->first();
                    $idAnggota = $this->anggotaModel->kodegenAnggota($idKeluarga['id_keluarga']);

                    $ibuSatuan = [
                        'id_keluarga' => $idKeluarga['id_keluarga'],
                        'id_anggota' => $idAnggota,
                        'nik' => $nik,
                        'nama_baptis' => ($row[1] == null) ? null : $row[1],
                        'nama_lengkap' => ($row[2] == null) ? null : $row[2],
                        'tempat_baptis' => ($row[4] == null) ? null : $row[4],
                        'tgl_baptis' => ($row[5] == null) ? null : (($row[5] == '1970/01/01') ? null : $row[5]),
                        'tempat_krisma' => ($row[6] == null) ? null : $row[6],
                        'tgl_krisma' => ($row[7] == null) ? null : (($row[7] == '1970/01/01') ? null : $row[7]),
                        'jns_kelamin' => ($row[22] == null) ? null : $row[22], // ** tambahan
                        'gol_darah' => ($row[10] == null) ? null : $row[10],
                        'tempat_lahir' => ($row[11] == null) ? null : (($row[11] == '1970/01/01') ? null : $row[11]),
                        'tgl_lahir' => ($row[12] == null) ? null : $row[12],
                        'status_keluarga' => ($row[23] == null) ? null : $row[23], // ** tambahan
                        'ayah_kandung' => ($row[13] == null) ? null : $row[13],
                        'ibu_kandung' => ($row[14] == null) ? null : $row[14],
                        'pertanyaan' => ($row[19] == null) ? null : $row[19],
                        'tempat_tinggal' => ($row[20] == null) ? null : $row[20],
                        'telp' => ($row[21] == null) ? null : $row[21],
                        'is_head' => (substr($idAnggota, -1) == '1') ? 'Y' : null
                    ];
                    array_push($ibu, $ibuSatuan);
                    $this->anggotaModel->insert($ibuSatuan);
                }
            }

            $pernikahanIbu = [
                'id_anggota' => $idAnggota,
                'tempat_menikah' => ($row[8] == null) ? null : $row[8],
                'tgl_menikah' => ($row[9] == null) ? null : (($row[9] == '1970/01/01') ? null : $row[9]),
            ];

            if (!empty($pernikahanIbu['tempat_menikah']) || !empty($pernikahanIbu['tgl_menikah'])) {
                array_push($pernikahan, $pernikahanIbu);
            }

            if (!empty($row[3]) && !empty($row[15])) {
                array_push($pendidikan, [
                    'id_anggota' => $idAnggota,
                    'id_pendidikan' => $this->pendidikanModel->cariPendidikanExport($row[15])
                ]);
            }

            if (!empty($row[3]) && !empty($row[16])) {
                array_push($pekerjaan, [
                    'id_anggota' => $idAnggota,
                    'id_pekerjaan' => $this->pekerjaanModel->cariPekerjaanExport($row[16]),
                ]);
            }

            if (!empty($row[17])) {
                $dataAktivitas = explode(',', $row[17]);
                foreach ($dataAktivitas as $data) :
                    array_push($aktivitas, [
                        'id_anggota' => $idAnggota,
                        'id_aktivitas' => $this->aktivitasModel->cariAktivitasExport(trim($data))
                    ]);
                endforeach;
            }

            if (!empty($row[18])) {
                $dataKategorial = explode(',', $row[18]);
                foreach ($dataKategorial as $data) :
                    array_push($kategorial, [
                        'id_anggota' => $idAnggota,
                        'id_kategorial' => $this->kategorialModel->cariKategorialExport(trim($data))
                    ]);
                endforeach;
            }
        endforeach;

        $keluargaLain = array();
        $sekolah = array();
        for ($i = 4; $i < 8; $i++) {
            $data = $spreadsheet->setActiveSheetIndex($i)->toArray();

            foreach ($data as $idx => $row) :
                if ($idx < 1) continue;

                $nik = ($row[3] == null) ? null : $row[3];
                $nama = ($row[2] == null) ? null : $row[2];
                if (!empty($nik)) {
                    if (trim($nik) != "-") {
                        $idKeluarga = $this->keluargaModel->where('no_kk', $row[0])->first();
                        $idAnggota = $this->anggotaModel->kodegenAnggota($idKeluarga['id_keluarga']);

                        $keluargaLainSatuan = [
                            'id_keluarga' => $idKeluarga['id_keluarga'],
                            'id_anggota' => $idAnggota,
                            'nik' => $nik,
                            'nama_baptis' => ($row[1] == null) ? null : $row[1],
                            'nama_lengkap' => ($row[2] == null) ? null : $row[2],
                            'tempat_baptis' => ($row[4] == null) ? null : $row[4],
                            'tgl_baptis' => ($row[5] == null) ? null : (($row[5] == '1970/01/01') ? null : $row[5]),
                            'tempat_krisma' => ($row[6] == null) ? null : $row[6],
                            'tgl_krisma' => ($row[7] == null) ? null : (($row[7] == '1970/01/01') ? null : $row[7]),
                            'jns_kelamin' => ($row[8] == null) ? null : $row[8], // ** tambahan
                            'gol_darah' => ($row[9] == null) ? null : $row[9],
                            'tempat_lahir' => ($row[10] == null) ? null : $row[10],
                            'tgl_lahir' => ($row[11] == null) ? null : (($row[11] == '1970/01/01') ? null : $row[11]),
                            'status_keluarga' => ($row[12] == null) ? null : $row[12], // ** tambahan
                            'ayah_kandung' => ($row[13] == null) ? null : $row[13],
                            'ibu_kandung' => ($row[14] == null) ? null : $row[14],
                            'pertanyaan' => ($row[19] == null) ? null : $row[19],
                            'tempat_tinggal' => ($row[20] == null) ? null : $row[20],
                            'telp' => ($row[21] == null) ? null : $row[21],
                            'is_head' => (substr($idAnggota, -1) == '1') ? 'Y' : null
                        ];

                        array_push($keluargaLain, $keluargaLainSatuan);
                        $this->anggotaModel->insert($keluargaLainSatuan);
                    }
                }

                if (!empty($row[3]) && !empty($row[15])) {
                    array_push($pendidikan, [
                        'id_anggota' => $idAnggota,
                        'id_pendidikan' => $this->pendidikanModel->cariPendidikanExport($row[15])
                    ]);
                }

                if (!empty($row[3]) && !empty($row[16])) {
                    array_push($pekerjaan, [
                        'id_anggota' => $idAnggota,
                        'id_pekerjaan' => $this->pekerjaanModel->cariPekerjaanExport($row[16])
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

                if (!empty($row[17])) {
                    $dataAktivitas = explode(',', $row[17]);
                    foreach ($dataAktivitas as $data) :
                        array_push($aktivitas, [
                            'id_anggota' => $idAnggota,
                            'id_aktivitas' => $this->aktivitasModel->cariAktivitasExport(trim($data))
                        ]);
                    endforeach;
                }

                if (!empty($row[18])) {
                    $dataKategorial = explode(',', $row[18]);
                    foreach ($dataKategorial as $data) :
                        array_push($kategorial, [
                            'id_anggota' => $idAnggota,
                            'id_kategorial' => $this->kategorialModel->cariKategorialExport(trim($data))
                        ]);
                    endforeach;
                }
            endforeach;
        }

        $this->detPernikahanModel->insertBatch($pernikahan);
        $this->detPendidikanModel->insertBatch($pendidikan);
        $this->detPekerjaanModel->insertBatch($pekerjaan);
        $this->detSekolahModel->insertBatch($sekolah);
        $this->detAktivitasModel->insertBatch($aktivitas);
        $this->detKategorialModel->insertBatch($kategorial);

        // dd($keluraga, $ayah, $ibu, $keluargaLain, $pernikahan, $pendidikan, $pekerjaan, $sekolah, $aktivitas, $kategorial);

        session()->setflashdata('success', 'Sukses');
        return redirect()->to('/admin/keluarga/export/data');
    }
}

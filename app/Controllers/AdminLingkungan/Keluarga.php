<?php

namespace app\Controllers\AdminLingkungan;

use App\Controllers\BaseController;

use App\Models\ParokiModel;

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
    protected $parokiModel;
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
        $this->parokiModel = new ParokiModel();
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
        $idLingkungan = session()->get('lingkungan');
        $currentpage = $this->request->getVar('page_keluarga') ? $this->request->getVar('page_keluarga') : 1;
        $keyword = $this->request->getVar('keyword');
        $keluarga = $this->keluargaModel->viewAllByLingkungan($idLingkungan, $keyword);

        $data = [
            'title'     => 'Data Keluarga',
            'act'       => ['keluarga', 'lihat'],
            'keyword'   => $keyword,
            'keluarga'  => $keluarga->paginate(25, 'keluarga'),
            'pager'     => $this->keluargaModel->pager,
            'currentPage' => $currentpage
        ];
        return view('admin/admin_lingkungan/keluarga/index', $data);
    }

    public function detail($idKeluarga = false)
    {
        $idLingkungan = session()->get('lingkungan');
        $keluarga = $this->keluargaModel->dataKeluargaByLingkungan($idLingkungan, $idKeluarga)->first();
        if (empty($keluarga)) {
            session()->setflashdata('failed', 'Data tidak ditemukan.');
            return redirect()->to('/lingkungan/keluarga');
        }

        $data = [
            'title'     => 'Detail Keluarga',
            'keluarga'  => $keluarga,
            'anggota'   => $this->anggotaModel->dataAnggota($idKeluarga),
            'act'       => ['keluarga', 'lihat'],
        ];
        return view('admin/admin_lingkungan/keluarga/detail', $data);
    }

    public function add()
    {
        $idLingkungan = session()->get('lingkungan');
        $data = [
            'title'     => 'Tambah Data Keluarga',
            'lingkungan' => $this->lingkunganModel->find($idLingkungan),
            'pendidikan' => $this->pendidikanModel->findAll(),
            'pekerjaan' => $this->pekerjaanModel->findAll(),
            'aktivitas' => $this->aktivitasModel->findAll(),
            'kategorial' => $this->kategorialModel->findAll(),
            'act'       => ['keluarga', 'tambah'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/admin_lingkungan/keluarga/add', $data);
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
                'rules' => 'required|numeric|is_unique[dsc_keluarga.no_kk]|exact_length[16]',
                'errors' => [
                    'required' => 'Nomor Kartu Keluarga wajib diisi!',
                    'numeric' => 'Nomor Kartu Keluarga hanya dapat diisi dengan angka!',
                    'is_unique' => 'Nomor Kartu Keluarga sudah digunakan!',
                    'exact_length' => 'Panjang Normor Kartu Keluarga harus 16!'
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
                'rules' => 'required|numeric|is_unique[dsc_anggota_keluarga.nik]|exact_length[16]',
                'errors' => [
                    'required' => 'Nomor Induk Kependudukan wajib diisi!',
                    'numeric' => 'Nomor Induk Kependudukan hanya dapat diisi dengan angka!',
                    'is_unique' => 'Nomor Induk Kependudukan sudah digunakan!',
                    'exact_length' => 'Panjang Normor Induk Kependudukan harus 16!'
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
            return redirect()->to('/lingkungan/keluarga/add')->withInput();
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
            return redirect()->to('/lingkungan/keluarga/add')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data keluarga berhasil disimpan.');
            return redirect()->to('/lingkungan/keluarga/' . $idKeluarga);
        }
    }

    public function edit($idKeluarga = false)
    {
        $idLingkungan = session()->get('lingkungan');
        $keluarga = $this->keluargaModel->dataKeluargaByLingkungan($idLingkungan, $idKeluarga)->first();
        if (empty($keluarga)) {
            session()->setflashdata('failed', 'Data tidak ditemukan.');
            return redirect()->to('/lingkungan/keluarga');
        }

        $data = [
            'title'     => 'Edit Data Keluarga',
            'keluarga'  => $keluarga,
            'lingkungan' => $this->lingkunganModel->find($keluarga['id_lingkungan']),
            'act'       => ['keluarga', 'lihat'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/admin_lingkungan/keluarga/edit', $data);
    }

    public function editData($idKeluarga)
    {
        if (!$this->validate([
            'no_kk' => [
                'rules' => 'required|numeric|exact_length[16]',
                'errors' => [
                    'required' => 'Nomor Kartu Keluarga wajib diisi!',
                    'numeric' => 'Nomor Kartu Keluarga hanya dapat diisi dengan angka!',
                    'exact_length' => 'Panjang Normor Kartu Keluarga harus 16!'
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
            return redirect()->to('/lingkungan/keluarga/edit/' . $idKeluarga)->withInput();
        }

        $data = $this->keluargaModel->find($idKeluarga);

        $kk = trim($this->request->getVar('no_kk'));
        $cek = $this->keluargaModel->cekKkEdit($kk, $data['id_keluarga'])->first();
        if (!empty($cek)) {
            session()->setflashdata('kk', 'Nomor Kartu Keluarga sudah digunakan.');
            return redirect()->to('/lingkungan/keluarga/edit/' . $data['id_keluarga'])->withInput();
        }

        $keluarga = [
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
            return redirect()->to('/lingkungan/keluarga/edit/' . $idKeluarga)->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data keluarga berhasil diubah.');
            return redirect()->to('/lingkungan/keluarga/' . $idKeluarga);
        }
    }
}

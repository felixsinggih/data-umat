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

class Anggota extends BaseController
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

    public function add($idKeluarga)
    {
        $keluarga = $this->keluargaModel->find($idKeluarga);
        $data = [
            'title'     => 'Tambah Data Anggota Keluarga',
            'keluarga'  => $keluarga,
            'pendidikan' => $this->pendidikanModel->findAll(),
            'pekerjaan' => $this->pekerjaanModel->findAll(),
            'aktivitas' => $this->aktivitasModel->findAll(),
            'kategorial' => $this->kategorialModel->findAll(),
            'act'       => ['keluarga', 'lihat'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/keluarga/anggota/add', $data);
    }

    public function addData($idKeluarga)
    {
        if (!$this->validate([
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
            return redirect()->to('/admin/anggota/add/' . $idKeluarga)->withInput();
        }

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
        $this->anggotaModel->insert($anggota);

        if (!empty($pendidikan['id_pendidikan'])) $this->detPendidikanModel->insert($pendidikan);

        if (!empty($pekerjaan['id_pekerjaan'])) $this->detPekerjaanModel->insert($pekerjaan);

        if (!empty($pernikahan['tempat_menikah']) || !empty($pernikahan['tgl_menikah'])) $this->detPernikahanModel->insert($pernikahan);

        if (!empty($aktivitasForm)) $this->detAktivitasModel->insertBatch($aktivitas);

        if (!empty($kategorialForm)) $this->detKategorialModel->insertBatch($kategorial);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data keluarga gagal disimpan.');
            return redirect()->to('/admin/anggota/add/' . $idKeluarga)->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data keluarga berhasil disimpan.');
            return redirect()->to('/admin/keluarga/' . $idKeluarga);
        }
    }

    public function edit($idAnggota)
    {
        $anggota = $this->anggotaModel->find($idAnggota);

        $detAktivitas = $this->detAktivitasModel->showAktivitas($anggota['id_anggota']);
        $aktivitasArray = array();
        if (!empty($detAktivitas)) {
            foreach ($detAktivitas as $data) :
                array_push($aktivitasArray, $data['id_aktivitas']);
            endforeach;
        }

        if (empty($aktivitasArray)) {
            $aktivitasNotCheck = $this->aktivitasModel->findAll();
        } else {
            $aktivitasNotCheck = $this->aktivitasModel->aktivitasNotChecked($aktivitasArray);
        }

        $detKategorial = $this->detKategorialModel->showKategorial($anggota['id_anggota']);
        $kategorialArray = array();
        if (!empty($detKategorial)) {
            foreach ($detKategorial as $data) :
                array_push($kategorialArray, $data['id_kategorial']);
            endforeach;
        }

        if (empty($kategorialArray)) {
            $kategorialNotCheck = $this->kategorialModel->findAll();
        } else {
            $kategorialNotCheck = $this->kategorialModel->kategorialNotChecked($kategorialArray);
        }

        $data = [
            'title'         => 'Edit Data Anggota Keluarga',
            'anggota'       => $anggota,
            'pendidikan'    => $this->pendidikanModel->findAll(),
            'pekerjaan'     => $this->pekerjaanModel->findAll(),
            'aktivitas'     => $this->aktivitasModel->findAll(),
            'kategorial'    => $this->kategorialModel->findAll(),
            'detPendidikan' => $this->detPendidikanModel->cariPendidikan($anggota['id_anggota']),
            'detPekerjaan'  => $this->detPekerjaanModel->cariPekerjaan($anggota['id_anggota']),
            'detPernikahan' => $this->detPernikahanModel->where('id_anggota', $idAnggota)->first(),
            'detSekolah'    => $this->detSekolahModel->where('id_anggota', $idAnggota)->first(),
            'detAktivitas'  => $detAktivitas,
            'aktivitasNotCheck' => $aktivitasNotCheck,
            'detKategorial' => $detKategorial,
            'kategorialNotCheck' => $kategorialNotCheck,
            'act'           => ['keluarga', 'lihat'],
            'validation'    => \Config\Services::validation(),
        ];
        return view('admin/keluarga/anggota/edit', $data);
    }

    public function editData($idAnggota)
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|numeric|exact_length[16]',
                'errors' => [
                    'required' => 'Nomor Induk Kependudukan wajib diisi!',
                    'numeric' => 'Nomor Induk Kependudukan hanya dapat diisi dengan angka!',
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
        ])) {
            return redirect()->to('/admin/anggota/edit/' . $idAnggota)->withInput();
        }

        $data = $this->anggotaModel->find($idAnggota);
        $nik = trim($this->request->getVar('nik'));
        $cek = $this->anggotaModel->cekNikEdit($nik, $data['id_anggota'])->first();
        if (!empty($cek)) {
            session()->setflashdata('nik', 'Nomor Induk Kependudukan sudah digunakan.');
            return redirect()->to('/admin/anggota/edit/' . $data['id_anggota'])->withInput();
        }

        $anggota = [
            'id_anggota'    => $data['id_anggota'],
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
            foreach ($aktivitasForm as $akt) :
                array_push($aktivitas, [
                    'id_anggota' => $idAnggota,
                    'id_aktivitas' => $akt
                ]);
            endforeach;
        }

        $kategorial = array();
        $kategorialForm = $this->request->getPost('kategorial');
        if (!empty($kategorialForm)) {
            foreach ($kategorialForm as $kat) :
                array_push($kategorial, [
                    'id_anggota' => $idAnggota,
                    'id_kategorial' => $kat
                ]);
            endforeach;
        }

        $this->db->transStart();
        $this->anggotaModel->update($anggota['id_anggota'], $anggota);

        if (!empty($pendidikan['id_pendidikan'])) {
            $cekPendidikan = $this->detPendidikanModel->find($anggota['id_anggota']);
            if (empty($cekPendidikan)) {
                $this->detPendidikanModel->insert($pendidikan);
            } else {
                $this->detPendidikanModel->update($pendidikan['id_anggota'], $pendidikan);
            }
        }

        if (!empty($pekerjaan['id_pekerjaan'])) {
            $cekPekerjaan = $this->detPekerjaanModel->find($anggota['id_anggota']);
            if (empty($cekPekerjaan)) {
                $this->detPekerjaanModel->insert($pekerjaan);
            } else {
                $this->detPekerjaanModel->update($pekerjaan['id_anggota'], $pekerjaan);
            }
        }

        if (!empty($pernikahan['tempat_menikah']) || !empty($pernikahan['tgl_menikah'])) {
            $cekPernikahan = $this->detPernikahanModel->find($anggota['id_anggota']);
            if (empty($cekPernikahan)) {
                $this->detPernikahanModel->insert($pernikahan);
            } else {
                $this->detPernikahanModel->update($pernikahan['id_anggota'], $pernikahan);
            }
        }

        $this->detAktivitasModel->where('id_anggota', $data['id_anggota'])->delete();
        if (!empty($aktivitasForm)) $this->detAktivitasModel->insertBatch($aktivitas);

        $this->detKategorialModel->where('id_anggota', $data['id_anggota'])->delete();
        if (!empty($kategorialForm)) $this->detKategorialModel->insertBatch($kategorial);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data anggota keluarga gagal diubah.');
            return redirect()->to('/admin/anggota/edit/' . $data['id_anggota'])->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data anggota keluarga berhasil diubah.');
            return redirect()->to('/admin/anggota/' . $data['id_anggota']);
        }
    }

    public function detail($idAnggota = false)
    {

        $anggota = $this->anggotaModel->find($idAnggota);
        if (empty($anggota)) {
            session()->setflashdata('failed', 'Data tidak ditemukan.');
            return redirect()->to('/admin/keluarga');
        }

        $keluarga = $this->keluargaModel->find($anggota['id_keluarga']);

        $data = [
            'title'     => 'Detail Anggota Keluarga',
            'anggota'   => $anggota,
            'pendidikan' => $this->detPendidikanModel->showPendidikan($anggota['id_anggota']),
            'pekerjaan' => $this->detPekerjaanModel->showPekerjaan($anggota['id_anggota']),
            'keluarga'  => $keluarga,
            'lingkungan' => $this->lingkunganModel->find($keluarga['id_lingkungan']),
            'pernikahan' => $this->detPernikahanModel->where('id_anggota', $anggota['id_anggota'])->first(),
            'aktivitas' => $this->detAktivitasModel->showAktivitas($anggota['id_anggota']),
            'kategorial' => $this->detKategorialModel->showKategorial($anggota['id_anggota']),
            'sekolah'   => $this->detSekolahModel->where('id_anggota', $anggota['id_anggota'])->first(),
            'act'       => ['keluarga', 'lihat'],
        ];
        return view('admin/keluarga/anggota/detail', $data);
    }

    public function delete($idAnggota)
    {
        $anggota = $this->anggotaModel->find($idAnggota);
        $keluarga = $this->anggotaModel->where('id_keluarga', $anggota['id_keluarga'])->findAll();

        if (count($keluarga) > 1 && $anggota['is_head'] == 'Y') {
            session()->setflashdata('failed', 'Tidak dapat menghapus data kepala keluarga. Silahkan pindahakan status kepala keluarga ke anggota keluarga lain. Anda hanya dapat menghapus data kepala keluarga, jika hanya tersisa 1 anggota anggota.');
            return redirect()->to('/admin/keluarga/' . $anggota['id_keluarga']);
        }

        $cekPendidikan = $this->detPendidikanModel->find($anggota['id_anggota']);
        $cekPekerjaan = $this->detPekerjaanModel->find($anggota['id_anggota']);
        $cekPernikahan = $this->detPernikahanModel->find($anggota['id_anggota']);
        $cekSekolah = $this->detSekolahModel->find($anggota['id_anggota']);
        $cekAktivitas = $this->detAktivitasModel->where('id_anggota', $anggota['id_anggota'])->first();
        $cekKategorial = $this->detKategorialModel->where('id_anggota', $anggota['id_anggota'])->first();

        $this->db->transStart();
        if ($anggota['is_head'] == 'Y') {
            if (!empty($cekPendidikan)) $this->detPendidikanModel->delete($anggota['id_anggota']);
            if (!empty($cekPekerjaan)) $this->detPekerjaanModel->delete($anggota['id_anggota']);
            if (!empty($cekPernikahan)) $this->detPernikahanModel->delete($anggota['id_anggota']);
            if (!empty($cekSekolah)) $this->detSekolahModel->delete($anggota['id_anggota']);
            if (!empty($cekAktivitas)) $this->detAktivitasModel->where('id_anggota', $anggota['id_anggota'])->delete();
            if (!empty($cekKategorial)) $this->detKategorialModel->where('id_anggota', $anggota['id_anggota'])->delete();
            $this->anggotaModel->delete($anggota['id_anggota']);
            $this->keluargaModel->delete($anggota['id_keluarga']);
        } else {
            if (!empty($cekPendidikan)) $this->detPendidikanModel->delete($anggota['id_anggota']);
            if (!empty($cekPekerjaan)) $this->detPekerjaanModel->delete($anggota['id_anggota']);
            if (!empty($cekPernikahan)) $this->detPernikahanModel->delete($anggota['id_anggota']);
            if (!empty($cekSekolah)) $this->detSekolahModel->delete($anggota['id_anggota']);
            if (!empty($cekAktivitas)) $this->detAktivitasModel->where('id_anggota', $anggota['id_anggota'])->delete();
            if (!empty($cekKategorial)) $this->detKategorialModel->where('id_anggota', $anggota['id_anggota'])->delete();
            $this->anggotaModel->delete($anggota['id_anggota']);
        }
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data anggota keluarga gagal dihapus.');
            return redirect()->to('/admin/keluarga/' . $anggota['id_keluarga']);
        } elseif ($this->db->transStatus() == true) {
            if ($anggota['is_head'] == 'Y') {
                session()->setflashdata('success', 'Data keluarga berhasil dihapus.');
                return redirect()->to('/admin/keluarga');
            } else {
                session()->setflashdata('success', 'Data anggota keluarga berhasil dihapus.');
                return redirect()->to('/admin/keluarga/' . $anggota['id_keluarga']);
            }
        }
    }

    public function kepalaKeluarga($idKeluarga)
    {
        $idAnggota = $this->request->getVar('id_anggota');
        $anggota = $this->anggotaModel->find($idAnggota);
        if ($anggota['is_head'] == 'Y') {
            session()->setflashdata('failed', 'Status kepala keluarga tidak berubah. Silahkan pilih anggota keluarga lain.');
            return redirect()->to('/admin/keluarga/' . $anggota['id_keluarga']);
        } else {
            $kepalaKeluarga = $this->anggotaModel->where('id_keluarga', $idKeluarga)->where('is_head', 'Y')->first();

            $data1 = [
                'id_anggota' => $kepalaKeluarga['id_anggota'],
                'is_head' => 'N'
            ];

            $data2 = [
                'id_anggota' => $anggota['id_anggota'],
                'is_head' => 'Y'
            ];

            $this->db->transStart();
            $this->anggotaModel->update($data2['id_anggota'], $data2);
            $this->anggotaModel->update($data1['id_anggota'], $data1);
            $this->db->transComplete();

            if ($this->db->transStatus() == false) {
                session()->setflashdata('failed', 'Status kepala keluarga gagal diubah.');
                return redirect()->to('/admin/keluarga/' . $anggota['id_keluarga']);
            } elseif ($this->db->transStatus() == true) {
                session()->setflashdata('success', 'Status kepala keluarga berhasil diubah.');
                return redirect()->to('/admin/keluarga/' . $anggota['id_keluarga']);
            }
        }
    }
}

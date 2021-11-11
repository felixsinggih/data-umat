<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AktivitasModel;

class Aktivitas extends BaseController
{
    protected $aktivitasModel;
    function __construct()
    {
        $this->aktivitasModel = new AktivitasModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_aktivitas') ? $this->request->getVar('page_aktivitas') : 1;
        $aktivitas = $this->aktivitasModel;
        $data = [
            'title' => 'Aktivitas Kemasyarakatan',
            'aktivitas' => $aktivitas->paginate(25, 'aktivitas'),
            'pager' => $aktivitas->pager,
            'act'   => ['master', 'aktivitas'],
            'currentPage' => $currentpage,
        ];
        return view('admin/data_master/aktivitas/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Aktivitas Kemasyarakatan',
            'act'   => ['master', 'aktivitas'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/data_master/aktivitas/add', $data);
    }

    public function addData()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama aktivitas wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/aktivitas/add')->withInput();
        }

        $aktivitas = [
            'nama' => $this->request->getVar('nama'),
        ];

        $this->db->transStart();
        $this->aktivitasModel->insert($aktivitas);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data aktivitas kemasyarakatan gagal disimpan.');
            return redirect()->to('/admin/aktivitas/add')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data aktivitas kemasyarakatan berhasil disimpan.');
            return redirect()->to('/admin/aktivitas');
        }
    }

    public function edit($idAktivitas)
    {
        $data = [
            'title' => 'Edit Aktivitas Kemasyaratan',
            'aktivitas' => $this->aktivitasModel->find($idAktivitas),
            'act'   => ['master', 'aktivitas'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/data_master/aktivitas/edit', $data);
    }

    public function editData($idAktivitas)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama aktivitas kemasyarakatan wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/aktivitas/edit/' . $idAktivitas)->withInput();
        }

        $dataAktivitas = $this->aktivitasModel->find($idAktivitas);
        $aktivitas = [
            'id_aktivitas' => $dataAktivitas['id_aktivitas'],
            'nama' => $this->request->getVar('nama'),
        ];

        $this->db->transStart();
        $this->aktivitasModel->update($aktivitas['id_aktivitas'], $aktivitas);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data aktivitas kemasyarakatan gagal diubah.');
            return redirect()->to('/admin/aktivitas/edit/' . $dataAktivitas['id_aktivitas'])->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data aktivitas kemasyarakatan berhasil diubah.');
            return redirect()->to('/admin/aktivitas');
        }
    }
}

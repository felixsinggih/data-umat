<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategorialModel;

class Kategorial extends BaseController
{
    protected $kategorialModel;
    function __construct()
    {
        $this->kategorialModel = new KategorialModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_kategorial') ? $this->request->getVar('page_kategorial') : 1;
        $kategorial = $this->kategorialModel;
        $data = [
            'title' => 'Kelompok Kategorial Gereja',
            'kategorial' => $kategorial->paginate(25, 'kategorial'),
            'pager' => $kategorial->pager,
            'act'   => ['master', 'kategorial'],
            'currentPage' => $currentpage,
        ];
        return view('admin/data_master/kategorial/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Kelompok Kategorial Gereja',
            'act'   => ['master', 'kategorial'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/data_master/kategorial/add', $data);
    }

    public function addData()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kelompok kategorial wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/kategorial/add')->withInput();
        }

        $kategorial = [
            'nama' => $this->request->getVar('nama'),
        ];

        $this->db->transStart();
        $this->kategorialModel->insert($kategorial);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data Kelompok ketegorial gereja gagal disimpan.');
            return redirect()->to('/admin/kategorial/add')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data Kelompok ketegorial gereja berhasil disimpan.');
            return redirect()->to('/admin/kategorial');
        }
    }

    public function edit($idKategorial)
    {
        $data = [
            'title' => 'Edit Kelompok Kategorial Gereja',
            'kategorial' => $this->kategorialModel->find($idKategorial),
            'act'   => ['master', 'kategorial'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/data_master/kategorial/edit', $data);
    }

    public function editData($idKategorial)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kelompok kategorial wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/kategorial/edit/' . $idKategorial)->withInput();
        }

        $dataKategorial = $this->kategorialModel->find($idKategorial);
        $kategorial = [
            'id_kategorial' => $dataKategorial['id_kategorial'],
            'nama' => $this->request->getVar('nama'),
        ];

        $this->db->transStart();
        $this->kategorialModel->update($kategorial['id_kategorial'], $kategorial);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data kelompok kategorial gereja gagal diubah.');
            return redirect()->to('/admin/kategorial/edit/' . $dataKategorial['id_kategorial'])->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data kelompok kategorial gereja berhasil diubah.');
            return redirect()->to('/admin/kategorial');
        }
    }
}

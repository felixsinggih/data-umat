<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LingkunganModel;

class Lingkungan extends BaseController
{
    protected $lingkunganModel;
    function __construct()
    {
        $this->lingkunganModel = new LingkunganModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_lingkungan') ? $this->request->getVar('page_lingkungan') : 1;
        $lingkungan = $this->lingkunganModel;
        $data = [
            'title' => 'Lingkungan / Stasi',
            'lingkungan' => $lingkungan->paginate(25, 'lingkungan'),
            'pager' => $lingkungan->pager,
            'act'   => ['master', 'lingkungan'],
            'currentPage' => $currentpage,
        ];
        return view('admin/data_master/lingkungan/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Lingkungan / Stasi',
            'act'   => ['master', 'lingkungan'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/data_master/lingkungan/add', $data);
    }

    public function addData()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lingkungan / Stasi wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/lingkungan/add')->withInput();
        }

        $lingkungan = [
            'id_lingkungan' => $this->lingkunganModel->kodegenLingkungan(),
            'nama'          => $this->request->getVar('nama'),
        ];

        $this->db->transStart();
        $this->lingkunganModel->insert($lingkungan);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data lingkungan / stasi gagal disimpan.');
            return redirect()->to('/admin/lingkungan/add')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data lingkungan / stasi berhasil disimpan.');
            return redirect()->to('/admin/lingkungan');
        }
    }

    public function edit($idLingkungan)
    {
        $data = [
            'title' => 'Edit Lingkungan / Stasi',
            'lingkungan' => $this->lingkunganModel->find($idLingkungan),
            'act'   => ['master', 'lingkungan'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/data_master/lingkungan/edit', $data);
    }

    public function editData($idLingkungan)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lingkungan / Stasi wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/lingkungan/edit/' . $idLingkungan)->withInput();
        }

        $dataLingkungan = $this->lingkunganModel->find($idLingkungan);
        $lingkungan = [
            'id_lingkungan' => $dataLingkungan['id_lingkungan'],
            'nama'          => $this->request->getVar('nama'),
        ];

        $this->db->transStart();
        $this->lingkunganModel->update($lingkungan['id_lingkungan'], $lingkungan);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data lingkungan / stasi gagal diubah.');
            return redirect()->to('/admin/lingkungan/edit/' . $dataLingkungan['id_lingkungan'])->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data lingkungan / stasi berhasil diubah.');
            return redirect()->to('/admin/lingkungan');
        }
    }
}

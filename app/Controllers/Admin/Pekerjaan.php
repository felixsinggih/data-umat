<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PekerjaanModel;

class Pekerjaan extends BaseController
{
    protected $pekerjaanModel;
    function __construct()
    {
        $this->pekerjaanModel = new PekerjaanModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_pekerjaan') ? $this->request->getVar('page_pekerjaan') : 1;
        $pekerjaan = $this->pekerjaanModel;
        $data = [
            'title' => 'Pekerjaan',
            'pekerjaan' => $pekerjaan->paginate(25, 'pekerjaan'),
            'pager' => $pekerjaan->pager,
            'act'   => ['master', 'pekerjaan'],
            'currentPage' => $currentpage,
        ];
        return view('admin/data_master/pekerjaan/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Pekerjaan',
            'act'   => ['master', 'pekerjaan'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/data_master/pekerjaan/add', $data);
    }

    public function addData()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama pekerjaan wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/pekerjaan/add')->withInput();
        }

        $pekerjaan = [
            'nama' => $this->request->getVar('nama'),
        ];

        $this->db->transStart();
        $this->pekerjaanModel->insert($pekerjaan);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data pekerjaan gagal disimpan.');
            return redirect()->to('/admin/pekerjaan/add')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data pekerjaan berhasil disimpan.');
            return redirect()->to('/admin/pekerjaan');
        }
    }

    public function edit($idPekerjaan)
    {
        $data = [
            'title' => 'Edit KPekerjaan',
            'pekerjaan' => $this->pekerjaanModel->find($idPekerjaan),
            'act'   => ['master', 'pekerjaan'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/data_master/pekerjaan/edit', $data);
    }

    public function editData($idPekerjaan)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama pekerjaan wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/pekerjaan/edit/' . $idPekerjaan)->withInput();
        }

        $dataPekerjaan = $this->pekerjaanModel->find($idPekerjaan);
        $pekerjaan = [
            'id_pekerjaan' => $dataPekerjaan['id_pekerjaan'],
            'nama' => $this->request->getVar('nama'),
        ];

        $this->db->transStart();
        $this->pekerjaanModel->update($pekerjaan['id_pekerjaan'], $pekerjaan);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data pekerjaan gagal diubah.');
            return redirect()->to('/admin/pekerjaan/edit/' . $dataPekerjaan['id_pekerjaan'])->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data pekerjaan berhasil diubah.');
            return redirect()->to('/admin/pekerjaan');
        }
    }
}

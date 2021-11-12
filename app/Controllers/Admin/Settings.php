<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ParokiModel;

class Settings extends BaseController
{
    protected $parokiModel;
    function __construct()
    {
        $this->parokiModel = new ParokiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Settings',
            'paroki' => $this->parokiModel->find('1'),
            'act'   => ['settings', 'paroki'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/settings/index', $data);
    }

    public function editDataParoki()
    {
        $data = $this->parokiModel->find($this->request->getVar('id_paroki'));

        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama paroki wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/setting')->withInput();
        }

        $logo = $this->request->getFile('logo');
        // dd($logo->getName());
        if ($logo->getName() == '') {
            $paroki = [
                'id_paroki' => $data['id_paroki'],
                'nama'      => $this->request->getVar('nama'),
                'telp'      => $this->request->getVar('telp'),
                'email'     => $this->request->getVar('email'),
                'alamat'    => $this->request->getVar('alamat'),
            ];
        } else {
            $namaLogo = $logo->getRandomName();

            $paroki = [
                'id_paroki' => $data['id_paroki'],
                'nama'      => $this->request->getVar('nama'),
                'telp'      => $this->request->getVar('telp'),
                'email'     => $this->request->getVar('email'),
                'alamat'    => $this->request->getVar('alamat'),
                'logo'      => $namaLogo
            ];
        }
        // dd($paroki);
        $this->db->transStart();
        $this->parokiModel->update($paroki['id_paroki'], $paroki);
        if ($logo->getName() != '') {
            if (file_exists('upload/img/' . $data['logo'])) {
                unlink('upload/img/' . $data['logo']);
            }
            $logo->move('upload/img', $namaLogo);
        }
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data gagal disimpan.');
            return redirect()->to('/admin/setting')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/admin/setting');
        }
    }
}

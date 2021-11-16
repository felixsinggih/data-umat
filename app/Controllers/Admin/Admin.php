<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\LingkunganModel;
use App\Models\UsersLingkunganModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $lingkunganModel;
    protected $userLingkunganModel;
    function __construct()
    {
        $this->userModel = new UsersModel();
        $this->lingkunganModel = new LingkunganModel();
        $this->userLingkunganModel = new UsersLingkunganModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_admin') ? $this->request->getVar('page_admin') : 1;
        $admin = $this->userModel->showAdmin();
        $data = [
            'title' => 'Admin Paroki',
            'admin' => $admin->paginate(25, 'admin'),
            'pager' => $admin->pager,
            'act'   => ['settings', 'admin'],
            'currentPage' => $currentpage,
        ];
        return view('admin/settings/admin/index', $data);
    }

    public function detail($idUser)
    {
        $admin = $this->userModel->selectAdmin($idUser);
        if (empty($admin)) {
            session()->setflashdata('failed', 'Oops... Data tidak ditemukan. Silahkan pilih data.');
            return redirect()->to('/admin/paroki')->withInput();
        }

        $data = [
            'title' => 'Detail Admin',
            'admin' => $admin,
            'act'   => ['settings', 'admin'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/settings/admin/detail', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Admin',
            'lingkungan' => $this->lingkunganModel->findAll(),
            'act'   => ['settings', 'admin'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/settings/admin/add', $data);
    }

    public function addData()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi!',
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[dsc_users.username]|min_length[8]|alpha_numeric',
                'errors' => [
                    'required' => 'Username wajib diisi!',
                    'is_unique' => 'Usename sudah digunakan!',
                    'min_length' => 'Panjang minimal Username adalah 8 karakter!',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih status admin!',
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih level admin!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/paroki/add')->withInput();
        }

        if ($this->request->getVar('role') == 'Lingkungan') {
            if (!$this->validate([
                'id_lingkungan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih lingkungan!',
                    ]
                ],
            ])) {
                return redirect()->to('/admin/paroki/add')->withInput();
            }
        }

        $uid = $this->userModel->kodegen();
        $password = $this->request->getVar('username');
        $pwHash = password_hash($password, PASSWORD_DEFAULT);
        $role = $this->request->getVar('role');
        $isFirst = "Y";

        $admin = [
            'uid'       => $uid,
            'name'      => $this->request->getVar('name'),
            'email'     => $this->request->getVar('email'),
            'username'  => strtolower($this->request->getVar('username')),
            'password'  => $pwHash,
            'role'      => $role,
            'status'    => $this->request->getVar('status'),
            'is_first'  => $isFirst
        ];

        if ($this->request->getVar('role') == 'Lingkungan') {
            $adminLingkungan = [
                'uid_lingkungan' => $this->userLingkunganModel->kodegen(),
                'uid' => $uid,
                'id_lingkungan' => $this->request->getVar('id_lingkungan'),
            ];
        }

        $this->db->transStart();
        $this->userModel->insert($admin);

        if ($this->request->getVar('role') == 'Lingkungan') {
            $this->userLingkunganModel->insert($adminLingkungan);
        }
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data admin gagal disimpan.');
            return redirect()->to('/admin/paroki/add')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data admin berhasil disimpan.');
            return redirect()->to('/admin/paroki/' . $admin['uid']);
        }
    }

    public function edit($idUser)
    {
        $admin = $this->userModel->selectAdmin($idUser);
        if (empty($admin)) {
            session()->setflashdata('failed', 'Oops... Data tidak ditemukan. Silahkan pilih data.');
            return redirect()->to('/admin/paroki')->withInput();
        }

        $data = [
            'title' => 'Edit Admin',
            'admin' => $admin,
            'lingkungan' => $this->lingkunganModel->findAll(),
            'act'   => ['settings', 'admin'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/settings/admin/edit', $data);
    }

    public function editData($idUser)
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi!',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih status!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/paroki/edit/' . $idUser)->withInput();
        }

        $data = $this->userModel->selectAdmin($idUser);
        $password = $this->request->getVar('password');
        if ($password == '') {
            $admin = [
                'uid'   => $data['uid'],
                'name'  => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'status' => $this->request->getVar('status'),
            ];
        } else {
            if (!$this->validate([
                'password' => [
                    'rules' => 'min_length[8]|alpha_dash',
                    'errors' => [
                        'min_length' => 'Panjang minimal Password adalah 8 karakter!'
                    ]
                ],
            ])) {
                return redirect()->to('/admin/paroki/edit/' . $idUser)->withInput();
            }

            $pwHash = password_hash($password, PASSWORD_DEFAULT);
            $admin = [
                'uid'   => $data['uid'],
                'name'  => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'status' => $this->request->getVar('status'),
                'password' => $pwHash
            ];
        }

        if ($data['role'] == 'Lingkungan') {
            $adminLingkungan = [
                'uid_lingkungan' => $data['uid_lingkungan'],
                'id_lingkungan' => $this->request->getVar('id_lingkungan')
            ];
        }

        $this->db->transStart();
        $this->userModel->update($admin['uid'], $admin);

        if ($data['role'] == 'Lingkungan') {
            $this->userLingkunganModel->update($adminLingkungan['uid_lingkungan'], $adminLingkungan);
        }
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data gagal diubah.');
            return redirect()->to('/admin/paroki/edit/' . $data['uid'])->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data berhasil diubah.');
            return redirect()->to('/admin/paroki/' . $data['uid']);
        }
    }

    public function delete($idUser)
    {
        $user = $this->userModel->selectAdmin($idUser);

        $this->db->transStart();
        $this->userModel->delete($user['uid']);

        if ($user['uid_lingkungan'] != null) {
            $this->userLingkunganModel->delete($user['uid_lingkungan']);
        }
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data gagal dihapus.');
            return redirect()->to('/admin/paroki');
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data berhasil dihapus.');
            return redirect()->to('/admin/paroki');
        }
    }
}

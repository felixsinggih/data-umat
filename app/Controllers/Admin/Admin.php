<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Admin extends BaseController
{
    protected $userModel;
    function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_admin') ? $this->request->getVar('page_admin') : 1;
        $admin = $this->userModel->selectUserRole('Superadmin');
        $data = [
            'title' => 'Admin Paroki',
            'admin' => $admin->paginate(25, 'admin'),
            'pager' => $admin->pager,
            'act'   => ['settings', 'admin'],
            'currentPage' => $currentpage,
        ];
        return view('admin/settings/admin_paroki/index', $data);
    }

    public function detail($idUser)
    {
        $admin = $this->userModel->find($idUser);
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
        return view('admin/settings/admin_paroki/detail', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Admin',
            'act'   => ['settings', 'admin'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/settings/admin_paroki/add', $data);
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
                'rules' => 'required|is_unique[dsc_users.username]',
                'errors' => [
                    'required' => 'Username wajib diisi!',
                    'is_unique' => 'Usename sudah digunakan!'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/paroki/add')->withInput();
        }

        $uid = $this->userModel->kodegenSuperadmin();
        $password = $this->request->getVar('username');
        $pwHash = password_hash($password, PASSWORD_DEFAULT);
        $role = "Superadmin";
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

        $this->db->transStart();
        $this->userModel->insert($admin);
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
        $admin = $this->userModel->find($idUser);
        if (empty($admin)) {
            session()->setflashdata('failed', 'Oops... Data tidak ditemukan. Silahkan pilih data.');
            return redirect()->to('/admin/paroki')->withInput();
        }

        $data = [
            'title' => 'Edit Admin',
            'admin' => $admin,
            'act'   => ['settings', 'admin'],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/settings/admin_paroki/edit', $data);
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

        $data = $this->userModel->find($idUser);
        $password = $this->request->getVar('password');
        if ($password == '') {
            $admin = [
                'uid'   => $data['uid'],
                'name'  => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'status' => $this->request->getVar('status'),
            ];
        } else {
            $pwHash = password_hash($password, PASSWORD_DEFAULT);
            $admin = [
                'uid'   => $data['uid'],
                'name'  => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'status' => $this->request->getVar('status'),
                'password' => $pwHash
            ];
        }

        $this->db->transStart();
        $this->userModel->update($admin['uid'], $admin);
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
        $user = $this->userModel->find($idUser);

        $this->db->transStart();
        $this->userModel->delete($user['uid']);
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

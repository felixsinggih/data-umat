<?php

namespace app\Controllers\User;

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
        $uid = session()->get('uid');
        $data = [
            'title' => 'Your Profile',
            'user'  => $this->userModel->selectAdmin($uid),
            'act'   => ['', ''],
        ];
        return view('admin/user/index', $data);
    }

    public function edit()
    {
        $uid = session()->get('uid');
        $data = [
            'title' => 'Edit Profile',
            'user'  => $this->userModel->selectAdmin($uid),
            'act'   => ['', ''],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/user/edit', $data);
    }

    public function editData()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/user/profile/edit')->withInput();
        }

        $uid = $this->request->getVar('uid');
        $data = $this->userModel->selectAdmin($uid);
        $admin = [
            'uid'   => $data['uid'],
            'name'  => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
        ];

        $this->db->transStart();
        $this->userModel->update($admin['uid'], $admin);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Profile anda gagal diubah.');
            return redirect()->to('/user/profile/edit')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Profile anda berhasil diubah.');
            return redirect()->to('/user/profile');
        }
    }

    public function password()
    {
        $uid = session()->get('uid');
        $data = [
            'title' => 'Ubah Password',
            'user'  => $this->userModel->selectAdmin($uid),
            'act'   => ['', ''],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/user/password', $data);
    }

    public function editPassword()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $userData = $this->userModel->where('username', $username)->first();

        if (password_verify($password, $userData['password']) == false) {
            session()->setflashdata('password', 'Password yang anda masukan salah!');
            return redirect()->to('/user/password');
        }

        if (!$this->validate([
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong!',
                ]
            ],
            'newPassword' => [
                'rules' => 'required|min_length[8]|alpha_dash',
                'errors' => [
                    'required' => 'Password baru tidak boleh kosong!',
                    'min_length' => 'Panjang minimal adalah 8 karakter!'
                ]
            ],
            'confirmPassword' => [
                'rules' => 'required|matches[newPassword]|min_length[8]|alpha_dash',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong!',
                    'matches' => 'Konfirmasi password tidak sama dengan password baru!',
                    'min_length' => 'Panjang minimal adalah 8 karakter!'
                ]
            ],
        ])) {
            return redirect()->to('/user/password')->withInput();
        }

        $newPassword = $this->request->getVar('newPassword');
        $pwHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $admin = [
            'uid' => $userData['uid'],
            'password' => $pwHash,
        ];

        $this->db->transStart();
        $this->userModel->update($admin['uid'], $admin);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Password anda gagal diubah.');
            return redirect()->to('/user/password')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Password anda berhasil diubah.');
            return redirect()->to('/user/profile');
        }
    }

    public function first()
    {
        $uid = session()->get('uid');
        $data = [
            'user'  => $this->userModel->selectAdmin($uid),
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/user/login_pertama/index', $data);
    }

    public function passwordLogin()
    {
        $username = $this->request->getVar('username');
        $userData = $this->userModel->where('username', $username)->first();

        if (!$this->validate([
            'newPassword' => [
                'rules' => 'required|min_length[8]|alpha_dash',
                'errors' => [
                    'required' => 'Password baru tidak boleh kosong!',
                    'min_length' => 'Panjang minimal adalah 8 karakter!'
                ]
            ],
            'confirmPassword' => [
                'rules' => 'required|matches[newPassword]|min_length[8]|alpha_dash',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong!',
                    'matches' => 'Konfirmasi password tidak sama dengan password baru!',
                    'min_length' => 'Panjang minimal adalah 8 karakter!'
                ]
            ],
        ])) {
            return redirect()->to('/user/security')->withInput();
        }

        $newPassword = $this->request->getVar('newPassword');
        $pwHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $isFirst = 'N';
        $admin = [
            'uid' => $userData['uid'],
            'password' => $pwHash,
            'is_first' => $isFirst
        ];

        $this->db->transStart();
        $this->userModel->update($admin['uid'], $admin);
        $this->session->set('isFirst', $isFirst);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Password anda gagal diubah.');
            return redirect()->to('/user/security')->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Password anda berhasil diubah.');
            if (session()->get('role') == 'Paroki') return redirect()->to('/admin');
            elseif (session()->get('role') == 'Lingkungan') return redirect()->to('/adling');
        }
    }
}

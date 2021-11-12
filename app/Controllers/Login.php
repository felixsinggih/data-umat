<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data = ['title' => 'Login',];
        return view('admin/login/index', $data);
    }

    function signin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userData = $this->userModel->where('username', $username)->first();

        if (!empty($userData)) {
            if (password_verify($password, $userData['password'])) {
                if ($userData['status'] == "Aktif") {
                    $this->session->set('uid', $userData['uid']);
                    $this->session->set('name', $userData['name']);
                    $this->session->set('role', $userData['role']);
                    $this->session->set('isFirst', $userData['is_first']);
                    $this->session->set('isAdmin', true);

                    session()->setflashdata('success', 'Selamat Datang, ' . session()->get('name'));
                    return redirect()->to('/admin')->withInput();
                } else {
                    session()->setflashdata('failed', 'Maaf, Status anda sudah Tidak Aktif');
                    return redirect()->to('/login');
                }
            } else {
                session()->setflashdata('failed', 'Oopss.. Username/password salah');
                return redirect()->to('/login');
            }
        } else {
            session()->setflashdata('failed', 'Oopss.. Data tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function signout()
    {
        session()->remove('uid');
        session()->remove('name');
        session()->remove('isAdmin');
        return redirect()->to(base_url('login'));
    }
}

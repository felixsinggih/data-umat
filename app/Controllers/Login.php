<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\UsersLingkunganModel;

class Login extends BaseController
{
    function __construct()
    {
        $this->userModel = new UsersModel();
        $this->userLingkungan = new UsersLingkunganModel();
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
                    if ($userData['role'] == "Paroki") {
                        $this->session->set('uid', $userData['uid']);
                        $this->session->set('name', $userData['name']);
                        $this->session->set('role', $userData['role']);
                        $this->session->set('isFirst', $userData['is_first']);
                        $this->session->set('isLogged', true);

                        session()->setflashdata('success', 'Selamat Datang, ' . session()->get('name'));
                        return redirect()->to('/admin')->withInput();
                    } elseif ($userData['role'] == "Lingkungan") {
                        $lingkungan = $this->userLingkungan->where('uid', $userData['uid'])->first();
                        $this->session->set('uid', $userData['uid']);
                        $this->session->set('name', $userData['name']);
                        $this->session->set('role', $userData['role']);
                        $this->session->set('isFirst', $userData['is_first']);
                        $this->session->set('isLogged', true);
                        $this->session->set('lingkungan', $lingkungan['id_lingkungan']);

                        session()->setflashdata('success', 'Selamat Datang, ' . session()->get('name'));
                        return redirect()->to('/lingkungan')->withInput();
                    }
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
        session()->remove('role');
        session()->remove('isFirst');
        session()->remove('isLogged');
        session()->remove('lingkungan');
        return redirect()->to(base_url('login'));
    }
}

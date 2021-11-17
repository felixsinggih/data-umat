<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (session()->get('isLogged')) {
            if (session()->get('role') == 'Paroki') {
                session()->setflashdata('success', 'Selamat Datang, ' . session()->get('name'));
                return redirect()->to(base_url('admin'));
            }

            if (session()->get('role') == 'Lingkungan') {
                session()->setflashdata('success', 'Selamat Datang, ' . session()->get('name'));
                return redirect()->to(base_url('lingkungan'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

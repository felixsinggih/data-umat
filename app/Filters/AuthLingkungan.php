<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthLingkungan implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (!session()->get('isLogged')) {
            session()->setflashdata('failed', 'Oopss... Silahkan log in terlebih dahulu!');
            return redirect()->to(base_url('/login'));
        } else {
            if (session()->get('isFirst') == 'Y') {
                session()->setflashdata('success', 'Silahkan ubah password anda!');
                return redirect()->to(base_url('/user/security'));
            } else {
                if (session()->get('role') != 'Lingkungan') {
                    session()->setflashdata('failed', 'Anda tidak memiliki akses!');
                    return redirect()->back();
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

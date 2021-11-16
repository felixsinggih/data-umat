<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthParoki implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (!session()->get('isLogged')) {
            session()->setflashdata('failed', 'Oopss... Silahkan log in terlebih dahulu!');
            return redirect()->to(base_url('/login'));
        } else {
            if (session()->get('role') != 'Paroki') {
                session()->setflashdata('failed', 'Anda tidak memiliki akses!');
                return redirect()->back();
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

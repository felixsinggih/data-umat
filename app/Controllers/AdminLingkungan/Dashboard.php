<?php

namespace app\Controllers\AdminLingkungan;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    function __construct()
    {
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin Lingkungan',
            'act'   => ['dashboard', ''],
        ];
        return view('admin/admin_lingkungan/dashboard/index', $data);
    }
}

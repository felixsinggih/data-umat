<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'act'   => ['dashboard', ''],
        ];
        return view('admin/dashboard/index', $data);
    }
}

<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\LingkunganModel;

class Dashboard extends BaseController
{
    function __construct()
    {
        $this->lingkunganModel = new LingkunganModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'act'   => ['dashboard', ''],
        ];
        return view('admin/dashboard/index', $data);
    }
}

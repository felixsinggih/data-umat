<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategorialModel;

class Kategorial extends BaseController
{
    function __construct()
    {
        $this->kategorialModel = new KategorialModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_kategorial') ? $this->request->getVar('page_kategorial') : 1;
        $kategorial = $this->kategorialModel;
        $data = [
            'title' => 'Kelompok Kategorial Gereja',
            'kategorial' => $kategorial->paginate(25, 'kategorial'),
            'pager' => $kategorial->pager,
            'act'   => ['master', 'kategorial'],
            'currentPage' => $currentpage,
        ];
        return view('admin/data_master/kategorial/index', $data);
    }
}

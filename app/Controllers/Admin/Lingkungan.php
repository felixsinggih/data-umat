<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LingkunganModel;

class Lingkungan extends BaseController
{
    function __construct()
    {
        $this->lingkunganModel = new LingkunganModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_lingkungan') ? $this->request->getVar('page_lingkungan') : 1;
        $lingkungan = $this->lingkunganModel;
        $data = [
            'title' => 'Lingkungan / Stasi',
            'lingkungan' => $lingkungan->paginate(25, 'lingkungan'),
            'pager' => $lingkungan->pager,
            'act'   => ['master', 'lingkungan'],
            'currentPage' => $currentpage,
        ];
        return view('admin/data_master/lingkungan/index', $data);
    }

    public function cariLingkungan($nama)
    {
        $lingkungan = $this->lingkunganModel->where('nama', $nama)->first();
        return $lingkungan['id_lingkungan'];
    }
}

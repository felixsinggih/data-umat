<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PekerjaanModel;

class Pekerjaan extends BaseController
{
    function __construct()
    {
        $this->pekerjaanModel = new PekerjaanModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_pekerjaan') ? $this->request->getVar('page_pekerjaan') : 1;
        $pekerjaan = $this->pekerjaanModel;
        $data = [
            'title' => 'Pekerjaan',
            'pekerjaan' => $pekerjaan->paginate(25, 'pekerjaan'),
            'pager' => $pekerjaan->pager,
            'act'   => ['master', 'pekerjaan'],
            'currentPage' => $currentpage,
        ];
        return view('admin/data_master/pekerjaan/index', $data);
    }

    public function cariPekerjaan($nama)
    {
        $pekerjaan = $this->pekerjaanModel->where('nama', $nama)->first();
        return $pekerjaan['id_pekerjaan'];
    }
}

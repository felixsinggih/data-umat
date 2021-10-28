<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendidikanModel;

class Pendidikan extends BaseController
{
    function __construct()
    {
        $this->pendidikanModel = new PendidikanModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_pendidikan') ? $this->request->getVar('page_pendidikan') : 1;
        $pendidikan = $this->pendidikanModel;
        $data = [
            'title' => 'Pendidikan',
            'pendidikan' => $pendidikan->paginate(25, 'pendidikan'),
            'pager' => $pendidikan->pager,
            'act'   => ['master', 'pendidikan'],
            'currentPage' => $currentpage,
        ];
        return view('admin/data_master/pendidikan/index', $data);
    }

    public function cariPendidikan($nama)
    {
        $pendidikan = $this->pendidikanModel->where('nama', $nama)->first();
        return $pendidikan['id_pendidikan'];
    }
}

<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AktivitasModel;

class Aktivitas extends BaseController
{
    function __construct()
    {
        $this->aktivitasModel = new AktivitasModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_aktivitas') ? $this->request->getVar('page_aktivitas') : 1;
        $aktivitas = $this->aktivitasModel;
        $data = [
            'title' => 'Aktivitas Kemasyarakatan',
            'aktivitas' => $aktivitas->paginate(25, 'aktivitas'),
            'pager' => $aktivitas->pager,
            'act'   => ['master', 'aktivitas'],
            'currentPage' => $currentpage,
        ];
        return view('admin/data_master/aktivitas/index', $data);
    }
}

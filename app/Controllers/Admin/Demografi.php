<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\LingkunganModel;
use App\Models\AnggotaModel;

class Demografi extends BaseController
{
    function __construct()
    {
        $this->lingkunganModel = new LingkunganModel();
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Demografi Umat',
            'jmlKeluarga' => $this->lingkunganModel->hitungKeluargaByLingkungan()->findAll(),
            'jmlUmat' => $this->lingkunganModel->hitungUmatByLingkungan()->findAll(),
            'dibawah13' => $this->anggotaModel->hitungUmurUmat('>=', 0, '<=', 12)->first(),
            'dibawah19' => $this->anggotaModel->hitungUmurUmat('>=', 13, '<=', 18)->first(),
            'dibawah25' => $this->anggotaModel->hitungUmurUmat('>=', 19, '<=', 24)->first(),
            'dibawah35' => $this->anggotaModel->hitungUmurUmat('>=', 25, '<=', 34)->first(),
            'dibawah45' => $this->anggotaModel->hitungUmurUmat('>=', 35, '<=', 44)->first(),
            'dibawah55' => $this->anggotaModel->hitungUmurUmat('>=', 45, '<=', 54)->first(),
            'dibawah65' => $this->anggotaModel->hitungUmurUmat('>=', 55, '<=', 64)->first(),
            'diatas65' => $this->anggotaModel->hitungUmurUmat('>=', 65, '<', 100)->first(),
            'act'   => ['demografi', ''],
        ];
        return view('admin/demografi/index', $data);
    }
}

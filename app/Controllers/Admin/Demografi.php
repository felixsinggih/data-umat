<?php

namespace app\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\LingkunganModel;
use App\Models\AnggotaModel;
use App\Models\PekerjaanModel;
use App\Models\PendidikanModel;
use App\Models\DetailSekolahModel;

class Demografi extends BaseController
{
    protected $lingkunganModel;
    protected $anggotaModel;
    protected $pekerjaanModel;
    protected $pendidikanModel;
    protected $sekolahModel;
    function __construct()
    {
        $this->lingkunganModel = new LingkunganModel();
        $this->anggotaModel = new AnggotaModel();
        $this->pekerjaanModel = new PekerjaanModel();
        $this->pendidikanModel = new PendidikanModel();
        $this->sekolahModel = new DetailSekolahModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $lingkungan = $this->lingkunganModel->findAll();
        if ($keyword) {
            $jmlKeluarga = $this->lingkunganModel->hitungKeluargaByLingkungan($keyword)->findAll();
            $jmlUmat = $this->lingkunganModel->hitungUmatByLingkungan($keyword)->findAll();
            $demoUmur = $this->anggotaModel->demografiUmurByLingkungan($keyword);
            $demoDarah = $this->anggotaModel->demografiDarahByLingkungan($keyword)->findAll();
            $demoPekerjaan = $this->pekerjaanModel->demografiPekerjaanByLingkungan($keyword)->findAll();
            $demoPendidikan = $this->pendidikanModel->demografiPendidikanByLingkungan($keyword)->findAll();
            $demoSekolah = $this->sekolahModel->demografiSekolahByLingkungan($keyword)->findAll();
        } else {
            $jmlKeluarga = $this->lingkunganModel->hitungKeluarga()->findAll();
            $jmlUmat = $this->lingkunganModel->hitungUmat()->findAll();
            $demoUmur = $this->anggotaModel->demografiUmur();
            $demoDarah = $this->anggotaModel->demografiDarah()->findAll();
            $demoPekerjaan = $this->pekerjaanModel->demografiPekerjaan()->findAll();
            $demoPendidikan = $this->pendidikanModel->demografiPendidikan()->findAll();
            $demoSekolah = $this->sekolahModel->demografiSekolah()->findAll();
        }

        $data = [
            'title'     => 'Demografi Umat',
            'lingkungan' => $lingkungan,
            'jmlKeluarga' => $jmlKeluarga,
            'jmlUmat'   => $jmlUmat,
            'demoUmur'  => $demoUmur,
            'demoDarah' => $demoDarah,
            'demoPekerjaan' => $demoPekerjaan,
            'demoPendidikan' => $demoPendidikan,
            'demoSekolah' => $demoSekolah,
            'keyword'   => $keyword,
            'act'       => ['demografi', ''],
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/demografi/index', $data);
    }
}

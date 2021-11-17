<?php

namespace app\Controllers\AdminLingkungan;

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
        $idLingkungan = session()->get('lingkungan');
        $lingkungan = $this->lingkunganModel->find($idLingkungan);
        $jmlKeluarga = $this->lingkunganModel->hitungKeluargaByLingkungan($idLingkungan)->findAll();
        $jmlUmat = $this->lingkunganModel->hitungUmatByLingkungan($idLingkungan)->findAll();
        $demoUmur = $this->anggotaModel->demografiUmurByLingkungan($idLingkungan);
        $demoDarah = $this->anggotaModel->demografiDarahByLingkungan($idLingkungan)->findAll();
        $demoPekerjaan = $this->pekerjaanModel->demografiPekerjaanByLingkungan($idLingkungan)->findAll();
        $demoPendidikan = $this->pendidikanModel->demografiPendidikanByLingkungan($idLingkungan)->findAll();
        $demoSekolah = $this->sekolahModel->demografiSekolahByLingkungan($idLingkungan)->findAll();

        $data = [
            'title'         => 'Demografi Umat',
            'lingkungan'    => $lingkungan,
            'jmlKeluarga'   => $jmlKeluarga,
            'jmlUmat'       => $jmlUmat,
            'demoUmur'      => $demoUmur,
            'demoDarah'     => $demoDarah,
            'demoPekerjaan' => $demoPekerjaan,
            'demoPendidikan' => $demoPendidikan,
            'demoSekolah'   => $demoSekolah,
            'act'           => ['demografi', ''],
            'validation'    => \Config\Services::validation(),
        ];
        return view('admin/admin_lingkungan/demografi/index', $data);
    }
}

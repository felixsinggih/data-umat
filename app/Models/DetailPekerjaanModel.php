<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPekerjaanModel extends Model
{
    protected $table = 'dsc_detail_pekerjaan';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_anggota', 'id_pekerjaan'];

    public function showPekerjaan($idAnggota)
    {
        return $this->join('dsc_pekerjaan as pek', 'pek.id_pekerjaan = dsc_detail_pekerjaan.id_pekerjaan')
            ->where('dsc_detail_pekerjaan.id_anggota', $idAnggota)->first();
    }
}

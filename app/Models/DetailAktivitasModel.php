<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailAktivitasModel extends Model
{
    protected $table = 'dsc_detail_aktivitas';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_anggota', 'id_aktivitas'];

    public function showAktivitas($idAnggota)
    {
        return $this->join('dsc_aktivitas as akt', 'akt.id_aktivitas = dsc_detail_aktivitas.id_aktivitas')
            ->where('dsc_detail_aktivitas.id_anggota', $idAnggota)->findAll();
    }
}

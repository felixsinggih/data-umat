<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailKategorialModel extends Model
{
    protected $table = 'dsc_detail_kategorial';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_anggota', 'id_kategorial'];

    public function showKategorial($idAnggota)
    {
        return $this->join('dsc_kategorial as kat', 'kat.id_kategorial = dsc_detail_kategorial.id_kategorial')
            ->where('dsc_detail_kategorial.id_anggota', $idAnggota)->findAll();
    }
}

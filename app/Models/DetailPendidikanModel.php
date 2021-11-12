<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPendidikanModel extends Model
{
    protected $table = 'dsc_detail_pendidikan';
    protected $primaryKey = 'id_anggota';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_anggota', 'id_pendidikan'];

    public function cariPendidikan($idAnggota)
    {
        return $this->join('dsc_pendidikan as pend', 'pend.id_pendidikan = dsc_detail_pendidikan.id_pendidikan')
            ->where('dsc_detail_pendidikan.id_anggota', $idAnggota)->first();
    }

    public function showPendidikan($idAnggota)
    {
        return $this->join('dsc_pendidikan as pend', 'pend.id_pendidikan = dsc_detail_pendidikan.id_pendidikan')
            ->where('dsc_detail_pendidikan.id_anggota', $idAnggota)->first();
    }
}

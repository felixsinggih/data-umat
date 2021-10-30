<?php

namespace App\Models;

use CodeIgniter\Model;

class LingkunganModel extends Model
{
    protected $table = 'dsc_lingkungan';
    protected $primaryKey = 'id_lingkungan';

    public function hitungKeluargaByLingkungan()
    {
        return $this->select('count(dsc_lingkungan.id_lingkungan) as total, dsc_lingkungan.nama')
            ->join('dsc_keluarga as k', 'k.id_lingkungan = dsc_lingkungan.id_lingkungan')
            ->groupBy('dsc_lingkungan.id_lingkungan');
    }

    public function hitungUmatByLingkungan()
    {
        return $this->select('count(dsc_lingkungan.id_lingkungan) as total, dsc_lingkungan.nama')
            ->join('dsc_keluarga as k', 'k.id_lingkungan = dsc_lingkungan.id_lingkungan')
            ->join('dsc_anggota_keluarga as ak', 'ak.id_keluarga = k.id_keluarga')
            ->groupBy('dsc_lingkungan.id_lingkungan');
    }
}

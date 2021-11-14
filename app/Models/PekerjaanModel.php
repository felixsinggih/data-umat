<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table = 'dsc_pekerjaan';
    protected $primaryKey = 'id_pekerjaan';

    protected $allowedFields = ['nama'];

    public function cariPekerjaanExport($nama)
    {
        $aktivitas = $this->where('nama', $nama)->first();
        return $aktivitas['id_pekerjaan'];
    }

    public function demografiPekerjaan()
    {
        return $this->select('count(dsc_pekerjaan.id_pekerjaan) as total, dsc_pekerjaan.nama')
            ->join('dsc_detail_pekerjaan as dp', 'dp.id_pekerjaan = dsc_pekerjaan.id_pekerjaan')
            ->join('dsc_anggota_keluarga as ak', 'ak.id_anggota = dp.id_anggota')
            ->groupBy('dsc_pekerjaan.nama');
    }

    public function demografiPekerjaanByLingkungan($idLingkungan)
    {
        return $this->select('count(dsc_pekerjaan.id_pekerjaan) as total, dsc_pekerjaan.nama')
            ->join('dsc_detail_pekerjaan as dp', 'dp.id_pekerjaan = dsc_pekerjaan.id_pekerjaan')
            ->join('dsc_anggota_keluarga as ak', 'ak.id_anggota = dp.id_anggota')
            ->join('dsc_keluarga as k', 'k.id_keluarga = ak.id_keluarga')
            ->where('k.id_lingkungan', $idLingkungan)
            ->groupBy('dsc_pekerjaan.nama');
    }
}

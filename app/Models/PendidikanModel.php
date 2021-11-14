<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table = 'dsc_pendidikan';
    protected $primaryKey = 'id_pendidikan';

    public function cariPendidikanExport($nama)
    {
        $aktivitas = $this->where('nama', $nama)->first();
        return $aktivitas['id_pendidikan'];
    }

    public function demografiPendidikan()
    {
        return $this->select('count(dsc_pendidikan.id_pendidikan) as total, dsc_pendidikan.nama')
            ->join('dsc_detail_pendidikan as dp', 'dp.id_pendidikan = dsc_pendidikan.id_pendidikan')
            ->join('dsc_anggota_keluarga as ak', 'ak.id_anggota = dp.id_anggota')
            ->groupBy('dsc_pendidikan.nama');
    }

    public function demografiPendidikanByLingkungan($idLingkungan)
    {
        return $this->select('count(dsc_pendidikan.id_pendidikan) as total, dsc_pendidikan.nama')
            ->join('dsc_detail_pendidikan as dp', 'dp.id_pendidikan = dsc_pendidikan.id_pendidikan')
            ->join('dsc_anggota_keluarga as ak', 'ak.id_anggota = dp.id_anggota')
            ->join('dsc_keluarga as k', 'k.id_keluarga = ak.id_keluarga')
            ->where('k.id_lingkungan', $idLingkungan)
            ->groupBy('dsc_pendidikan.nama');
    }
}

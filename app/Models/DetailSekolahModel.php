<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailSekolahModel extends Model
{
    protected $table = 'dsc_detail_Sekolah';
    protected $primaryKey = 'id_anggota';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_anggota', 'satuan_pendidikan', 'nama', 'tingkat_pendidikan'];

    public function demografiSekolah()
    {
        return $this->select('count(dsc_detail_Sekolah.satuan_pendidikan) as total, dsc_detail_Sekolah.satuan_pendidikan as nama')
            ->join('dsc_anggota_keluarga as ak', 'ak.id_anggota = dsc_detail_Sekolah.id_anggota')
            ->groupBy('dsc_detail_Sekolah.satuan_pendidikan');
    }

    public function demografiSekolahByLingkungan($idLingkungan)
    {
        return $this->select('count(dsc_detail_Sekolah.satuan_pendidikan) as total, dsc_detail_Sekolah.satuan_pendidikan as nama')
            ->join('dsc_anggota_keluarga as ak', 'ak.id_anggota = dsc_detail_Sekolah.id_anggota')
            ->join('dsc_keluarga as k', 'k.id_keluarga = ak.id_keluarga')
            ->where('k.id_lingkungan', $idLingkungan)
            ->groupBy('dsc_detail_Sekolah.satuan_pendidikan');
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'dsc_anggota_keluarga';
    protected $primaryKey = 'id_anggota';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'id_keluarga', 'id_anggota', 'nik', 'nama_baptis', 'nama_lengkap', 'tempat_baptis', 'tgl_baptis',
        'tempat_krisma', 'tgl_krisma', 'jns_kelamin', 'gol_darah', 'tempat_lahir', 'tgl_lahir', 'status_keluarga',
        'ayah_kandung', 'ibu_kandung', 'pertanyaan', 'tempat_tinggal', 'telp'
    ];

    public function kodegenAnggota($idKeluarga)
    {
        $query = $this->select('max(right(id_anggota, 2)) as kode')
            ->like('id_anggota', $idKeluarga)
            ->orderBy('id_anggota', 'DESC')
            ->get()->getRowArray();
        if (!empty($query)) {
            $kode = intval($query['kode']) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodejadi = $idKeluarga . $kodemax;
        return $kodejadi;
    }
}

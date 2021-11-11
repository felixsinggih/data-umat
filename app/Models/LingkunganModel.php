<?php

namespace App\Models;

use CodeIgniter\Model;

class LingkunganModel extends Model
{
    protected $table = 'dsc_lingkungan';
    protected $primaryKey = 'id_lingkungan';

    protected $allowedFields = ['id_lingkungan', 'nama'];

    public function kodegenLingkungan()
    {
        $query = $this->select('max(right(id_lingkungan, 3)) as kode')
            ->like('id_lingkungan')
            ->orderBy('id_lingkungan', 'DESC')
            ->get()->getRowArray();
        if (!empty($query)) {
            $kode = intval($query['kode']) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = 'L' . $kodemax;
        return $kodejadi;
    }

    public function cariLingkunganExport($nama)
    {
        $aktivitas = $this->where('nama', $nama)->first();
        return $aktivitas['id_lingkungan'];
    }

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

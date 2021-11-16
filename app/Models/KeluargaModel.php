<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $table = 'dsc_keluarga';
    protected $primaryKey = 'id_keluarga';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_lingkungan', 'id_keluarga', 'no_kk', 'alamat', 'rt_rw', 'kelurahan', 'kecamatan'];

    public function kodegenKeluarga($idLingkungan)
    {
        $thn = substr(date('Y'), 2, 2);
        $bln = date('m');
        $hari = date('d');
        $param = $idLingkungan . $thn . $bln . $hari;
        $query = $this->select('max(right(id_keluarga, 3)) as kode')
            ->like('id_keluarga', $param)
            ->orderBy('id_keluarga', 'DESC')
            ->get()->getRowArray();
        if (!empty($query)) {
            $kode = intval($query['kode']) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = $param . $kodemax;
        return $kodejadi;
    }

    public function viewAll($keyword)
    {
        if ($keyword) {
            return $this
                ->join('dsc_lingkungan as l', 'l.id_lingkungan = dsc_keluarga.id_lingkungan')
                ->join('dsc_anggota_keluarga as ak', 'ak.id_keluarga = dsc_keluarga.id_keluarga')
                ->where('ak.is_head', 'Y')
                ->like('dsc_keluarga.no_kk', $keyword)
                ->orLike('ak.nik', $keyword)
                ->orLike('ak.nama_lengkap', $keyword);
        } else {
            return $this
                ->join('dsc_lingkungan as l', 'l.id_lingkungan = dsc_keluarga.id_lingkungan')
                ->join('dsc_anggota_keluarga as ak', 'ak.id_keluarga = dsc_keluarga.id_keluarga')
                ->where('ak.is_head', 'Y');
        }
    }

    public function dataKeluarga($idKeluarga)
    {
        return $this
            ->join('dsc_lingkungan as l', 'l.id_lingkungan = dsc_keluarga.id_lingkungan')
            ->join('dsc_anggota_keluarga as ak', 'ak.id_keluarga = dsc_keluarga.id_keluarga')
            ->where('ak.is_head', 'Y')
            ->like('dsc_keluarga.id_keluarga', $idKeluarga);
    }

    public function cekKkEdit($kk, $idKeluarga)
    {
        return $this->where('no_kk', $kk)
            ->where('id_keluarga !=', $idKeluarga);
    }
}

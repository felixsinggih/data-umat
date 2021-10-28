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
}

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
        'ayah_kandung', 'ibu_kandung', 'pertanyaan', 'tempat_tinggal', 'telp', 'is_head'
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

    public function dataAnggota($idKeluarga)
    {
        return $this
            ->select('dsc_anggota_keluarga.*, ds.satuan_pendidikan, dpen.id_pendidikan, pen.nama as nama_pendidikan, dper.tempat_menikah, 
            dper.tgl_menikah, dpek.id_pekerjaan, pek.nama as nama_pekerjaan')
            ->join('dsc_detail_sekolah as ds', 'ds.id_anggota = dsc_anggota_keluarga.id_anggota', 'left')
            ->join('dsc_detail_pendidikan as dpen', 'dpen.id_anggota = dsc_anggota_keluarga.id_anggota', 'left')
            ->join('dsc_pendidikan as pen', 'pen.id_pendidikan = dpen.id_pendidikan', 'left')
            ->join('dsc_detail_pernikahan as dper', 'dper.id_anggota = dsc_anggota_keluarga.id_anggota', 'left')
            ->join('dsc_detail_pekerjaan as dpek', 'dpek.id_anggota = dsc_anggota_keluarga.id_anggota', 'left')
            ->join('dsc_pekerjaan as pek', 'pek.id_pekerjaan = dpek.id_pekerjaan', 'left')
            ->where('dsc_anggota_keluarga.id_keluarga', $idKeluarga)
            ->orderBy('dsc_anggota_keluarga.id_anggota', 'ASC')
            ->findAll();
    }

    // ** GAK KEPAKE
    public function hitungUmurUmat($operatorMin, $umurMin, $operatorMax, $umurMax)
    {
        return $this->select('count(timestampdiff(year, tgl_lahir, curdate())) as jumlah')
            ->where('timestampdiff(year, tgl_lahir, curdate()) ' . $operatorMin, $umurMin)
            ->where('timestampdiff(year, tgl_lahir, curdate()) ' . $operatorMax, $umurMax);
    }

    public function demografiUmur()
    {
        return $this->db->table('view_umur')->select('SUM(IF(umur BETWEEN 0 AND 12,1,0)) AS dua_belas, 
        SUM(IF(umur BETWEEN 13 AND 18,1,0)) AS delapan_belas, 
        SUM(IF(umur BETWEEN 19 AND 25,1,0)) AS dua_lima,
        SUM(IF(umur BETWEEN 26 AND 35,1,0)) AS tiga_lima,
        SUM(IF(umur BETWEEN 36 AND 45,1,0)) AS empat_lima,
        SUM(IF(umur BETWEEN 46 AND 55,1,0)) AS lima_lima,
        SUM(IF(umur BETWEEN 56 AND 65,1,0)) AS enam_lima,
        SUM(IF(umur > 65,1,0)) AS enam_lima_keatas,
        SUM(IF(umur IS null,1,0)) AS tidak_diketahui')->get()->getResultArray();
    }

    public function demografiUmurByLingkungan($idLingkungan)
    {
        return $this->db->table('view_umur')->select('SUM(IF(umur BETWEEN 0 AND 12,1,0)) AS dua_belas, 
        SUM(IF(umur BETWEEN 13 AND 18,1,0)) AS delapan_belas, 
        SUM(IF(umur BETWEEN 19 AND 25,1,0)) AS dua_lima,
        SUM(IF(umur BETWEEN 26 AND 35,1,0)) AS tiga_lima,
        SUM(IF(umur BETWEEN 36 AND 45,1,0)) AS empat_lima,
        SUM(IF(umur BETWEEN 46 AND 55,1,0)) AS lima_lima,
        SUM(IF(umur BETWEEN 56 AND 65,1,0)) AS enam_lima,
        SUM(IF(umur > 65,1,0)) AS enam_lima_keatas,
        SUM(IF(umur IS null,1,0)) AS tidak_diketahui')
            ->where('id_lingkungan', $idLingkungan)->get()->getResultArray();
    }

    public function demografiDarah()
    {
        return $this->select('count(gol_darah) as total, gol_darah')
            ->groupBy('gol_darah');
    }

    public function demografiDarahByLingkungan($idLingkungan)
    {
        return $this->select('count(dsc_anggota_keluarga.gol_darah) as total, dsc_anggota_keluarga.gol_darah')
            ->join('dsc_keluarga as k', 'k.id_keluarga = dsc_anggota_keluarga.id_keluarga')
            ->where('k.id_lingkungan', $idLingkungan)
            ->groupBy('dsc_anggota_keluarga.gol_darah');
    }

    public function cekNikEdit($nik, $idAnggota)
    {
        return $this->where('nik', $nik)
            ->where('id_anggota !=', $idAnggota);
    }

    public function findAnggotaByLingkungan($idLingkungan, $idAnggota)
    {
        return $this->join('dsc_keluarga as k', 'k.id_keluarga = dsc_anggota_keluarga.id_keluarga')
            ->where('k.id_lingkungan', $idLingkungan)
            ->where('dsc_anggota_keluarga.id_anggota', $idAnggota);
    }
}

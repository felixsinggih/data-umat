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

    public function hitungUmurUmat($operatorMin, $umurMin, $operatorMax, $umurMax)
    {
        return $this->select('count(timestampdiff(year, tgl_lahir, curdate())) as jumlah')
            ->where('timestampdiff(year, tgl_lahir, curdate()) ' . $operatorMin, $umurMin)
            ->where('timestampdiff(year, tgl_lahir, curdate()) ' . $operatorMax, $umurMax);
    }
}

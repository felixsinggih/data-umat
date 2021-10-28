<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailSekolahModel extends Model
{
    protected $table = 'dsc_detail_Sekolah';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_anggota', 'satuan_pendidikan', 'nama', 'tingkat_pendidikan'];
}

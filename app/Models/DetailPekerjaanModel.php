<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPekerjaanModel extends Model
{
    protected $table = 'dsc_detail_pekerjaan';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_anggota', 'id_pekerjaan'];
}

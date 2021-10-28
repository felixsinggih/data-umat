<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPendidikanModel extends Model
{
    protected $table = 'dsc_detail_pendidikan';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_anggota', 'id_pendidikan'];
}

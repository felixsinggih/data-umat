<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPernikahanModel extends Model
{
    protected $table = 'dsc_detail_pernikahan';

    protected $useTimestamps = true;

    protected $allowedFields = ['id_anggota', 'tempat_menikah', 'tgl_menikah'];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ParokiModel extends Model
{
    protected $table = 'dsc_paroki';
    protected $primaryKey = 'id_paroki';

    protected $allowedFields = ['nama', 'telp', 'email', 'alamat', 'logo'];
}

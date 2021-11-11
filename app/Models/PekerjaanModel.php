<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table = 'dsc_pekerjaan';
    protected $primaryKey = 'id_pekerjaan';

    protected $allowedFields = ['nama'];

    public function cariPekerjaanExport($nama)
    {
        $aktivitas = $this->where('nama', $nama)->first();
        return $aktivitas['id_pekerjaan'];
    }
}

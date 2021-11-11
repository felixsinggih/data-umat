<?php

namespace App\Models;

use CodeIgniter\Model;

class AktivitasModel extends Model
{
    protected $table = 'dsc_aktivitas';
    protected $primaryKey = 'id_aktivitas';

    protected $allowedFields = ['nama'];

    public function cariAktivitasExport($nama)
    {
        $aktivitas = $this->where('nama', $nama)->first();
        return $aktivitas['id_aktivitas'];
    }
}

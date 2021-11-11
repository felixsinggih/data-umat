<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table = 'dsc_pendidikan';
    protected $primaryKey = 'id_pendidikan';

    public function cariPendidikanExport($nama)
    {
        $aktivitas = $this->where('nama', $nama)->first();
        return $aktivitas['id_pendidikan'];
    }
}

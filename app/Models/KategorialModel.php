<?php

namespace App\Models;

use CodeIgniter\Model;

class KategorialModel extends Model
{
    protected $table = 'dsc_kategorial';
    protected $primaryKey = 'id_kategorial';

    protected $allowedFields = ['nama'];

    public function cariKategorialExport($nama)
    {
        $kategorial = $this->where('nama', $nama)->first();
        return $kategorial['id_kategorial'];
    }

    public function kategorialNotChecked($kategorialArray)
    {
        return $this->whereNotIn('id_kategorial', $kategorialArray)->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersLingkunganModel extends Model
{
    protected $table = 'dsc_users_lingkungan';
    protected $primaryKey = 'uid_lingkungan';

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $allowedFields = ['uid_lingkungan', 'uid', 'id_lingkungan'];


    public function kodegen()
    {
        $thn = date('Y');
        $bln = date('m');
        $param = $thn . $bln;
        $query = $this->select('max(right(uid_lingkungan, 3)) as kode')
            ->like('uid_lingkungan', $param)
            ->orderBy('uid_lingkungan', 'DESC')
            ->get()->getRowArray();
        if (!empty($query)) {
            $kode = intval($query['kode']) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = $param . $kodemax;
        return $kodejadi;
    }
}

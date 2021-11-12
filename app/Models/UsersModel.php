<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'dsc_users';
    protected $primaryKey = 'uid';

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $allowedFields = ['uid', 'name', 'email', 'username', 'password', 'role', 'status', 'is_first'];


    public function kodegenSuperadmin()
    {
        $thn = date('Y');
        $bln = date('m');
        $param = 'AD' . $thn . $bln;
        $query = $this->select('max(right(uid, 2)) as kode')
            ->like('uid', $param)
            ->orderBy('uid', 'DESC')
            ->get()->getRowArray();
        if (!empty($query)) {
            $kode = intval($query['kode']) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodejadi = $param . $kodemax;
        return $kodejadi;
    }

    public function selectUserRole($role)
    {
        return $this->where('role', $role)->orderBy('uid', 'ASC');
    }
}

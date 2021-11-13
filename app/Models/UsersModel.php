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

    public function showAdmin()
    {
        return $this->select('dsc_users.uid, dsc_users.name, dsc_users.email, dsc_users.username, dsc_users.role, dsc_users.status,
        dsc_users.is_first, dsc_users.created_at, dsc_users.updated_at, l.nama, l.id_lingkungan, ul.uid_lingkungan')
            ->join('dsc_users_lingkungan as ul', 'ul.uid = dsc_users.uid', 'left')
            ->join('dsc_lingkungan as l', 'l.id_lingkungan = ul.id_lingkungan', 'left');
    }

    public function selectAdmin($uid)
    {
        return $this->select('dsc_users.uid, dsc_users.name, dsc_users.email, dsc_users.username, dsc_users.role, dsc_users.status,
        dsc_users.is_first, dsc_users.created_at, dsc_users.updated_at, l.nama, l.id_lingkungan, ul.uid_lingkungan')
            ->join('dsc_users_lingkungan as ul', 'ul.uid = dsc_users.uid', 'left')
            ->join('dsc_lingkungan as l', 'l.id_lingkungan = ul.id_lingkungan', 'left')
            ->where('dsc_users.uid', $uid)->first();
    }

    public function kodegen()
    {
        $thn = date('Y');
        $bln = date('m');
        $param = 'AD' . $thn . $bln;
        $query = $this->select('max(right(uid, 3)) as kode')
            ->like('uid', $param)
            ->orderBy('uid', 'DESC')
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

<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $useTimestamps = true;

    protected $allowedFields = ['name', 'username', 'password', 'role'];

    public function getAllUser()
    {
        $query = $this->db->table('user')
            ->orderBy('role', 'DESC')
            ->get();

        return $query;
    }

    public function getUserByUsername($username)
    {
        $query = $this->db->table('user')
            ->where('username', $username)
            ->get();

        return $query;
    }
}

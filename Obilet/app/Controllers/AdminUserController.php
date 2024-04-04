<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class AdminUserController extends Controller
{
    protected $db;
    use ResponseTrait;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function adminuserlist()
    {
        $query = $this->db->query("SELECT * FROM users WHERE role_id = 2 AND status = 1");
        $users = $query->getResult();
        return $this->respond($users, 200);
    }

    
}

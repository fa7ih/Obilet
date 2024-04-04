<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends CrudModel
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $allowedFields = ['name'];

    public function users()
    {
        return $this->hasMany(UserModel::class, 'role_id', 'role_id');
    }
}

?>

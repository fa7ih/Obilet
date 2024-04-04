<?php

namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{
    protected $table = '';
    protected $primaryKey = '';
    protected $allowedFields = []; 

    

    public function getAll()
    {
        return $this->findAll();
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function create($data)
    {
        return $this->insert($data);
    }

    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }
}

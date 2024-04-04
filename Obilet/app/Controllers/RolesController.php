<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class RolesController extends BaseController
{
    use ResponseTrait;

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function assignRole()
    {
        if ($this->request->getMethod() === 'post') {
            $userId = $this->request->getPost('user_id');
            $roleId = $this->request->getPost('role_id');

            $success = $this->assignRoleToUser($userId, $roleId);

            if ($success) {
                return $this->respond(['success' => true, 'message' => 'Rol atama başarıyla tamamlandı.']);
            } else {
                return $this->respond(['success' => false, 'message' => 'Rol atama sırasında bir hata oluştu.'], 500);
            }
        }

        return $this->respond(['success' => false, 'message' => 'Geçersiz istek.'], 400);
    }

    public function listRoles()
    {
        $query = $this->db->query("SELECT * FROM roles");
        $result = $query->getResult(); 

        $data = array(); 

        foreach ($result as $row) {
            $data[] = array(
                'role_id' => $row->role_id,
                'name' => $row->name
            );
        }

        return $this->respond($data);
    }

    public function editRole($roleId)
{
    if ($this->request->getMethod() === 'post') {
        $newRoleName = $this->request->getPost('new_role_name');

        $query = "UPDATE roles SET name = ? WHERE role_id = ?";
        $result = $this->db->query($query, [$newRoleName, $roleId]);

        if ($result) {
            return $this->respond(['success' => true, 'message' => 'Rol adı başarıyla güncellendi.']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Rol adı güncelleme sırasında bir hata oluştu.'], 500);
        }
    }

    return $this->respond(['success' => false, 'message' => 'Geçersiz istek.'], 400);
}



    //ilişkisel tablo yok diye bıraktım ...
    // private function assignRoleToUser($userId, $roleId)
    // {
    //     $query = $this->db->query("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)", [$userId, $roleId]);
    //     return $query;
    // }


    private function updateRoleName($roleId, $newRoleName)
    {
        $query = $this->db->query("UPDATE roles SET name = ? WHERE role_id = ?", [$newRoleName, $roleId]);
        return $query;
    }

}

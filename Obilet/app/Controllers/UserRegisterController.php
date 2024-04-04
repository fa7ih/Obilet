<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;


class UserRegisterController extends BaseController
{

    use ResponseTrait;

    protected $table = 'users';

    public function registerUsers()
        {
            try {
                $db      = \Config\Database::connect();
                $builder = $db->table($this->table);

    $adi = $this->request->getVar('Adi');
    $soyadi = $this->request->getVar('Soyadi');
    $dogumTarihi = $this->request->getVar('DogumTarihi');
    $roleId = $this->request->getVar('role_id');
    $cinsiyet = $this->request->getVar('Cinsiyet');
    $cepTelefonu = $this->request->getVar('CepTelefonu');
    $email = $this->request->getVar('email');
    $tckimlikNoVeyaPasaportNo = $this->request->getVar('TCKimlikNoVeyaPasaportNo');
    $sifre = $this->request->getVar('Sifre');

    $insertData = [
        'Adi' => $adi,
        'Soyadi' => $soyadi,
        'DogumTarihi' => $dogumTarihi,
        'role_id' => $roleId,
        'Cinsiyet' => $cinsiyet,
        'CepTelefonu' => $cepTelefonu,
        'email' => $email,
        'TCKimlikNoVeyaPasaportNo' => $tckimlikNoVeyaPasaportNo,
        'Sifre' => $sifre
    ];


            $builder->insert($insertData);

            if ($db->affectedRows() > 0) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Başarılı.'
                ], 200);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Ekleme işlemi başarısız oldu.'
                ], 400);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getUsers()
    {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table($this->table);

            $builder->select('Adi, Soyadi, DogumTarihi, role_id, Cinsiyet, CepTelefonu, email, TCKimlikNoVeyaPasaportNo, Sifre, Bakiye, status')
                ->where('role_id', 2)
                ->where('status', 1)
                ->where('Bakiye', 0);

            $query = $builder->get();
            $users = $query->getResult();

            return $this->respond($users, 200);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

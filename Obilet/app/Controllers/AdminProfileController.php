<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class AdminProfileController extends BaseController
{
    use ResponseTrait;
    protected $db;
    protected $session; 

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
    }

    public function index()
    {
        $userId = $this->session->get('user_id'); 

        $query = $this->db->query("SELECT * FROM users WHERE KullaniciID = ?", [$userId]);
        $user = $query->getRow();

        return $this->respond([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function update()
    {
        $userId = $this->session->get('user_id');
        $name = $this->request->getPost('name');
        $surname = $this->request->getPost('surname');
        $birthdate = $this->request->getPost('birthdate');
        $gender = $this->request->getPost('gender');
        $phone = $this->request->getPost('phone');
        $email = $this->request->getPost('email');
        $identityNumber = $this->request->getPost('identity_number');
        $password = $this->request->getPost('password');

        $query = $this->db->query("UPDATE users SET Adi = ?, Soyadi = ?, DogumTarihi = ?, Cinsiyet = ?, CepTelefonu = ?, email = ?, TCKimlikNoVeyaPasaportNo = ?, Sifre = ? WHERE KullaniciID = ?", [$name, $surname, $birthdate, $gender, $phone, $email, $identityNumber, $password, $userId]);

        if ($query) {
            return $this->respond([
                'success' => true,
                'message' => 'Profil bilgileriniz başarıyla güncellendi.'
            ], 200);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Profil bilgileriniz güncellenirken bir hata oluştu. Lütfen tekrar deneyin.'
            ], 400);
        }
    }
}

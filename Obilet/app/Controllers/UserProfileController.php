<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class UserProfileController extends BaseController
{
    use ResponseTrait;

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $userId = $this->session->get('user_id');

        $query = $this->db->query("SELECT * FROM users WHERE KullaniciID = $userId");
        $user = $query->getRow();

        return $this->respond($user);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        $name = $this->request->getPost('name');
        $surname = $this->request->getPost('surname');
        $birthdate = $this->request->getPost('birthdate');
        $gender = $this->request->getPost('gender');
        $phone = $this->request->getPost('phone');
        $email = $this->request->getPost('email');
        $identityNumber = $this->request->getPost('identity_number');
        $password = $this->request->getPost('password');

        $query = $this->db->query("UPDATE users SET Adi = '$name', Soyadi = '$surname', DogumTarihi = '$birthdate', Cinsiyet = '$gender', CepTelefonu = '$phone', email = '$email', TCKimlikNoVeyaPasaportNo = '$identityNumber', Sifre = '$password' WHERE KullaniciID = $userId");

        if ($query) {
            return $this->respond(['success' => true, 'message' => 'Profil bilgileriniz başarıyla güncellendi.']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Profil bilgileriniz güncellenirken bir hata oluştu. Lütfen tekrar deneyin.'], 500);
        }
    }
    
}

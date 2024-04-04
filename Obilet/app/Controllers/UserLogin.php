<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class UserLogin extends BaseController
{
    use ResponseTrait;

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function authenticate() {

        $UserEmail = $this->request->getVar('email');
        $UserSifre = $this->request->getVar('sifre');

        if (empty($UserEmail) || empty($UserSifre)) {
            return $this->respond([
                'success' => false,
                'message' => 'Lütfen email ve şifre girin.'
            ], 200);
        }

        // Veritabanından kullanıcıyı seç
        $query = $this->db->query("SELECT * FROM users WHERE email = ?", [$UserEmail]);
        $result = $query->getResult();

        if (!empty($result)) {
            $firstRow = $result[0]; 
        
            $dbSifre = $firstRow->Sifre; 
            $email = $firstRow->email; 
            $status = $firstRow->status;
            $role_id = $firstRow->role_id;            
            $KullaniciID = $firstRow->KullaniciID; 

            // Şifreleri karşılaştır
            if ($UserSifre === $dbSifre) {

                // Şifre eşleştiği durumda frontende kullanıcı bilgilerini gönder
                $userData = [
                    'success' => true,
                    'email' => $email,
                    'status' => $status,
                    'role_id' => $role_id,
                    'KullaniciID' => $KullaniciID
                ];

                $jsonData = json_encode($userData);
                
                return $this->respond($jsonData);

            } else {
                // Şifre eşleşmezse frontende "başarısız" mesajını döndür
                return $this->respond([
                    'success' => false,
                    'message' => 'Şifre doğrulanamadı.'
                ], 200);
            }
        } else {

            // Kullanıcı bulunamazsa frontende "Kullanıcı bulunamadı." mesajını döndür
            return $this->respond([
                'success' => false,
                'message' => 'Kullanıcı bulunamadı.'
            ], 200);
        }
    }

    



    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
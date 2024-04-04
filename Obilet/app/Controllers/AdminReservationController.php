<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class AdminReservationController extends BaseController
{
    protected $db;
    use ResponseTrait;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $query = $this->db->query('SELECT * FROM reservations');
        $reservations = $query->getResult();

        return $this->respond($reservations, 200);
    }

    public function show($id)
    {
        $query = $this->db->query("SELECT * FROM reservations WHERE RezervasyonID = $id");
        $reservation = $query->getRow();

        return $this->respond($reservation, 200);
    }

    public function edit($id)
    {
        $query = $this->db->query("SELECT * FROM reservations WHERE RezervasyonID = $id");
        $reservation = $query->getRow();

        return $this->respond($reservation, 200);
    }

    public function update($id)
    {
        $aktifDurumu = $this->request->getPost('AktifDurumu');

        $query = $this->db->query("UPDATE reservations SET AktifDurumu = '$aktifDurumu' WHERE RezervasyonID = $id");

        if ($query) {
            return $this->respond(['success' => true, 'message' => 'Rezervasyon güncellendi'], 200);
        } else {
            return $this->respond(['success' => false, 'message' => 'Rezervasyon güncellenirken bir hata oluştu'], 400);
        }
    }

    public function delete($id)
    {
        $query = $this->db->query("UPDATE reservations SET status = 0 WHERE RezervasyonID = $id");

        if ($query) {
            return $this->respond(['success' => true, 'message' => 'Rezervasyon durumu güncellendi'], 200);
        } else {
            return $this->respond(['success' => false, 'message' => 'Rezervasyon durumu güncellenirken bir hata oluştu'], 400);
        }
    }

    public function userList()
    {
        $query = $this->db->query("SELECT * FROM users WHERE role_id = 2 AND status = 1");
        $users = $query->getResult();

        return $this->respond($users, 200);
    }

    public function userReservations($userId)
    {
        $query = $this->db->query("SELECT * FROM reservations WHERE KullaniciID = $userId");
        $reservations = $query->getResult();

        return $this->respond($reservations, 200);
    }
}

<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class ReservationController extends BaseController
{
    protected $db;
    use ResponseTrait;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $query = $this->db->query('SELECT * FROM reservations WHERE Status = 1');
        $reservations = $query->getResult();

        return $this->respond($reservations);
    }

    public function store()
    {
        $kullaniciID = $this->request->getVar('KullaniciID');
        $seferID = $this->request->getVar('SeferID');
        $koltukID = $this->request->getVar('KoltukID');
        $tarih = date('Y-m-d');
        $aktifDurumu = 'RezerveEdildi';
        $status = 1;

        if (!empty($kullaniciID) && !empty($seferID) && !empty($koltukID)) {
            $query = $this->db->query("INSERT INTO reservations (KullaniciID, SeferID, KoltukID, Tarih, AktifDurumu, Status) VALUES ($kullaniciID, $seferID, $koltukID, '$tarih', '$aktifDurumu', $status)");

            if ($this->db->affectedRows() > 0) {
                return $this->respond(['success' => true, 'message' => 'Rezervasyon başarıyla kaydedildi.']);
            } else {
                return $this->respond(['success' => false, 'message' => 'Rezervasyon kaydedilemedi.'], 500);
            }
        } else {
            return $this->respond(['success' => false, 'message' => 'Ekleme için gerekli tüm alanlar doldurulmalıdır.'], 400);
        }
    }



    public function show($id)
    {
        $query = $this->db->query("SELECT * FROM reservations WHERE RezervasyonID = $id");
        $reservation = $query->getRow();

        if ($reservation) {
            return $this->respond($reservation);
        } else {
            return $this->respond(['success' => false, 'message' => 'Rezervasyon bulunamadı.'], 404);
        }
    }

    public function update($id)
{
    $kullaniciID = $this->request->getVar('KullaniciID');
    $seferID = $this->request->getVar('SeferID');
    $koltukID = $this->request->getVar('KoltukID');
    $aktifDurumu = $this->request->getVar('AktifDurumu');

    if ($kullaniciID !== null || $seferID !== null || $koltukID !== null || $aktifDurumu !== null) {
        $query = "UPDATE reservations SET ";
        $params = [];

        if ($kullaniciID !== null) {
            $query .= "KullaniciID = ?, ";
            $params[] = $kullaniciID;
        }
        if ($seferID !== null) {
            $query .= "SeferID = ?, ";
            $params[] = $seferID;
        }
        if ($koltukID !== null) {
            $query .= "KoltukID = ?, ";
            $params[] = $koltukID;
        }
        if ($aktifDurumu !== null) {
            $query .= "AktifDurumu = ?, ";
            $params[] = $aktifDurumu;
        }

        $query = rtrim($query, ", ");
        $query .= " WHERE RezervasyonID = ?";
        $params[] = $id;

        $result = $this->db->query($query, $params);

        if ($this->db->affectedRows() > 0) {
            return $this->respond(['success' => true, 'message' => 'Rezervasyon başarıyla güncellendi.']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Belirtilen ID ile eşleşen rezervasyon bulunamadı veya güncelleme yapılamadı.'], 404);
        }
    } else {
        return $this->respond(['success' => false, 'message' => 'Güncelleme için en az bir alan dolu olmalıdır.'], 400);
    }
}

    


    public function delete($id)
    {
        $query = $this->db->query("UPDATE reservations SET Status = 0 WHERE RezervasyonID = $id");

        if ($this->db->affectedRows() > 0) {
            return $this->respond(['success' => true, 'message' => 'Rezervasyon başarıyla silindi.']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Belirtilen ID ile eşleşen rezervasyon bulunamadı veya silme yapılamadı.'], 404);
        }
    }
}

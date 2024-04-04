<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class UserReservationController extends BaseController
{
    use ResponseTrait;

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $request = $this->request->getJSON();
        $kullaniciID = $request->KullaniciID;

        $query = $this->db->query("SELECT r.*, b.KalkisSehri, b.VarisSehri FROM reservations r 
                                   LEFT JOIN bus_routes b ON r.SeferID = b.SeferID 
                                   WHERE r.KullaniciID = ? AND r.status = 1", [$kullaniciID]);
        $reservations = $query->getResult();

        return $this->respond($reservations);
    }

    public function store()
    {
        $request = $this->request->getJSON();

        $kullaniciID = $request->KullaniciID;
        $seferID = $request->SeferID;
        $koltukID = $request->KoltukID;
        $tarih = date('Y-m-d');
        $aktifDurumu = 'RezerveEdildi';

        $query = $this->db->query("INSERT INTO reservations (KullaniciID, SeferID, KoltukID, Tarih, AktifDurumu) VALUES (?, ?, ?, ?, ?)", [$kullaniciID, $seferID, $koltukID, $tarih, $aktifDurumu]);

        if ($query) {
            return $this->respondCreated(['success' => true, 'message' => 'Rezervasyon başarıyla oluşturuldu.']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Rezervasyon oluşturma sırasında bir hata oluştu.'], 500);
        }
    }

    public function purchaseWithCreditCard($id)
    {
        $request = $this->request->getJSON();

        $kartNumarasi = $request->kart_numarasi;
        $sonKullanmaTarihi = $request->son_kullanma_tarihi;
        $cvv = $request->cvv;
        $kullaniciID = $request->KullaniciID;

        $query = $this->db->query("SELECT Ucret FROM reservations WHERE KullaniciID = ? AND RezervasyonID = ?", [$kullaniciID, $id]);
        $reservation = $query->getRow();
        $ucret = $reservation->Ucret;

        $odemeBasarili = true; 

        if ($odemeBasarili) {
            $userModel = new UserModel();
            $user = $userModel->find($kullaniciID);

            $newBalance = $user['Bakiye'] - $ucret;
            $userModel->update($kullaniciID, ['Bakiye' => $newBalance]);

            $this->db->query("UPDATE reservations SET AktifDurumu = 'SatinAlindi' WHERE KullaniciID = ? AND RezervasyonID = ?", [$kullaniciID, $id]);

            return $this->respond(['success' => true, 'message' => 'Rezervasyon başarıyla satın alındı.']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Ödeme işlemi başarısız oldu. Lütfen tekrar deneyin.'], 500);
        }
    }

    public function cancelReservation($userID, $reservationID)
    {
        $reservation = $this->db->table('reservations')
            ->select('Ucret')
            ->where('KullaniciID', $userID)
            ->where('RezervasyonID', $reservationID)
            ->get()
            ->getRow();

        if (!$reservation) {
            return $this->respond(['success' => false, 'message' => 'Rezervasyon bulunamadı.'], 404);
        }

        $ucret = $reservation->Ucret;

        $userModel = new UserModel();
        $user = $userModel->find($userID);
        $newBalance = $user['Bakiye'] + $ucret;
        $userModel->update($userID, ['Bakiye' => $newBalance]);

        $this->db->table('reservations')
            ->where('KullaniciID', $userID)
            ->where('RezervasyonID', $reservationID)
            ->update(['AktifDurumu' => 'IptalEdildi']);

        return $this->respond(['success' => true, 'message' => 'Rezervasyon başarıyla iptal edildi. Bakiyeye iade edilen tutar: ' . $ucret]);
    }

    


    public function update($id)
    {
        $request = $this->request->getJSON();

        $kullaniciID = $request->KullaniciID;
        $seferID = $request->SeferID;
        $koltukID = $request->KoltukID;
        $aktifDurumu = $request->AktifDurumu;

        $query = $this->db->query("UPDATE reservations SET SeferID = ?, KoltukID = ?, AktifDurumu = ? WHERE KullaniciID = ? AND RezervasyonID = ?", [$seferID, $koltukID, $aktifDurumu, $kullaniciID, $id]);

        if ($query) {
            return $this->respond(['success' => true, 'message' => 'Rezervasyon başarıyla güncellendi.']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Rezervasyon güncelleme sırasında bir hata oluştu.'], 500);
        }
    }

    public function edit($id)
    {
        $request = $this->request->getJSON();
        $kullaniciID = $request->KullaniciID;

        $query = $this->db->query("SELECT * FROM reservations WHERE KullaniciID = ? AND RezervasyonID = ?", [$kullaniciID, $id]);
        $reservation = $query->getRow();

        return $this->respond($reservation);
    }

    public function show($id)
    {
        $request = $this->request->getJSON();
        $kullaniciID = $request->KullaniciID;

        $query = $this->db->query("SELECT r.*, b.KalkisSehri, b.VarisSehri FROM reservations r 
                                   LEFT JOIN bus_routes b ON r.SeferID = b.SeferID 
                                   WHERE r.KullaniciID = ? AND r.RezervasyonID = ?", [$kullaniciID, $id]);
        $reservation = $query->getRow();

        return $this->respond($reservation);
    }

    public function delete($id)
    {
        $request = $this->request->getJSON();
        $kullaniciID = $request->KullaniciID;

        $query = $this->db->query("DELETE FROM reservations WHERE KullaniciID = ? AND RezervasyonID = ?", [$kullaniciID, $id]);

        return $this->respondDeleted();
    }
}

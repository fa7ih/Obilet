<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class PaymentController extends BaseController
{
    protected $db;
    use ResponseTrait;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $query = $this->db->query('SELECT * FROM payments WHERE Status = 1');
        $data['payments'] = $query->getResult();

        return json_encode($data);
    }

    public function store()
    {
        $kullaniciID = $this->request->getPost('KullaniciID');
        $biletID = $this->request->getPost('BiletID');
        $tarih = date('Y-m-d');
        $miktar = $this->request->getPost('Miktar');
        $odemeYontemi = $this->request->getPost('OdemeYontemi');
        $status = 1;

        $query = $this->db->query("INSERT INTO payments (KullaniciID, BiletID, Tarih, Miktar, OdemeYontemi, Status) VALUES (?, ?, ?, ?, ?, ?)", [$kullaniciID, $biletID, $tarih, $miktar, $odemeYontemi, $status]);

        if ($this->db->affectedRows() > 0) {
            return json_encode(['success' => true, 'message' => 'Ödeme başarıyla kaydedildi.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Ödeme kaydedilirken bir hata oluştu.']);
        }
    }


    public function show($id)
    {
        $query = $this->db->query("SELECT * FROM payments WHERE OdemeID = $id");
        $data['payment'] = $query->getRow();

        return json_encode($data);
    }

    public function edit($id)
    {
        $query = $this->db->query("SELECT * FROM payments WHERE OdemeID = $id");
        $data['payment'] = $query->getRow();

        return json_encode($data);
    }

    public function update($id)
    {
        $kullaniciID = $this->request->getPost('KullaniciID');
        $biletID = $this->request->getPost('BiletID');
        $miktar = $this->request->getPost('Miktar');
        $odemeYontemi = $this->request->getPost('OdemeYontemi');

        $query = $this->db->query("UPDATE payments SET KullaniciID = ?, BiletID = ?, Miktar = ?, OdemeYontemi = ? WHERE OdemeID = ?", [$kullaniciID, $biletID, $miktar, $odemeYontemi, $id]);

        if ($this->db->affectedRows() > 0) {
            return json_encode(['success' => true, 'message' => 'Ödeme başarıyla güncellendi.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Belirtilen ID ile eşleşen ödeme bulunamadı veya güncelleme yapılmadı.']);
        }
    }


    public function delete($id)
    {
        $query = $this->db->query("UPDATE payments SET Status = 0 WHERE OdemeID = $id");

        return json_encode(['success' => true, 'message' => 'Ödeme başarıyla silindi.']);
    }
}

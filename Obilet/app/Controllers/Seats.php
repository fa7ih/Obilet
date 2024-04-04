<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Seats extends BaseController
{
    use ResponseTrait;

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $query = $this->db->query("SELECT * FROM seats WHERE status = 1");
        $data['seats'] = $query->getResultArray();

        return json_encode($data);
    }

    public function store()
    {
        $seferID = $this->request->getPost('sefer_id');
        $koltukNumarasi = $this->request->getPost('koltuk_numarasi');
    
        $query = "INSERT INTO seats (SeferID, KoltukNumarasi, Durumu, YolcuID) VALUES (?, ?, 'Bos', NULL)";
        $this->db->query($query, [$seferID, $koltukNumarasi]);
    
        echo json_encode(['success' => true, 'message' => 'Koltuk başarıyla oluşturuldu.']);
    }

    public function edit($id)
    {
        $query = $this->db->query("SELECT * FROM seats WHERE KoltukID = ?", [$id]);
        $data['seat'] = $query->getRowArray();

        echo json_encode($data);
    }

    public function update($id)
    {
        $seferID = $this->request->getPost('sefer_id');
        $koltukNumarasi = $this->request->getPost('koltuk_numarasi');
        $durumu = $this->request->getPost('durumu');
        $yolcuID = $this->request->getPost('yolcu_id');

        $query = "UPDATE seats SET SeferID = ?, KoltukNumarasi = ?, Durumu = ?, YolcuID = ? WHERE KoltukID = ?";
        $this->db->query($query, [$seferID, $koltukNumarasi, $durumu, $yolcuID, $id]);

        echo json_encode(['success' => true, 'message' => 'Koltuk başarıyla güncellendi.']);
    }

    public function delete($id)
    {
        $query = "UPDATE seats SET Durumu = 0 WHERE KoltukID = ?";
        $this->db->query($query, [$id]);

        echo json_encode(['success' => true, 'message' => 'Koltuk başarıyla silindi.']);
    }


}

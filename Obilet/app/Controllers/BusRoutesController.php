<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;


class BusRoutesController extends BaseController
{
    use ResponseTrait;
    protected $db;
    

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getRoutes(){
        $kSehir=$this->request->getVar('kSehir');
        $vSehir=$this->request->getVar('vSehir');
        $date=$this->request->getVar('date');
        if (empty($kSehir) || empty($vSehir) || empty($date)) {
            return $this->respond([
                'success' => false,
                'message' => 'Eksik bilgi.'
            ], 400);
        }
        $query = $this->db->query("SELECT br.*, bc.FirmaAdi AS firma_adi, kalkis.TerminalID AS kalkis, varis.TerminalID AS varis, br.fiyat, br.SeferID
        FROM bus_routes br
        JOIN terminals kalkis ON br.KalkisTerminalID = kalkis.TerminalID
        JOIN terminals varis ON br.VarisTerminalID = varis.TerminalID
        JOIN bus_companies bc ON br.OtobusFirmaID = bc.FirmaID
        WHERE (kalkis.SehirID = ?)
        AND (varis.SehirID = ?)
        AND br.tarih = ?
        ORDER BY br.CikisZamani ASC;
        "
        , [$kSehir,$vSehir,$date]);
        $result = $query->getResult();

        if (!empty($result)) {
            $data = array();
        
            foreach ($result as $row) {
                $OtobusFirmaID = $row->OtobusFirmaID; 
                $CikisZamani = $row->CikisZamani; 
                $VarisZamani = $row->VarisZamani;
                $KoltukSayisi = $row->KoltukSayisi;            
                $bus_plaka = $row->bus_plaka; 
                $firma_adi = $row->firma_adi;
                $varis = $row->varis;
                $kalkis = $row->kalkis;
                $fiyat = $row->fiyat;
                $SeferID=$row->SeferID;
        
                $data[] = array(
                    'OtobusFirmaID' => $OtobusFirmaID,
                    'CikisZamani' => $CikisZamani,
                    'VarisZamani' => $VarisZamani,
                    'KoltukSayisi' => $KoltukSayisi,
                    'bus_plaka' => $bus_plaka,
                    'firma_adi' => $firma_adi,
                    'varis' => $varis,
                    'kalkis' => $kalkis,
                    'fiyat' => $fiyat,
                    'SeferID' => $SeferID

                );
            }
        
            $jsonData = json_encode($data);
            
            return $this->respond($jsonData);
        } else {
            // Kullanıcı bulunamazsa frontende "Kullanıcı bulunamadı." mesajını döndür
            return $this->respond([
                'success' => false,
                'message' => 'Sefer bulunamadı.'
            ], 404);
        }
    }



    public function index()
    {
        $sql = "SELECT * FROM bus_routes WHERE Status = 1";
        $query = $this->db->query($sql);
        $data['routes'] = $query->getResultArray();

        return $this->response->setJSON($data);
    }

    public function store()
    {
        $data = [
            'KalkisTerminalID' => $this->request->getPost('kalkis_terminal_id'),
            'VarisTerminalID' => $this->request->getPost('varis_terminal_id'),
            'CikisZamani' => $this->request->getPost('cikis_zamani'),
            'VarisZamani' => $this->request->getPost('varis_zamani'),
            'OtobusFirmaID' => $this->request->getPost('otobus_firma_id'),
            'KoltukSayisi' => $this->request->getPost('koltuk_sayisi'),
            'Status' => 1
        ];

        $sql = "INSERT INTO bus_routes (KalkisTerminalID, VarisTerminalID, CikisZamani, VarisZamani, OtobusFirmaID, KoltukSayisi, Status) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $query = $this->db->query($sql, array_values($data));

        if ($this->db->affectedRows() > 0) {
            return $this->response->setJSON(['success' => true, 'message' => 'Veri başarıyla eklendi.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Veri ekleme başarısız oldu.']);
        }
    }

    public function edit($id)
    {
        $sql = "SELECT * FROM bus_routes WHERE SeferID = ? AND Status = 1";
        $query = $this->db->query($sql, [$id]);
        $data['route'] = $query->getRowArray();

        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = [
            'KalkisTerminalID' => $this->request->getPost('kalkis_terminal_id'),
            'VarisTerminalID' => $this->request->getPost('varis_terminal_id'),
            'CikisZamani' => $this->request->getPost('cikis_zamani'),
            'VarisZamani' => $this->request->getPost('varis_zamani'),
            'OtobusFirmaID' => $this->request->getPost('otobus_firma_id'),
            'KoltukSayisi' => $this->request->getPost('koltuk_sayisi')
        ];

        $sql = "UPDATE bus_routes SET KalkisTerminalID = ?, VarisTerminalID = ?, CikisZamani = ?, VarisZamani = ?, OtobusFirmaID = ?, KoltukSayisi = ? WHERE SeferID = ?";
        $query = $this->db->query($sql, array_values(array_merge($data, [$id])));

        if ($this->db->affectedRows() > 0) {
            return $this->response->setJSON(['success' => true, 'message' => 'Veriler başarıyla güncellendi.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Verilen kimlik için veri bulunamadı veya değişiklik yapılmadı.']);
        }
    }

    public function delete($id)
    {
        $sql = "UPDATE bus_routes SET Status = 0 WHERE SeferID = ?";
        $query = $this->db->query($sql, [$id]);

        if ($this->db->affectedRows() > 0) {
            return $this->response->setJSON(['success' => true, 'message' => 'Veri durumu başarıyla güncellendi.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Verilen kimlik için veri bulunamadı.']);
        }
    }


}
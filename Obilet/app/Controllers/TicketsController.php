<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;


class TicketsController extends BaseController
{
    use ResponseTrait;

    private $db;    

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function checkPNR()
    {
        $UserEmail = $this->request->getVar('email');
        $pnr = $this->request->getVar('pnr');
    
        if (empty($UserEmail) || empty($pnr)) {
            return $this->respond([
                'success' => false,
                'message' => 'Eksik bilgi. Lütfen email ve pnr kodunuzu girin.'
            ], 400);
        }
    
        // Veritabanından kullanıcıyı seç
        $query = $this->db->query("SELECT s.KoltukNumarasi, br.CikisZamani, br.VarisZamani, br.bus_plaka, bc.FirmaAdi, tr1.TerminalAdi as kalkis, tr2.TerminalAdi as varis
        FROM tickets t
        JOIN users u ON t.KullaniciID = u.KullaniciID
        JOIN bus_routes br ON t.SeferID = br.SeferID 
        JOIN seats s ON s.KoltukID = t.KoltukID
        JOIN bus_companies bc ON br.OtobusFirmaID = bc.FirmaID
        JOIN terminals tr1 ON br.KalkisTerminalID = tr1.TerminalID
        JOIN terminals tr2 ON br.VarisTerminalID = tr2.TerminalID
        WHERE u.email = ? AND t.pnrkodu = ?;
        ", [$UserEmail,$pnr]);
        $result = $query->getResult();
    
        if (!empty($result)) {
            $data = array();
    
            foreach ($result as $row) {
                $KoltukNumarasi = $row->KoltukNumarasi; 
                $CikisZamani = $row->CikisZamani; 
                $VarisZamani = $row->VarisZamani;
                $bus_plaka = $row->bus_plaka; 
                $FirmaAdi = $row->FirmaAdi;
                $kalkis = $row->kalkis;
                $varis = $row->varis;
    
                $data[] = array(
                    'KoltukNumarasi' => $KoltukNumarasi,
                    'CikisZamani' => $CikisZamani,
                    'VarisZamani' => $VarisZamani,
                    'bus_plaka' => $bus_plaka,
                    'FirmaAdi' => $FirmaAdi,
                    'kalkis' => $kalkis,
                    'varis' => $varis
                );
            }
    
            $jsonData = json_encode($data);
            
            return $this->respond($jsonData);
    
        } else {
            // Bilet bulunamadıysa frontende "Bilet bulunamadı." mesajını döndür
            return $this->respond([
                'success' => false,
                'message' => 'Bilet bulunamadı.'
            ], 400);
        }
    }
    
        

    public function index()
    {
        $sql = "SELECT * FROM tickets WHERE Status = 1";
        $query = $this->db->query($sql);
        $data['tickets'] = $query->getResultArray();

        return json_encode($data);
    }


    public function store()
    {
        $data = [
            'KullaniciID' => $this->request->getPost('KullaniciID'),
            'SeferID' => $this->request->getPost('SeferID'),
            'KoltukID' => $this->request->getPost('KoltukID'),
            'Tarih' => $this->request->getPost('Tarih'),
            'Ucret' => $this->request->getPost('Ucret'),
            'PNRKodu' => $this->generatePNR($this->request->getPost('SeferID'), $this->request->getPost('KoltukID')),
            'Status' => 1
        ];

        $this->db->table('tickets')->insert($data);

        return json_encode(['success' => true, 'message' => 'Bilet başarıyla kaydedildi.']);
    }


    private function generatePNR($departureCityCode, $busPlate)
    {
        $timeOfDay = date('A') == 'AM' ? 'ÖÖ' : 'ÖS';

        $saleTime = date('dmYHis');

        $platformLetter = chr(rand(65, 90)); 

        $pnrCode = $departureCityCode . $timeOfDay . $saleTime . $platformLetter . $busPlate;

        return $pnrCode;
    }

    public function show($id)
    {
        $query = $this->db->query("SELECT * FROM tickets WHERE BiletID = ?", [$id]);
        $data['ticket'] = $query->getRowArray();

        return json_encode($data);
    }

    public function edit($id)
    {
        $query = $this->db->query("SELECT * FROM tickets WHERE BiletID = ?", [$id]);
        $data['ticket'] = $query->getRowArray();

        return json_encode($data);
    }


    public function update($id)
    {
        $data = [
            'KullaniciID' => $this->request->getPost('KullaniciID'),
            'SeferID' => $this->request->getPost('SeferID'),
            'KoltukID' => $this->request->getPost('KoltukID'),
            'Tarih' => $this->request->getPost('Tarih'),
            'Ucret' => $this->request->getPost('Ucret'),
        ];

        $sql = "UPDATE tickets SET KullaniciID = ?, SeferID = ?, KoltukID = ?, Tarih = ?, Ucret = ? WHERE BiletID = ?";
        $query = $this->db->query($sql, [$data['KullaniciID'], $data['SeferID'], $data['KoltukID'], $data['Tarih'], $data['Ucret'], $id]);

        if ($this->db->affectedRows() > 0) {
            return json_encode(['success' => true, 'message' => 'Bilet başarıyla güncellendi.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Belirtilen ID ile eşleşen bilet bulunamadı veya güncelleme yapılmadı.']);
        }
    }

    public function destroy($id)
    {
        $sql = "UPDATE tickets SET Status = 0 WHERE BiletID = ?";
        $query = $this->db->query($sql, [$id]);

        if ($this->db->affectedRows() > 0) {
            return json_encode(['success' => true, 'message' => 'Bilet başarıyla silindi.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Belirtilen ID ile eşleşen bilet bulunamadı veya silme yapılmadı.']);
        }
    }

}



<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class TerminalsController extends BaseController
{
    use ResponseTrait;

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function store()
    {
        $terminalAdi = $this->request->getPost('TerminalAdi');
        $sehirID = $this->request->getPost('SehirID');

        $query = $this->db->query("INSERT INTO terminals (TerminalAdi, SehirID, status) VALUES ('$terminalAdi', '$sehirID', 1)"); // Status 1 olarak eklendi

        if ($query) {
            return $this->respond(['success' => true, 'message' => 'Terminal başarıyla oluşturuldu.']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Terminal oluşturma sırasında bir hata oluştu.'], 500);
        }
    }

    public function delete($id)
    {
        $query = $this->db->query("UPDATE terminals SET status = 0 WHERE TerminalID = $id"); 

        if ($query) {
            return $this->respond(['success' => true, 'message' => 'Terminal başarıyla silindi.']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Terminal silme sırasında bir hata oluştu.'], 500);
        }
    }


    public function index()
    {
        $query = $this->db->query('SELECT * FROM terminals WHERE status = 1'); 
        $data['terminals'] = $query->getResult();

        return $this->respond($data);
    }
    public function show($id)
    {
        $query = $this->db->query("SELECT * FROM terminals WHERE TerminalID = $id");
        $data['terminal'] = $query->getRow();

        return $this->respond($data);
    }
    public function edit($id)
    {
        $query = $this->db->query("SELECT * FROM terminals WHERE TerminalID = $id");
        $data['terminal'] = $query->getRow();

        return $this->respond($data);
    }
    public function update($id)
    {
        $terminalAdi = $this->request->getPost('TerminalAdi');
        $sehirID = $this->request->getPost('SehirID');

        $query = $this->db->query("UPDATE terminals SET TerminalAdi = '$terminalAdi', SehirID = '$sehirID' WHERE TerminalID = $id");

        return $this->respond(['success' => true, 'message' => 'Terminal başarıyla güncellendi.']); 
    }


    public function getAll(){
        
        $query = $this->db->query("SELECT * FROM cities");
        $result = $query->getResult(); // Fetch the query result

        // Convert the result to an associative array
        $data = [];
        foreach ($result as $row) {
            $data[] = [
                'SehirID' => $row->SehirID,
                'SehirAdi' => $row->SehirAdi,
                'PlakaKodu' => $row->PlakaKodu,
                'status' => $row->status,
            ];
        }

        // Encode the data as JSON and return it
        return json_encode($data);
    }
}
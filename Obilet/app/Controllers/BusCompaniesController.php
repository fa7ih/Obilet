<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

use CodeIgniter\Controller;

class BusCompaniesController extends Controller
{
    protected $db;
    use ResponseTrait;


    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function busCompaniesList()
    {
        $query = $this->db->query('SELECT * FROM bus_companies');
        $companies = $query->getResult();

        return $this->response->setJSON($companies);
    }

    public function create()
    {
        return $this->response->setJSON(['message' => 'eklendi!!']);
    }

    public function store()
    {
        $firmaAdi = $this->request->getPost('FirmaAdi');

        $query = $this->db->query("INSERT INTO bus_companies (FirmaAdi) VALUES ('$firmaAdi')");

        if ($query) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Şirket başarıyla oluşturuldu
            ']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Şirket oluşturulamadı
            ']);
        }
    }

    public function show($id)
    {
        $query = $this->db->query("SELECT * FROM bus_companies WHERE FirmaID = $id");
        $company = $query->getRow();

        return $this->response->setJSON($company);
    }

    public function edit($id)
    {
        $query = $this->db->query("SELECT * FROM bus_companies WHERE FirmaID = $id");
        $company = $query->getRow();

        if (!$company) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Şirket bulunamadı
            ']);
        }

        return $this->response->setJSON(['status' => 'success', 'data' => $company]);
    }


    public function update($id)
    {
        $firmaAdi = $this->request->getPost('FirmaAdi');

        $query = $this->db->query("UPDATE bus_companies SET FirmaAdi = '$firmaAdi' WHERE FirmaID = $id");

        if ($query) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Şirket başarıyla güncellendi']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Şirket güncellenemedi
            ']);
        }
    }

    public function delete($id)
    {
        $query = $this->db->query("UPDATE bus_companies SET status = 0 WHERE FirmaID = $id");

        if ($query) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Şirket durumu başarıyla güncellendi']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Şirket durumu güncellenemedi']);
        }
    }

}

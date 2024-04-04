<?php
namespace App\Models;

use CodeIgniter\Model;

class BusCompanyModel extends CrudModel
{
    protected $table = 'bus_companies';
    protected $primaryKey = 'FirmaID';
    protected $allowedFields = ['FirmaAdi'];

    public function busRoutes()
    {
        return $this->hasMany(BusRouteModel::class, 'Otobus FirmaID');
    }
}

?>
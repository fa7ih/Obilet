<?php
namespace App\Models;

use CodeIgniter\Model;

class TerminalModel extends UserModel
{
    protected $table = 'terminals';
    protected $primaryKey = 'TerminalID';
    protected $allowedFields = ['TerminalAdi', 'SehirID'];

    public function city()
    {
        return $this->belongsTo(CityModel::class, 'SehirID');
    }

    public function busRoutes()
    {
        return $this->hasMany(BusRouteModel::class, 'TerminalID');
    }
}

?>
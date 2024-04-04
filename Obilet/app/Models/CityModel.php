<?php
namespace App\Models;

use CodeIgniter\Model;

class CityModel extends CrudModel
{
    protected $table = 'cities';
    protected $primaryKey = 'SehirID';
    protected $allowedFields = ['SehirAdi', 'PlakaKodu'];

    public function terminals()
    {
        return $this->hasMany(TerminalModel::class, 'SehirID');
    }
}

?>

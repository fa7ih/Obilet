<?php
namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends CrudModel
{
    protected $table = 'reservations';
    protected $primaryKey = 'RezervasyonID';
    protected $allowedFields = ['KullaniciID', 'SeferID', 'KoltukID', 'Tarih', 'AktifDurumu'];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'KullaniciID');
    }

    public function busRoute()
    {
        return $this->belongsTo(BusRouteModel::class, 'SeferID');
    }

    public function seat()
    {
        return $this->belongsTo(SeatModel::class, 'KoltukID');
    }
}

?>
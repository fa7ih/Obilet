<?php
namespace App\Models;

use CodeIgniter\Model;

class SeatModel extends CrudModel
{
    protected $table = 'seats';
    protected $primaryKey = 'KoltukID';
    protected $allowedFields = ['SeferID', 'KoltukNumarasi', 'Durumu', 'YolcuID'];

    public function busRoute()
    {
        return $this->belongsTo(BusRouteModel::class, 'SeferID');
    }

    public function ticket()
    {
        return $this->hasOne(TicketModel::class, 'KoltukID');
    }

    public function reservation()
    {
        return $this->hasOne(ReservationModel::class, 'KoltukID');
    }
}

?>
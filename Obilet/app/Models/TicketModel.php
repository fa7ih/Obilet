<?php
namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends UserModel
{
    protected $table = 'tickets';
    protected $primaryKey = 'BiletID';
    protected $allowedFields = ['KullaniciID', 'SeferID', 'KoltukID', 'Tarih', 'Ucret', 'PNRKodu'];

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
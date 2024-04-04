<?php
namespace App\Models;

use CodeIgniter\Model;

class BusRouteModel extends CrudModel
{
    protected $table = 'bus_routes';
    protected $primaryKey = 'SeferID';
    protected $allowedFields = ['KalkisTerminalID', 'VarisTerminalID', 'CikisZamani', 'VarisZamani', 'OtobusFirmaID', 'KoltukSayisi'];

    public function startTerminal()
    {
        return $this->belongsTo(TerminalModel::class, 'KalkisTerminalID');
    }

    public function destinationTerminal()
    {
        return $this->belongsTo(TerminalModel::class, 'VarisTerminalID');
    }

    public function busCompany()
    {
        return $this->belongsTo(BusCompanyModel::class, 'OtobusFirmaID');
    }

    public function seats()
    {
        return $this->hasMany(SeatModel::class, 'SeferID');
    }

    public function tickets()
    {
        return $this->hasMany(TicketModel::class, 'SeferID');
    }

    public function reservations()
    {
        return $this->hasMany(ReservationModel::class, 'SeferID');
    }
}

?>
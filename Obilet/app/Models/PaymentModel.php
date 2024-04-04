<?php
namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends CrudModel
{
    protected $table = 'payments';
    protected $primaryKey = 'OdemeID';
    protected $allowedFields = ['KullaniciID', 'BiletID', 'Tarih', 'Miktar', 'OdemeYontemi'];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'KullaniciID');
    }

    public function ticket()
    {
        return $this->belongsTo(TicketModel::class, 'BiletID');
    }
}

?>
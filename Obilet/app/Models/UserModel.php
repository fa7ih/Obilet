<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends CrudModel
{
    protected $table = 'users';
    protected $primaryKey = 'KullaniciID';
    protected $allowedFields = ['Adi', 'Soyadi', 'DogumTarihi', 'role_id', 'Cinsiyet', 'CepTelefonu', 'email', 'TCKimlikNoVeyaPasaportNo', 'Sifre', 'Bakiye'];

    public function tickets()
    {
        return $this->hasMany(TicketModel::class, 'KullaniciID');
    }

    public function reservations()
    {
        return $this->hasMany(ReservationModel::class, 'KullaniciID');
    }

    public function payments()
    {
        return $this->hasMany(PaymentModel::class, 'KullaniciID');
    }

    public function getByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id', 'role_id');
    }
}

?>

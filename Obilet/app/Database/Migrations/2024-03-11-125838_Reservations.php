<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reservations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'RezervasyonID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'KullaniciID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'SeferID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'KoltukID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'Tarih' => [
                'type' => 'DATE',
            ],
            'AktifDurumu' => [
                'type' => 'ENUM("RezerveEdildi", "SatinAlindi", "IptalEdildi")',
            ],
        ]);

        $this->forge->addKey('RezervasyonID', true);
        $this->forge->addForeignKey('KullaniciID', 'users', 'KullaniciID');
        $this->forge->addForeignKey('SeferID', 'bus_routes', 'SeferID');
        $this->forge->addForeignKey('KoltukID', 'seats', 'KoltukID');
        $this->forge->createTable('reservations');
    }

    public function down()
    {
        $this->forge->dropTable('reservations');
    }
}

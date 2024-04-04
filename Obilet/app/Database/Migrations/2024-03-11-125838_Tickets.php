<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tickets extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'BiletID' => [
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
            'Ucret' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'PNRKodu' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('BiletID', true);
        $this->forge->addForeignKey('KullaniciID', 'users', 'KullaniciID');
        $this->forge->addForeignKey('SeferID', 'bus_routes', 'SeferID');
        $this->forge->addForeignKey('KoltukID', 'seats', 'KoltukID');
        $this->forge->createTable('tickets');
    }

    public function down()
    {
        $this->forge->dropTable('tickets');
    }
}

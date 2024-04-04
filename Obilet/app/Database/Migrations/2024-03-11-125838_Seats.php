<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Seats extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'KoltukID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'SeferID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'KoltukNumarasi' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'Durumu' => [
                'type' => 'ENUM("Bos", "Rezerve Edilmis", "SatinAlinmis")',
            ],
            'YolcuID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('KoltukID', true);
        $this->forge->addForeignKey('SeferID', 'bus_routes', 'SeferID');
        $this->forge->createTable('seats');
    }

    public function down()
    {
        $this->forge->dropTable('seats');
    }
}

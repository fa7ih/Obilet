<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'OdemeID' => [
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
            'BiletID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'Tarih' => [
                'type' => 'DATE',
            ],
            'Miktar' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'OdemeYontemi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('OdemeID', true);
        $this->forge->addForeignKey('KullaniciID', 'users', 'KullaniciID');
        $this->forge->addForeignKey('BiletID', 'tickets', 'BiletID');
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BusRoutes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'SeferID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'KalkisTerminalID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'VarisTerminalID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'CikisZamani' => [
                'type' => 'DATETIME',
            ],
            'VarisZamani' => [
                'type' => 'DATETIME',
            ],
            'OtobusFirmaID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'KoltukSayisi' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
        ]);

        $this->forge->addKey('SeferID', true);
        $this->forge->addForeignKey('KalkisTerminalID', 'terminals', 'TerminalID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('VarisTerminalID', 'terminals', 'TerminalID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('OtobusFirmaID', 'bus_companies', 'FirmaID', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bus_routes', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('bus_routes');
    }
}
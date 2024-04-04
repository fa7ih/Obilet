<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BusCompanies extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FirmaID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'FirmaAdi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('FirmaID', true);
        $this->forge->createTable('bus_companies');
    }

    public function down()
    {
        $this->forge->dropTable('bus_companies');
    }
}

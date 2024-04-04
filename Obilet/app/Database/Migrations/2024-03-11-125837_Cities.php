<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cities extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'SehirID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'SehirAdi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'PlakaKodu' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
        ]);

        $this->forge->addKey('SehirID', true);
        $this->forge->createTable('cities');
    }

    public function down()
    {
        $this->forge->dropTable('cities');
    }
}

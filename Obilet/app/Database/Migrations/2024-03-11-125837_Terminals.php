<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Terminals extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'TerminalID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'TerminalAdi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'SehirID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('TerminalID', true);
        $this->forge->addForeignKey('SehirID', 'cities', 'SehirID');
        $this->forge->createTable('terminals');
    }

    public function down()
    {
        $this->forge->dropTable('terminals');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('role_id', true);
        $this->forge->createTable('roles');
    }

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}

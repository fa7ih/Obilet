<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'KullaniciID' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'Adi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'Soyadi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'DogumTarihi' => [
                'type' => 'DATE',
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'Cinsiyet' => [
                'type' => 'ENUM("Erkek", "Kadin")',
            ],
            'CepTelefonu' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'TCKimlikNoVeyaPasaportNo' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'Sifre' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'Bakiye' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);

        $this->forge->addKey('KullaniciID', true);
        $this->forge->addForeignKey('role_id', 'roles', 'role_id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

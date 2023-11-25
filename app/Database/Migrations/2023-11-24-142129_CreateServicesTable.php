<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServicesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'service_code' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'service_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'service_icon' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'service_tarif' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
           
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('services');
    }

    public function down()
    {
        $this->forge->dropTable('services');
    }
}

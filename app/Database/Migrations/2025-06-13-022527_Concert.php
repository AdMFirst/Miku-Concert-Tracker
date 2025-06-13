<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Concert extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'location' => ['type' => 'VARCHAR', 'constraint' => 255],
            'date' => ['type' => 'DATE'],
            'other_details' => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('concerts');
    }

    public function down()
    {
        $this->forge->dropTable('concerts');
    }
}

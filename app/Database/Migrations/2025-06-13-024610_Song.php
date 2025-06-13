<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Song extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'writer' => ['type' => 'VARCHAR', 'constraint' => 255],
            'composer' => ['type' => 'VARCHAR', 'constraint' => 255],
            'duration' => ['type' => 'TIME', 'null' => true],
            'notes' => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('songs');
    }

    public function down()
    {
        $this->forge->dropTable('songs');
    }
}

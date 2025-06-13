<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Performance extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'concert_id' => ['type' => 'INT'],
            'song_id' => ['type' => 'INT'],
            'order' => ['type' => 'INT', 'null' => true],
        ]);
        $this->forge->addKey(['concert_id', 'song_id'], true);
        $this->forge->addForeignKey('concert_id', 'concerts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('song_id', 'songs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('performances');
    }

    public function down()
    {
        $this->forge->dropTable('performances');
        
    }
}

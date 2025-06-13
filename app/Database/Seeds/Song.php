<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Song extends Seeder
{
    public function run()
    {
        $songs = [
            ['id' => 1, 'title' => 'World is Mine', 'writer' => 'ryo', 'composer' => 'ryo', 'duration' => '00:04:00'],
            ['id' => 2, 'title' => 'Tell Your World', 'writer' => 'kz', 'composer' => 'kz', 'duration' => '00:04:20'],
            ['id' => 3, 'title' => 'Senbonzakura', 'writer' => 'Kurousa-P', 'composer' => 'Kurousa-P', 'duration' => '00:04:05'],
        ];
        $this->db->table('songs')->insertBatch($songs);
    }
}

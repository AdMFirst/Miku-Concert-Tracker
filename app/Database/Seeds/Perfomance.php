<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Perfomance extends Seeder
{
    public function run()
    {
        $performances = [
            ['concert_id' => 1, 'song_id' => 1, 'order' => 1],
            ['concert_id' => 1, 'song_id' => 2, 'order' => 2],
            ['concert_id' => 2, 'song_id' => 2, 'order' => 1],
            ['concert_id' => 2, 'song_id' => 3, 'order' => 2],
        ];
        $this->db->table('performances')->insertBatch($performances);
    }
}

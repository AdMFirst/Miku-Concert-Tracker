<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Concert extends Seeder
{
    public function run()
    {
        $concerts = [
            ['id' => 1, 'name' => 'Miku Expo Tokyo', 'location' => 'Tokyo', 'date' => '2024-01-01', 'other_details' => 'Opening concert'],
            ['id' => 2, 'name' => 'Magical Mirai Osaka', 'location' => 'Osaka', 'date' => '2024-03-10', 'other_details' => 'Spring festival'],
        ];
        $this->db->table('concerts')->insertBatch($concerts);
    }
}

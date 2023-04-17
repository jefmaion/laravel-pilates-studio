<?php

namespace Database\Seeders;

use App\Models\Modality;
use Illuminate\Database\Seeder;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Pilates', 'enabled' => 1, 'acronym' => 'PLT'],
            ['name' => 'LPF', 'enabled' => 1, 'acronym' => 'LPF'],
            ['name' => 'Bundge Fusion', 'enabled' => 1, 'acronym' => 'BDF'],
        ];

        foreach($data as $item) {
            Modality::create($item);
        }
    }
}

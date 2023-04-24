<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Crédito'],
            ['name' => 'Débito', ],
            ['name' => 'Pix'],
        ];

        foreach($data as $item) {
            PaymentMethod::create($item);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Matrículas'],
            ['name' => 'Venda de Produtos'],
            ['name' => 'Despesas'],
            ['name' => 'Outros'],
        ];

        foreach($data as $item) {
            Category::create($item);
        }
    }
}

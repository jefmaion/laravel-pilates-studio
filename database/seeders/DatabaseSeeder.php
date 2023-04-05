<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        return $this->runAll();
        // \App\Models\User::factory(10)->create();
        $this->call([
            StudentSeeder::class,
            ExerciceSeeder::class,
        ]);
    }


    private function runAll() {
        $files_arr = scandir( dirname(__FILE__) ); //store filenames into $files_array
        
        foreach ($files_arr as $key => $file){
            if ($file !== 'DatabaseSeeder.php' && $file[0] !== "." ){
                $seeder = '\\Database\\Seeders\\' . explode('.', $file)[0];
                $this->call($seeder);
            }
        }
    }
}

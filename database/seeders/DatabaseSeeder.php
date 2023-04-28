<?php

namespace Database\Seeders;

use App\Models\AccountReceivable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // return $this->runAll();
        // \App\Models\User::factory(10)->create();
        $this->call([
            StudentSeeder::class,
            ModalitySeeder::class,
            ExerciceSeeder::class,
            InstructorSeeder::class,
            InstructorModalitySeeder::class,
            ClassTypeSeeder::class,
            ClassesSeeder::class,
            PaymentMethodsSeeder::class,
            CategorySeeder::class,
            TransactionSeeder::class,
            AccountReceivableSeeder::class,
        ]);
    }


    private function runAll() {
        $files_arr = scandir( dirname(__FILE__) ); //store filenames into $files_array
        
        $data = [];

        foreach ($files_arr as $key => $file){
            if ($file !== 'DatabaseSeeder.php' && $file[0] !== "." ){

                if($file !== 'RegistrationSeeder.php') {
                    $filedata = filectime(dirname(__FILE__) . '\\' .$file);
                    $data[$filedata]  = '\\Database\\Seeders\\' . explode('.', $file)[0];
                }

                
            }
        }

        ksort($data);


        foreach($data as $seeder) {
            $this->call($seeder);
        }
    }
}

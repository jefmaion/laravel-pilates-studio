<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Gleice Reis de Oliveira',  'email' => 'gleicelilica@hotmail.com', 'password' => bcrypt('123123123'), 'gender' => 'F', 'birth_date' => '1981-05-27', 'cpf' => '00000000000', 'address' => 'Rua Dom Humberto Mazzoni', 'number' => '315', 'complement' => '', 'district' => 'VL PADRE ANCHIETA', 'city' => 'CAMPINAS', 'state' => 'SP', 'phone_wpp' => '19 99247-3123 '],
            ['name' => 'Heloisa Reis e Silva', 'email' => 'heloisa@hotmail.com', 'password' => bcrypt('123123123'), 'gender' => 'F', 'birth_date' => '1957-07-28', 'cpf' => '11111111111', 'address' => 'Rua Batista Raffi', 'number' => '457', 'complement' => '', 'district' => 'NOVA AARECIDA', 'city' => 'CAMPINAS', 'state' => 'SP', 'phone_wpp' => '99712-6981'],
            ['name' => 'Bianca Lima', 'email' => 'bianca@hotmail.com', 'password' => bcrypt('123123123'), 'gender' => 'F', 'birth_date' => '1983-08-22', 'cpf' => '22222222222', 'address' => 'Rua Dr. Paulo Florence', 'number' => '604', 'complement' => '', 'district' => 'VILA ITÁLIA', 'city' => 'CAMPINAS', 'state' => 'SP', 'phone_wpp' => '98846-0124'],
        ];





        foreach ($data as $item) {

            $user = User::create($item);

            $instructor          = new Instructor();
            $instructor->enabled = 1;
            $instructor->user()->associate($user);
            $instructor->save();

            $instructor->modalities()->attach($instructor, [
                'modality_id'        => rand(1,3), 
                'remuneration_type'  => 'P', 
                'remuneration_value' => rand(1,50), 
                'calc_on_absense'    => rand(0,1)
            ]);
        }
    }
}

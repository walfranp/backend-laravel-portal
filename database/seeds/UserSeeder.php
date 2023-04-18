<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {

            User::create([
                'name' => 'Monteiro Lobato',
                'cpf' => '01234567890',
                'email' => 'm.lobato@email.com',
                'password' => bcrypt('01234567890'),
                'id_externo' => 9785548,
                'matricula' => 100,
                'nivel_usuario' => 0,
            ]);

            User::create([
                'name' => 'Alberto Santos Dumont',
                'cpf' => '01234567891',
                'email' => 'a.dumont@email.com',
                'password' => bcrypt('01234567891'),
                'id_externo' => 3165485,
                'matricula' => 200,
                'nivel_usuario' => 0,
            ]);

            User::create([
                'name' => 'Machado de Assis',
                'cpf' => '01234567892',
                'email' => 'm.assis@email.com',
                'password' => bcrypt('01234567892'),
                'id_externo' => 36512584,
                'matricula' => 300,
                'nivel_usuario' => 0,
            ]);

        } else {
            echo "Tabela users já povoada!";
        }
    }
}

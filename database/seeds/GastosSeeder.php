<?php

use App\GastosUsuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class GastosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (GastosUsuario::count() == 0) {

            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 1,
                'valor' => 314.21,
                'mesref' => 1,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 2,
                'valor' => 526.30,
                'mesref' => 1,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 3,
                'valor' => 228.90,
                'mesref' => 1,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 5,
                'valor' => 850.40,
                'mesref' => 1,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 69,
                'valor' => 680.20,
                'mesref' => 1,
                'anoref' => Carbon::now()->format('Y'),
            ]);

            //----------------- FEVEREIRO -----------------------------------------------

            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 1,
                'valor' => 224.30,
                'mesref' => 2,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 2,
                'valor' => 400.59,
                'mesref' => 2,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 3,
                'valor' => 330.30,
                'mesref' => 2,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 5,
                'valor' => 980.60,
                'mesref' => 2,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 69,
                'valor' => 680.20,
                'mesref' => 2,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 6,
                'valor' => 649.80,
                'mesref' => 2,
                'anoref' => Carbon::now()->format('Y'),
            ]);

            //----------------- MARÇO -----------------------------------------------

            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 1,
                'valor' => 222.90,
                'mesref' => 3,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 2,
                'valor' => 156.39,
                'mesref' => 3,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 3,
                'valor' => 447.21,
                'mesref' => 3,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 5,
                'valor' => 1150.60,
                'mesref' => 3,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 69,
                'valor' => 680.20,
                'mesref' => 3,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 6,
                'valor' => 530.10,
                'mesref' => 3,
                'anoref' => Carbon::now()->format('Y'),
            ]);
            GastosUsuario::create([
                'usuario' => 9785548,
                'convenio' => 4,
                'valor' => 369.66,
                'mesref' => 3,
                'anoref' => Carbon::now()->format('Y'),
            ]);

        } else {
            echo "Tabela gastos já povoada!";
        }
    }
}

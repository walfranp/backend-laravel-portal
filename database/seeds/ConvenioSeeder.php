<?php

use App\Convenio;
use Illuminate\Database\Seeder;

class ConvenioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Convenio::count() == 0) {

            Convenio::create([
                'nome' => 'Panificadora pão quente',
                'codigo' => 1,
            ]);
            Convenio::create([
                'nome' => 'Drogaria só remédios',
                'codigo' => 2,
            ]);
            Convenio::create([
                'nome' => 'Restaurante cheiro verde',
                'codigo' => 3,
            ]);
            Convenio::create([
                'nome' => 'Açougue boi gordo',
                'codigo' => 4,
            ]);
            Convenio::create([
                'nome' => 'Supermercado bom preço',
                'codigo' => 5,
            ]);
            Convenio::create([
                'nome' => 'Auto posto tabocão',
                'codigo' => 6,
            ]);
            Convenio::create([
                'nome' => 'Unimed saúde',
                'codigo' => 69,
            ]);

        } else {
            echo "Tabela convenios já povoada!";
        }
    }
}

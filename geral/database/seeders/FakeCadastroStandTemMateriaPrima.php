<?php

namespace Database\Seeders;

use App\Models\CadastroStandTemMateriaPrima;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroStandTemMateriaPrima extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroStandTemMateriaPrima::factory()->count(200)->create();
    }
}

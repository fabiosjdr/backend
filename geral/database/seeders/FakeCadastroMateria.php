<?php

namespace Database\Seeders;

use App\Models\CadastroMateriaPrima;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroMateria extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroMateriaPrima::factory()->count(50)->create();
    }
}

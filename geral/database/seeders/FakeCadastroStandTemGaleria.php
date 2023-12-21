<?php

namespace Database\Seeders;

use App\Models\CadastroStandTemGaleria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroStandTemGaleria extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroStandTemGaleria::factory()->count(300)->create();
    }
}

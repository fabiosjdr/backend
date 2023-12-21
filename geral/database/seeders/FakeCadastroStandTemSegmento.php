<?php

namespace Database\Seeders;

use App\Models\CadastroStandTemSegmento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroStandTemSegmento extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroStandTemSegmento::factory()->count(200)->create();
    }
}

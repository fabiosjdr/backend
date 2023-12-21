<?php

namespace Database\Seeders;

use App\Models\CadastroStandTemImagem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroStandTemImagem extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroStandTemImagem::factory()->count(500)->create();
    }
}

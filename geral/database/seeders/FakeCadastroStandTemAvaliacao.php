<?php

namespace Database\Seeders;

use App\Models\CadastroStandTemAvaliacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroStandTemAvaliacao extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroStandTemAvaliacao::factory()->count(100)->create();
    }
}
